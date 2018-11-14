<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
   protected $hidden = [
      'created_at',
      'updated_at',
    ];
    public function empleado(){
      return $this->belongsTo('App\Models\Empleado', 'id'); // Le indicamos que se va relacionar con el atributo id
   }
}
