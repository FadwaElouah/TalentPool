<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidatureStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('candidature_states')->insert([
            ['name' => 'submitted', 'color' => 'blue'],
            ['name' => 'reviewing', 'color' => 'orange'],
            ['name' => 'interview', 'color' => 'green'],
            ['name' => 'rejected', 'color' => 'red'],
            ['name' => 'accepted', 'color' => 'purple'],
        ]);
    }
}
