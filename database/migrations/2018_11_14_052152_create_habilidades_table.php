<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilidades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empleado_id');
            $table->string('nombre', 60);
            $table->tinyInteger('calificacion');
            $table->timestamps();
            // Indicamos cual es la llave foránea de estas tablas:
            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habilidades');
    }
}
