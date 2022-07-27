<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'text' => fake()->paragraph(),
            'votes' => fake()->numberBetween(0,100),
            'location' => '{"ip":"107.122.93.54","country":"US","state":"IL","zipcode":"60623","city":"Chicago","latitude":"41.85","longitude":"-87.7165"}'
        ];
    }
}
