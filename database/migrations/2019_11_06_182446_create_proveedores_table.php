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
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('rut');
            $table->text('razon_social');
            $table->string('telefono');
            $table->string('correo');
            $table->string('pagina_web');
            $table->integer('giro_prov_id');
            $table->string('direccion');
            $table->string('ciudad');
            $table->integer('estado_prov_id')->nullable();
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
