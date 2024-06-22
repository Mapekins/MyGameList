<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameList>
 */
class GameListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'game_id' => $this->faker->numberBetween(1, 26),
            'status' => $this->faker->numberBetween(1, 5),
            'score' => $this->faker->numberBetween(1, 10),
            'favorite' => $this->faker->boolean(50),
        ];
    }
}
