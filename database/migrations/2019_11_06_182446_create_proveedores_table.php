<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->text('razon_social');
            $table->string('direccion');
            $table->integer('ubicacion');
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('pagina_web')->nullable();
            $table->integer('giro')->nullable();
            $table->integer('flujo')->nullable();
            $table->string('contacto')->nullable();
            $table->integer('procedencia')->nullable();
            $table->char('declarante', 1)->nullable();
            $table->integer('detraccion')->nullable();
            $table->string('rut');
            $table->char('fecha_vencimiento', 1)->nullable();
            $table->char('agente_reten', 1)->nullable();
            $table->integer('tipo_proveedor')->nullable();
            $table->char('activo', 1);
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
        Schema::dropIfExists('proveedores');
    }
}
