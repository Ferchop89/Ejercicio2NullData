<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TAlumno extends Model
{
   protected $table = 't_alumnos';
   protected $primaryKey = 'id_t_usuarios';
   protected $fillable = [
     'nombre',
     'ap_paterno',
     'ap_materno',
     'activo',
  ];
  public $timestamps = false;

  public function calificaciones(){
     return $this->belongsTo('App/TCalificacion');
 }
}
