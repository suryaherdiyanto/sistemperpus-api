<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'name' => 'komputer'
        ]);
        \App\Category::create([
            'name' => 'filsafat'
        ]);
        \App\Category::create([
            'name' => 'gaya hidup'
        ]);
        \App\Category::create([
            'name' => 'hukum'
        ]);
        \App\Category::create([
            'name' => 'ekonomi'
        ]);
    }
}
