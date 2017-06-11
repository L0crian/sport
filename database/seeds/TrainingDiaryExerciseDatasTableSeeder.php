<?php

use Illuminate\Database\Seeder;

class TrainingDiaryExerciseDatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TrainingDiaryExerciseData::class, 40)->create();
    }
}
