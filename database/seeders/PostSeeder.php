<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Faker::create();

        for ($i = 0; $i < 25; $i++) {
            Post::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph(5),
                'category_id'
               
        ]);
    }
}
}