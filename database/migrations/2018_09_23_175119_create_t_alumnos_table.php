<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_alumnos', function (Blueprint $table) {
           $table->integer('id_t_usuarios')->autoIncrement();
           $table->string('nombre', 80)->nullable();
           $table->string('ap_paterno', 80)->nullable();
           $table->string('ap_materno', 80)->nullable();
           $table->boolean('activo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_alumnos');
    }
}
