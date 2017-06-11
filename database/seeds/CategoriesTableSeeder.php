<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel', 'parent_id' => 0 ];
        $channel2 = ['title' => 'Vuejs', 'parent_id' => 0 ];
        $channel3 = ['title' => 'Javascript', 'parent_id' => 0 ];
        $channel4 = ['title' => 'CSS3', 'parent_id' => 1];
        $channel5 = ['title' => 'PHP Testing', 'parent_id' => 2];


        Category::create($channel1);
        Category::create($channel2);
        Category::create($channel3);
        Category::create($channel4);
        Category::create($channel5);
    }
}
