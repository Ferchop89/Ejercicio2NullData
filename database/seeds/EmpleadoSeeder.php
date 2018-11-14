<?php

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->creaEmpleado("Fernando", "Pacheco", "Estrada", 1, "1989-01-01", "04600", "San Castulo", "Mz 630 lt 15", "Pedregal de Santa Ursula Coapa", "Coyoacan", "Ciudad de México");
        $this->creaEmpleado("Mateo", "Espinosa", "Cortes", 2, "1990-01-29", "04480", "Elvira Vargas", "Ext 41, depto 303", "CTM Culhuacan", "Coyoacan", "Ciudad de México");
    }

    public function creaEmpleado($nombre, $apP, $apM, $puestoId, $fNac, $cp, $calle, $numero, $colonia, $delMun, $estado)
    {
      $empleado = new Empleado();
      $empleado->nombre =$nombre;
      $empleado->ap_paterno = $apP;
      $empleado->ap_materno = $apM;
      $empleado->puesto_id = $puestoId;
      $empleado->fecha_nacimiento = $fNac;
      $empleado->cp = $cp;
      $empleado->calle = $calle;
      $empleado->numero = $numero;
      $empleado->colonia = $colonia;
      $empleado->del_mun = $delMun;
      $empleado->estado = $estado;
      $empleado->save();
    }
}
