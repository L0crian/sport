<?php

use Illuminate\Database\Seeder;

class MusclesGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MuscleGroup::class, 7)->create();
    }
}
