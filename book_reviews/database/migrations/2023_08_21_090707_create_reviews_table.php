<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // the book_id will be a foregin key and is a colum in a database table that refer to the primary key of another table 
            // $table->unsignedBigInteger("book_id"); 

            $table->text("review");
            $table->unsignedBigInteger("rating");


            // to define a foreign key book id 
            // $table->foreign("book_id")->references("id")->on("books")->onDelete("cascade"); // cascade when a book record is deleted all related revies should also be deleted

            // next step tell laravel about the relationship by defining methods on both of the models

            // short had for above 
            $table->foreignId("book_id")->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
