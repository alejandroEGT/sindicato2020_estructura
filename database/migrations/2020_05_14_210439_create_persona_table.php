<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('socio_id');
            $table->integer('tipo_familiar');
            $table->text('nombres');
            $table->text('apellidos');
            $table->string('rut');
            $table->date('fecha_nacimiento');
            $table->text('dirección');
            $table->text('celular');
            $table->text('certificado_conyuge')->nullable();
            $table->char('beneficiario', 1)->nullable();
            $table->integer('orden_beneficiario');
            $table->char('carga', 1)->nullable();
            $table->text('certificado_carga')->nullable();
            $table->char('activo');
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
        Schema::dropIfExists('persona');
    }
}
