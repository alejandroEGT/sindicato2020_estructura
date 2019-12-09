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
            $table->text('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('rut');
            $table->text('direccion');
            $table->text('telefono');
            $table->date('fecha_contrato');
            $table->bigInteger('departamento_id');
            $table->text('cargo_id');
            $table->text('puesto_trabajo');
            $table->timestamps();

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
