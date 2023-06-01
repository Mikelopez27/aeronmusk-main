<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SECCION A
        DB::table('groups')->insert([
            'grade_id' => 1,
            'section_id' => 1
        ]);
        DB::table('groups')->insert([
            'grade_id' => 2,
            'section_id' => 1
        ]);
        DB::table('groups')->insert([
            'grade_id' => 3,
            'section_id' => 1
        ]);
        DB::table('groups')->insert([
            'grade_id' => 4,
            'section_id' => 1
        ]);
        DB::table('groups')->insert([
            'grade_id' => 5,
            'section_id' => 1
        ]);
        DB::table('groups')->insert([
            'grade_id' => 6,
            'section_id' => 1
        ]);

        //SECCION B
        DB::table('groups')->insert([
            'grade_id' => 1,
            'section_id' => 2
        ]);
        DB::table('groups')->insert([
            'grade_id' => 2,
            'section_id' => 2
        ]);
        DB::table('groups')->insert([
            'grade_id' => 3,
            'section_id' => 2
        ]);
        DB::table('groups')->insert([
            'grade_id' => 4,
            'section_id' => 2
        ]);
        DB::table('groups')->insert([
            'grade_id' => 5,
            'section_id' => 2
        ]);
        DB::table('groups')->insert([
            'grade_id' => 6,
            'section_id' => 2
        ]);

        //SECCION C
        DB::table('groups')->insert([
            'grade_id' => 1,
            'section_id' => 3
        ]);
        DB::table('groups')->insert([
            'grade_id' => 2,
            'section_id' => 3
        ]);
        DB::table('groups')->insert([
            'grade_id' => 3,
            'section_id' => 3
        ]);
        DB::table('groups')->insert([
            'grade_id' => 4,
            'section_id' => 3
        ]);
        DB::table('groups')->insert([
            'grade_id' => 5,
            'section_id' => 3
        ]);
        DB::table('groups')->insert([
            'grade_id' => 6,
            'section_id' => 3
        ]);
    }
}
