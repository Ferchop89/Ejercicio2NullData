<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TMateria extends Model
{
   protected $table = 't_materias';
   protected $primaryKey = 'id_t_materias';
   protected $fillable = [
     'nombre',
     'activo',
   ];
   public $timestamps = false;
   public function calificaciones(){
      return $this->belongsTo('App/TCalificacion');
   }
}
