<?php

use Illuminate\Database\Seeder;

class ExerciseGroupMusclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ExerciseMuscleGroup::class, 30)->create();
    }
}
