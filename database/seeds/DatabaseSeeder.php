<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
           'users',
           't_materias',
           't_alumnos',
           't_calificaciones',
           'puestos',
           'empleados',
           'habilidades'
        ]);
        $this->call(UserSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(MateriaSeeder::class);
        $this->call(PuestoSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(HabilidadSeeder::class);
    }
    protected function truncateTables(array $tables){
      DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
      foreach ($tables as $table) {
        DB::table($table)->truncate();
      }
      DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
