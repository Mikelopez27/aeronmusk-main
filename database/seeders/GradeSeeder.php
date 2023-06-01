<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            'name' => '1'
        ]);
        DB::table('grades')->insert([
            'name' => '2'
        ]);
        DB::table('grades')->insert([
            'name' => '3'
        ]);
        DB::table('grades')->insert([
            'name' => '4'
        ]);
        DB::table('grades')->insert([
            'name' => '5'
        ]);
        DB::table('grades')->insert([
            'name' => '6'
        ]);
    }
}
