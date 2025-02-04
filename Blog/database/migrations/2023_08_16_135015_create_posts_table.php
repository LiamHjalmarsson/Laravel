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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->longText("body");
            // Laravel will see this and it will know that what comes before the underscore 
            // so user the name of the model in the table that wre trying to look at 
            // and what eer comes after the underscore thats the name of the column or the filed 

            // in other word whoever creates or authors a blog post that user is going to be represented 
            $table->foreignId("user_id")->constrained(); // Constrained will not ket you create a blog post if the author value that you provide dosent exist in the table 
            // $table->foreignId("user_id")->constrained()->onDelete("cascade"); // deletes all t
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
