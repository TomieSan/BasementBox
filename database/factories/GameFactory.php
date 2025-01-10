<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imgs = ['photos/placeholder2.png', 
                 'photos/placeholder3.png',
                 null];
        return [
            'name'=>$this->faker->words(3, true),
            'publisher_id'=>User::factory(),
            'description'=>$this->faker->paragraphs(3, true),
            'excerpt'=>$this->faker->sentences(3, true),
            'tags'=>$this->faker->words($this->faker->numberBetween(0, 10), true),
            'price'=>$this->faker->numberBetween(50, 10000),
            'logo'=>$this->faker->randomElement($imgs),
            'gamePic1'=>$this->faker->randomElement($imgs),
            'gamePic2'=>$this->faker->randomElement($imgs),
            'gamePic3'=>$this->faker->randomElement($imgs),
            'gamePic4'=>$this->faker->randomElement($imgs)
        ];
    }
}
