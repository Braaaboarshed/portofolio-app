<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,

            'title' => fake()->sentence(3),
            'description' => fake()->text(150),
            'image' => fake()->imageUrl(300, 200, 'technology'),
            'link' => fake()->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
