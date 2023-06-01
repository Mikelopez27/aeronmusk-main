<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //SEEDER ROL
        $this->call(RolSeeder::class);
        //SEEDER SECCIONES Y GRADOS
        $this->call(SectionSeeder::class);
        $this->call(GradeSeeder::class);
        //SEEDER GRUPOS
        $this->call(GroupSeeder::class);
       //SEEDER NIVELES EDUCACTIVOS
        $this->call(Nivel::class);
        //SEEDER PARA USUARIOS
        $this->call(AdminSeeder::class);
        //SEDDER PARA VER SI JALA DOCENTES
       ///$this->call(DocenteSeeder::class);
      //  $this->call(Comentarios::class);
       // $this->call(EncuestasSeeder::class);
        
    }
}
