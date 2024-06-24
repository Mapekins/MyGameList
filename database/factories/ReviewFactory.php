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
        $reviews = [
            'The gameplay mechanics are solid, but the story falls flat.',
            'Disappointing graphics compared to modern standards.',
            'Lack of originality in gameplay.',
            'Buggy and unpolished, needs more development time.',
            'Too short for the price, felt like it ended abruptly.',
            'Overhyped and underdelivered.',
            'The soundtrack is amazing!',
            'I found the controls to be intuitive and responsive.',
            'The open world is breathtakingly beautiful.',
            'This game has a steep learning curve, but it\'s worth it.',
            'The voice acting is top-notch.',
            'A masterpiece of storytelling.',
            'The multiplayer mode adds a lot of replayability.',
            'The character customization options are extensive.',
            'The game mechanics are innovative and refreshing.',
            'The game is addictive, I couldn\'t put it down!',
            'I encountered several game-breaking bugs.',
            'The ending left me wanting more.',
        ];
        return [
            'user_id' => $this->faker->numberBetween(1, 54),
            'game_id' => $this->faker->numberBetween(1, 26),
            'text' => $this->faker->randomElement($reviews),
            'rating' => $this->faker->numberBetween(1, 10),
            'date' => now()
        ];
    }
}
