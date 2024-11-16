<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            Post::factory()->create([
                'user_id' => 1,
                'category_id' => rand(1, 4),
                'image' => 'https://plus.unsplash.com/premium_photo-1683917066643-346d96b85e7f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxNXx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Post ' . $i,
                'slug' => 'post-' . $i,
                'description' => 'Description of post ' . $i,
                'content' => 'Content of post ' . $i,
                'is_active' => 1,
                'view' => rand(1, 100),
            ]);
        }
    }
}
