<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
   // protected $dateFormat = 'd-m-Y';

   protected $casts = [
      'activo' => 'boolean'
   ];
   protected $hidden = [
      'activo',
      'created_at',
      'updated_at',
   ];
   protected $fillable = [
      'nombre',
      'ap_paterno',
      'ap_materno',
      'puesto_id',
      'fecha_nacimiento',
      'cp',
      'calle',
      'numero',
      'colonia',
      'del_mun',
      'estado',
   ];
}
