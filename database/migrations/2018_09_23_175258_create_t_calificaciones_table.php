<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_calificaciones', function (Blueprint $table) {
            $table->integer('id_t_calificaciones')->autoIncrement();
            $table->integer('id_t_materias');
            $table->integer('id_t_usuarios');
            $table->float('calificacion', 10, 2)->nullable();
            $table->date('fecha_registro')->nullable();
            // Indicamos cual es la clave foránea de estas tablas:
            $table->foreign('id_t_materias')->references('id_t_materias')->on('t_materias');
            $table->foreign('id_t_usuarios')->references('id_t_usuarios')->on('t_alumnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_calificaciones');
    }
}
