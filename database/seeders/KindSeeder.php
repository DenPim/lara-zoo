<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kinds')->insert([
            'kind' => 'cat',
            'max_size' => rand(30, 100),
            'max_age' => rand(50, 100),
            'growth_factor' => rand(1, 2) . '.' . rand(1, 9),
        ]);
        DB::table('kinds')->insert([
            'kind' => 'dog',
            'max_size' => rand(30, 100),
            'max_age' => rand(50, 100),
            'growth_factor' => rand(1, 2) . '.' . rand(1, 9),
        ]);
        DB::table('kinds')->insert([
            'kind' => 'bird',
            'max_size' => rand(30, 100),
            'max_age' => rand(50, 100),
            'growth_factor' => rand(1, 2) . '.' . rand(1, 9),
        ]);
        DB::table('kinds')->insert([
            'kind' => 'pig',
            'max_size' => rand(30, 100),
            'max_age' => rand(50, 100),
            'growth_factor' => rand(1, 2) . '.' . rand(1, 9),
        ]);
    }
}
