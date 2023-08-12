<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $tags = [];

        // for ($i=0; $i < rand(1, 5); $i++) {
        //     $tags[$i] = $this->faker->word();
        // }

        // $tagsJson = json_encode($tags);

        return [
            'title' => $this->faker->name(),
            // 'tags' => $tagsJson,
            'company' => $this->faker->company(),
            'location' => $this->faker->country(),
            'email' => $this->faker->email(),
            'website' => $this->faker->url(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
