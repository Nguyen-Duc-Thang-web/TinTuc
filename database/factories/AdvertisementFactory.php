<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 2),
            'category_id' => rand(1, 4),
            'pages' => fake()->randomElement(['home', 'post_detail']),
            'position' => fake()->randomElement(['header', 'middle', 'bottom', 'sidebar']),
            'image' => fake()->imageUrl(),
            'link' => fake()->url(),
            'start_date' => now()->addDays(rand(1, 5)),
            'end_date' => now()->addDays(rand(5, 10)),
            'status' => fake()->randomElement(['draft', 'active', 'paused', 'completed']),
            'content' => fake()->sentence(),
        ];
    }
}
