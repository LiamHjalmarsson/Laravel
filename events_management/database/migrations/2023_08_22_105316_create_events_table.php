<?php

use App\Models\User;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            
            // one argument the model it realates to 
            // this would create boththe column that will hold the realtionship and additionally it will add a foregin key for that column
            $table->foreignIdFor(User::class);
            $table->string("name");
            $table->text("description");

            $table->dateTime("start_time");
            $table->dateTime("end_time");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
