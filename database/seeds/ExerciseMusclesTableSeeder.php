<?php

use Illuminate\Database\Seeder;

class ExerciseMusclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ExerciseMuscle::class, 30)->create();
    }
}
