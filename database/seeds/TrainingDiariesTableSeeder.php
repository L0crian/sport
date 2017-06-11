<?php

use Illuminate\Database\Seeder;

class TrainingDiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TrainingDiary::class, 40)->create();
    }
}
