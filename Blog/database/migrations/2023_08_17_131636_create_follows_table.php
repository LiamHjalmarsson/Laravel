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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            // This is creating both the column and the key for you using the forein ID so the name that is choosen in ("user_id) mathers
            // user is the the table taht refrencing and the id is the column refrencing 
            $table->foreignId("user_id")->constrained(); // Idea is that this is storing the user thats doing the following

            // doing the foreingID on our own 
            // This is creating a column in the table 
            $table->unsignedBigInteger("followeduser"); // store the id of the user being followed 
            // this is is creating the actual foreign key 
            $table->foreign("followeduser")->references("id")->on("users");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
