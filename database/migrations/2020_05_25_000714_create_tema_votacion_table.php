<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemaVotacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tema_votacion', function (Blueprint $table) {
            $table->increments('id');
            $table->text('titulo');
            $table->text('detalle');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('user_crea');
            $table->integer('estado_tema');//1-abierta,2-cerrada
            $table->integer('estado_votacion');//1-abierta, 2-aprobada, 3-rechazada, 4-me abstengo
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
        Schema::dropIfExists('tema_votacion');
    }
}
