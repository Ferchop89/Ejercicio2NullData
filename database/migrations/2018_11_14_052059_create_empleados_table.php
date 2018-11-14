<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 80)->nullable();
            $table->string('ap_paterno', 80)->nullable();
            $table->string('ap_materno', 80)->nullable();
            $table->unsignedInteger('puesto_id');
            $table->date('fecha_nacimiento');
            $table->string('cp', 5);
            $table->string('calle', 100)->nullable();
            $table->string('numero', 40)->nullable();
            $table->string('colonia', 60)->nullable();
            $table->string('del_mun', 50)->nullable();
            $table->string('estado', 45)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Indicamos cual es la llave foránea de estas tablas:
            $table->foreign('puesto_id')->references('id')->on('puestos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
