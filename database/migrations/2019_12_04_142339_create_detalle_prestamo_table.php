<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePrestamoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_prestamo', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('cuota');
            $table->bigInteger('monto');
            $table->string('estado');
            $table->integer('idPrestamo');
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
        Schema::dropIfExists('detalle_prestamo');
    }
}
