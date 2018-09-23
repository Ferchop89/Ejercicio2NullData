<?php

use Illuminate\Database\Seeder;

use App\TAlumno;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createAlumno("John", "Dow", "Down", 1);
    }
    public function createAlumno($nombre, $apPaterno, $apMaterno, $activo)
    {
      $alumno = new TAlumno();
      $alumno->nombre = $nombre;
      $alumno->ap_paterno = $apPaterno;
      $alumno->ap_materno = $apMaterno;
      $alumno->activo = $activo;
      $alumno->save();
   }
}
