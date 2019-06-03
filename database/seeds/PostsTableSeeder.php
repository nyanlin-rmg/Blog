<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        $posts = [];
        $faker = Factory::create();
        $date = Carbon::create(2019, 6, 1, 10);

        for($i = 0; $i < 10; $i++)
        {
            $image = "Post_Image_" . rand(1,7) . ".jpg";
            $date = $date->addDays($i);


            $posts[] = [
                'author_id' => rand(1,3),
                'title' => $faker->sentence(rand(8,12)),
                'excerpt' => $faker->text(rand(260, 300)),
                'body' => $faker->paragraphs(rand(10, 15), true),
                'slug' => $faker->slug(),
                'image' => $image ? : $image = NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'published' => rand(true, false)
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
