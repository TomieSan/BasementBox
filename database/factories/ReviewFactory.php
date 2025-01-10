<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
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
            'user_id' => User::factory(),
            'game_id' => rand(1, Game::count()),
            'rating' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(3, true)
        ];
    }
}
