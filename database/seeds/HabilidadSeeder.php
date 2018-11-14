<?php

use Illuminate\Database\Seeder;
use App\Models\Habilidad;

class HabilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->creaHabilidad(1, "Comunicación", 5);
      $this->creaHabilidad(1, "Organización", 5);
      $this->creaHabilidad(1, "Trabajo en Equipo", 5);
    }
    public function creaHabilidad($idEmpleado, $nombre, $calificacion)
    {
      $skill = new Habilidad();
      $skill->empleado_id = $idEmpleado;
      $skill->nombre = $nombre;
      $skill->calificacion = $calificacion;
      $skill->save();
    }
}
