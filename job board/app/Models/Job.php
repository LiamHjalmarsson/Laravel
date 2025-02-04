<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "location",
        "description",
        "salary",
        "experience",
        "category",
    ];

    public static array $experience = ["entry", "intermediate", "senior"];
    public static array $category = ["IT", "Finance", "Business", "Sales", "Marketing"];

    // relationship
    public function employer () : BelongsTo {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications () : HasMany {
        return $this->hasMany(JobApplication::class);
    }
    

    // CUSTOM LOGICAL METHODS TO MODELS 
    public function hasUserApplied (Authenticatable|User|int $user) : bool {
        // We are getting a job => with the id of this current job model using $this
        // Then we also check if it has a job applications relationship 
        return $this->where("id", $this->id)
            ->whereHas(
                "jobApplications", 
                fn($query) => $query->where("user_id", "=", $user->id ?? $user)
            )->exists(); 
    }

    // local query scope 
        // mehtos that lets you build some part of a query that you can later mix togehter
            // with all the query builder ,ethods of laravel eloquent 
    public function scopeFilter (EloquentBuilder | QueryBuilder $query, array $filters) {
        return $query->when(
            $filters['search'] ?? null, 
            function ($query, $search) {
                $query->where(
                    function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%')
                                ->orWhereHas("employer", function ($query) use ($search) { // To acces search we insied function we need to use the use ($search)
                                    $query->where("company_name", "like", "%" . $search . "%");
                                });
                    });
            })
                ->when($filters['min_salary'] ?? null, 
                function ($query, $minSalary) {
                    $query->where('salary', '>=', $minSalary);
                })
                    ->when($filters['max_salary'] ?? null, 
                    function ($query, $maxSalary) {
                        $query->where('salary', '<=', $maxSalary);
                    })
                        ->when($filters['experience'] ?? null, 
                        function ($query, $experience) {
                            $query->where('experience', $experience);
                        })
                            ->when($filters['category'] ?? null, 
                            function ($query, $category) {
                                $query->where('category', $category);
                            });
    }    

}
