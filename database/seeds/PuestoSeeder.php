<?php

use Illuminate\Database\Seeder;
use App\Models\Puesto;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->creaPuesto("Desarrollador Web", "Descripción del perfil");
       $this->creaPuesto("Analista de Riesgos", "Descripción del perfil");
       $this->creaPuesto("Auxiliar Administrativo", "Descripción del perfil");
    }
    public function creaPuesto($nombre, $descripcion)
    {
      $puesto = new Puesto();
      $puesto->nombre = $nombre;
      $puesto->descripcion = $descripcion;
      $puesto->save();
  }
}
