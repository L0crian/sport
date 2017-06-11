<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ChannelsTableSeeder::class);
        $this->call(DiscussionsTableSeeder::class);
        $this->call(RepliesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(MusclesTableSeeder::class);
        $this->call(MusclesGroupsTableSeeder::class);
        $this->call(ExercisesTableSeeder::class);
        $this->call(ExerciseMusclesTableSeeder::class);
        $this->call(ExerciseDatasTableSeeder::class);
        $this->call(ExerciseGroupMusclesTableSeeder::class);
        $this->call(TrainingDiariesTableSeeder::class);
        $this->call(TrainingDiaryExerciseDatasTableSeeder::class);

    }
}
