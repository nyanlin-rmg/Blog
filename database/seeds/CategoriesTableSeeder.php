<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        DB::table('categories')->insert([
            [
                'title' => 'Web Design',
                'slug' => 'web-design'
            ],
            [
                'title' => 'Web Programming',
                'slug' => 'web-programming'
            ],
            [
                'title' => 'Internet',
                'slug' => 'internet'
            ],
            [
                'title' => 'Social Marketing',
                'slug' => 'social-marketing'
            ],
            [
                'title' => 'Photography',
                'slug' => 'photography'
            ]
        ]);
        
        for($i = 1; $i <= 10; $i++) {
            $category_id = rand(1, 5);
            DB::table('posts')
                ->where('id', $i)
                ->update(['category_id' => $category_id]);
        }
    }
}
