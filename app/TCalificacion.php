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
   public $timestamps = false;
   protected $dateFormat = 'd/m/Y';

   // public function alumno() {
   //    return $this->hasOne('App\TAlumno', 'id_t_usuarios'); // Le indicamos que se va relacionar con el atributo id
   // }
   public function alumno() {
      return $this->belongsTo('App\TAlumno', 'id_t_usuarios'); // Le indicamos que se va relacionar con el atributo id
   }
   public function materia() {
      return $this->belongsTo('App\TMateria', 'id_t_materias'); // Le indicamos que se va relacionar con el atributo id
   }

}
