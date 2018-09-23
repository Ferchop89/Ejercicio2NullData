<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TCalificacion extends Model
{
   protected $table = 't_calificaciones';
   protected $primaryKey = 'id_t_calificaciones';
   protected $fillable = [
      'id_t_materias',
      'id_t_usuarios',
      'calificacion',
      'fecha_registro',
   ];
}
