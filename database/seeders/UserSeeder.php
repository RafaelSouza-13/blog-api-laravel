<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();
        // Criar usuário com posts
        User::factory()->count(14)->create()->each(function ($user) use ($tags) {
            $user->posts()->saveMany(
                Post::factory()->count(random_int(1, 5))->make()
            )->each(function ($post) use ($tags) {
                // Associa de 1 a 3 tags aleatórias a cada post
                $post->tags()->attach(
                    $tags->random(random_int(1, 3))->pluck('id')
                );
            });
        });
    }
}
