<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_type' => fake()->randomElement(['income', 'expense']),
            'name' => fake()->words(fake()->randomElement([2, 1]), true),
            'description' => fake()->paragraph(),
        ];
    }
}
