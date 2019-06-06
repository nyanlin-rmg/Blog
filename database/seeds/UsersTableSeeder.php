<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $faker = Factory::create();

        DB::table('users')->insert([
            [
                'name' => 'Dean',
                'slug' => 'dean',
                'email' => 'dean@mail.com',
                'password' => bcrypt('12345'),
                'created_at' => now(),
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'name' => 'Sam',
                'slug' => 'sam',
                'email' => 'sam@mail.com',
                'password' => bcrypt('12345'),
                'created_at' => now(),
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'name' => 'Castiel',
                'slug' => 'castiel',
                'email' => 'castiel@mail.com',
                'password' => bcrypt('12345'),
                'created_at' => now(),
                'bio' => $faker->text(rand(250, 300))
            ]
        ]);
    }
}
