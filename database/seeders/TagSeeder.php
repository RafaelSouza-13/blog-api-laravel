<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name' => 'PHP']);
        Tag::create(['name' => 'Laravel']);
        Tag::create(['name' => 'JavaScript']);
        Tag::create(['name' => 'HTML']);
        Tag::create(['name' => 'CSS']);
        Tag::create(['name' => 'MySQL']);
        Tag::create(['name' => 'Vue.js']);
        Tag::create(['name' => 'React']);
        Tag::create(['name' => 'Node.js']);
        Tag::create(['name' => 'API']);
        Tag::create(['name' => 'Testing']);
        Tag::create(['name' => 'Deployment']);
        Tag::create(['name' => 'Security']);
        Tag::create(['name' => 'Python']);
        Tag::create(['name' => 'Django']);
        Tag::create(['name' => 'Flask']);
        Tag::create(['name' => 'IA']);
    }
}
