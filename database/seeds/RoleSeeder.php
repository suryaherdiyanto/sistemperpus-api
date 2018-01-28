<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
            'name' => 'petugas'
        ]);
        App\Role::create([
            'name' => 'kabag'
        ]);
        App\Role::create([
            'name' => 'admin'
        ]);
    }
}
