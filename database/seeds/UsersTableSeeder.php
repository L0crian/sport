<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'chukriy@gmail.com',
            'admin' => 1,
            'about' => 'Что то о себе..',
            'avatar' => asset('avatars/avatar.png')
        ]);

        App\User::create([
            'name' => 'Emily Myers',
            'password' => bcrypt('password'),
            'email' => 'emily@myers.com',
            'about' => 'Что то о себе..',
            'avatar' => asset('avatars/avatar.png')
        ]);
    }
}
