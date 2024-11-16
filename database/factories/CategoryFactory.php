<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $index = 0;
        $names = ['Giáo dục', 'Công nghệ', 'Video', 'Podcasts'];
        
        $name = $names[$index++ % count($names)];
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => fake()->imageUrl(),
            'is_active' => 1,
        ];
    }
}
