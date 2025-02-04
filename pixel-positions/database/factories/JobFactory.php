<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "employer_id" => Employer::factory(),
            "title" => fake()->jobTitle(),
            "salary" => fake()->randomElement(["34, 000", "38, 000", "45, 000"]),
            "location" => fake()->city(),
            "type" => fake()->randomElement(["Remote", "Hybrid", "On site"]),
            "schedule" => fake()->randomElement(["Full time", "half time", "Extra"]),
            "url" => fake()->url(),
            "featured" => false,
        ];
    }
}
