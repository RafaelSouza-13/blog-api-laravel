<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            TagSeeder::class,
        ]);
        $tags = Tag::all();

        // Criar usuário com posts
        User::factory()->create([
                'name' => 'Rafael Souza',
                'email' => 'rafa@example.com',
            ])->each(function ($user) use ($tags) {
                $user->posts()->saveMany(
                    \App\Models\Post::factory()->count(5)->make()
                )->each(function ($post) use ($tags) {
                    // Associa entre 1 e 3 tags reais a cada post
                    $post->tags()->attach(
                        $tags->random(random_int(1, 3))->pluck('id')
                    );
                });
            });

        $this->call([
            UserSeeder::class,
        ]);
    }
}
