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
        // $this->call('UsersTableSeeder');
        App\Role::create([
          'name' => 'petugas'
        ]);
        App\Role::create([
          'name' => 'kabag'
        ]);
        App\Role::create([
          'name' => 'admin'
        ]);
        App\User::create([
          'name' => 'surya',
          'email' => 'surya@gmail.com',
          'password' => app('hash')->make('123qwe'),
          'role_id' => 3
        ]);
    }
}
