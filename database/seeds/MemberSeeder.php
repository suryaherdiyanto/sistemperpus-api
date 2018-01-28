<?php

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Member::create([
            'nickname' => 'surya',
            'full_name' => 'i gede surya herdiyanto',
            'genre' => 1,
            'email' => 'suryaherdiyanto@gmail.com',
            'phone' => '081999283771',
            'address' => 'panjer'
        ]);
    }
}
