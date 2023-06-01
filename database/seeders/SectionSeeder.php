<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'name' => 'A'
        ]);
        DB::table('sections')->insert([
            'name' => 'B'
        ]);
        DB::table('sections')->insert([
            'name' => 'C'
        ]);
    }
}
