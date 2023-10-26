<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(fake()->numberBetween(5, 10), true),
            'amount' => fake()->numberBetween(1, 9) * fake()->randomElement([1000, 5000]),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function ($transfer) {
            // $transfer->load('from_account', 'to_account');

            // $transfer->from_account->decrement('balance', $transfer->amount);
            // $transfer->to_account->increment('balance', $transfer->amount);
        });
    }
}
