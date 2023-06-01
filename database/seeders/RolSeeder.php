<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
            'name' => 'admin',
            'description' => 'adjkaljdkaljdklasjd'
        ]);

        DB::table('rols')->insert([
            'name' => 'docente',
            'description' => 'adjkaljdkaljdklasjd'
        ]);

        DB::table('rols')->insert([
            'name' => 'alumno',
            'description' => 'adjkaljdkaljdklasjd'
        ]);
    }
}
