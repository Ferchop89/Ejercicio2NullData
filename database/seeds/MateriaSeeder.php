<?php

use Illuminate\Database\Seeder;

use App\TMateria;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $this->createMateria("matematicas", 1);
       $this->createMateria("programacion I", 1);
       $this->createMateria("ingenieria de software", 1);
     }
     public function createMateria($nombre, $activo)
     {
       $materia = new TMateria();
       $materia->nombre = $nombre;
       $materia->activo = $activo;
       $materia->save();
    }
}
