<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();

        $faker = \Faker\Factory::create();
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; //password

        \App\Models\User::create([
            'first_name' => "Karona",
            'last_name' => "Srun",
            'tel' => "086773007",
            'email' => "graphql@gmail.com",
            'avatar' => $faker->optional($weight = 0.9)->userName,
            'email_verified_at' => now(),
            'password' => $password,
            'api_token' => Str::random(80),
            'remember_token' => Str::random(10),
        ]);

        for ($i = 0; $i < 10; ++$i) {
            \App\Models\User::create([
                'first_name' => $faker->lastName,
                'last_name' =>  $faker->firstName,
                'tel' => $faker->unique()->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'avatar' => $faker->optional($weight = 0.9)->userName,
                'email_verified_at' => now(),
                'password' => $password,
                'api_token' => Str::random(80),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
