<?php

use Illuminate\Database\Seeder;

class ExerciseDatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ExerciseData::class, 120)->create();
    }
}
