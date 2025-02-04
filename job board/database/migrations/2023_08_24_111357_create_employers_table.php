<?php

use App\Models\Employer;
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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();

            $table->string("company_name");
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->timestamps();
        });
        
        // we have jobs and every job is from a ceratin employer 
            // need a company to offer jobs 
                // this means that every job need to have an ID of the employer thats posting the job offer 

                // This block needs to be after creating the employers table or be in separate migrations 
        Schema::table('jobs', function (Blueprint $table) {
            // thats why this jobs tabel would now have a foreignkey to the employer table 
            $table->foreignIdFor(Employer::class)->constrained();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeignIdFor(Employer::class);
        });

        Schema::dropIfExists('employers');
    }
};
