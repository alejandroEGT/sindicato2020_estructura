<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeudasCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deudas_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id');
            $table->integer('tipo_deuda_id');
            $table->bigInteger('monto');
            $table->string('descripcion');
            $table->date('fecha');
            $table->char('activo',1);
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
        Schema::dropIfExists('deudas_cliente');
    }
}
