<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Dr. Ruben Senger',
            'image' => 'https://via.placeholder.com/150x150.png/00ffaa?text=people+et',
            'email' => 'admin@example.com',
            'phone' => '423.635.7009',
            'address' => '11526 Jazmyn Ranch Apt. 401, Beahanland, NV 51084-3909',
            'user_id' => 1,
            'job_title' => 'Web Developer',
            'bio' => 'Vel quam aut sed voluptatibus mollitia. Atque exercitationem maiores consectetur dolorum. Harum fugit sapiente minima eum eos. Quam atque ipsam architecto ipsam.',
        ];
    }
}
