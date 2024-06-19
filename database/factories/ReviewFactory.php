<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(0, 20),
            'game_id' => $this->faker->numberBetween(1, 7),
            'text' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 10),
            'date' => now()
        ];
    }
}
