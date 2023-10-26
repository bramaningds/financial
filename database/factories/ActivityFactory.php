<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(10, true),
            'created_at' => fake()->dateTimeThisYear()
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function ($activity) {
            $activity->activity_type = $activity->debit ? 'income' : 'expense';

            // $activity->load('account');
            // $activity->account->increment('balance', $activity->debit - $activity->credit);
        });
    }
}
