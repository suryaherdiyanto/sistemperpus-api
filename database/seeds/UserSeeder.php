<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'surya',
            'email' => 'surya@gmail.com',
            'password' => '123qwe',
            'role_id' => 3
        ]);
    }
}
