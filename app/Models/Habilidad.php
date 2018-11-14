<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
   protected $table = 'habilidades';
   protected $hidden = [
      'created_at',
      'updated_at',
    ];
    protected $fillable = [
      'empleado_id',
      'nombre',
      'calificacion',
   ];

    public function empleado() {
      return $this->belongsTo('App\Models\Empleado', 'id'); // Le indicamos que se va relacionar con el atributo id
   }
}
