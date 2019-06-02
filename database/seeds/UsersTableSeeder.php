<?php

use Illuminate\Database\Seeder;

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

        DB::table('users')->insert([
            [
                'name' => 'Dean',
                'email' => 'dean@mail.com',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Sam',
                'email' => 'sam@mail.com',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'castiel',
                'email' => 'castiel@mail.com',
                'password' => bcrypt('12345')
            ]
        ]);
    }
}
