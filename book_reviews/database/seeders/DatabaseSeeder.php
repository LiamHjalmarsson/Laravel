<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // THe code will create 33 books 
        Book::factory(33)->create()->each(function ($book) {
            // for evert singel book it will decide randomly how many revies to generate 
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
                // It will generate the reviews, create the models and it will run the overriding method called good ( justs sets the ratings ) 
                ->good()
                // Creates an association with the book by setting the book id coulmn and then creates the model and immediately save it 
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
