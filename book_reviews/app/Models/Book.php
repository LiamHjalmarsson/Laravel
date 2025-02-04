<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Book extends Model
{
    use HasFactory;

    // The book can have many review but one review can only be associated with a one book
    // Add and create a physical connection beween the two tables in the migrations 

    // relationship to revies 
    public function reviews () {
        // The book can have many reviews 
        return $this->hasMany(Review::class); // refrense to the model 
    }

    // local query scope nees scope first
    public function scopeTitle (Builder $query, string $title): Builder {
        return $query->where("title", "LIKE", "%" . $title . "%");
    }

    public function scopeWithReviewsCount (Builder $query, $from = null, $to = null) :Builder|QueryBuilder {
        return $query->withCount([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ]);
    }

    public function scopeWithAvgRating (Builder $query, $from = null, $to = null) :Builder|QueryBuilder {
        return $query->withAvg([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ], 'rating');
    }

    public function scopePopular (Builder $query, $from = null, $to = null) :Builder|QueryBuilder {
        // return $query->withCount("reviews")->orderBy("reviews_count", "desc");
        return $query->withReviewsCount()
            ->orderBy('reviews_count', 'desc');
    }

    // SCOPES WITHIN OTHER SCOPES 

    public function scopeHighestRated(Builder $query, $from = null, $to = null) : Builder|QueryBuilder {
        // return $query->withAvg("reviews", "rating")->orderBy("reviews_avg_rating", "desc");
        return $query->withAvgRating()
            ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews (Builder $query, int $minReviews) : Builder|QueryBuilder {
        return  $query->having("reviews_count", ">=", $minReviews);
    }

    private function dateRangeFilter(Builder $query, $from = null, $to = null) {
        if ($from && !$to) {
            $query->where('created_at', '>=', $from);
        } elseif (!$from && $to) {
            $query->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopePopularLastMonth (Builder $query): Builder|QueryBuilder {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
                ->minReviews(2);
    }

    public function scopePopularLast6Months (Builder $query): Builder|QueryBuilder {
        return $query->popular(now()->subMonths(6), now())
            ->highestRated(now()->subMonths(6), now())
                ->minReviews(5);
    }

    public function scopeHighestRatedLastMonth (Builder $query): Builder|QueryBuilder {
        return $query->highestRated(now()->subMonth(), now())
            ->popular(now()->subMonth(), now())
                ->minReviews(2);
    }

    public function scopeHighestRatedLast6Months (Builder $query): Builder|QueryBuilder {
        return $query->highestRated(now()->subMonths(6), now())
            ->popular(now()->subMonths(6), now())
                ->minReviews(5);
    }

    protected static function booted () {
        static::updated(
            fn (Book $book) => cache()->forget("book:" . $book->book_id)
        );
        static::deleted(
            fn (Book $book) => cache()->forget("book:" . $book->book_id)
        );
    }
}
