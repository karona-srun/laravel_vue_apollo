<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::truncate();
        \App\Models\Post::unguard();

        $faker = \Faker\Factory::create();

         \App\Models\User::all()->each(function ($user) use ($faker) {
            foreach (range(1, 5) as $i) {
                \App\Models\Post::create([
                    'title'   => $faker->sentence,
                    'description' => $faker->paragraphs(3, true),
                    'status' => true,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]);
            }
        });
    }
}
