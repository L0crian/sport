<?php

use Illuminate\Database\Seeder;

class MusclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Muscle::class, 7)->create();
    }
}
