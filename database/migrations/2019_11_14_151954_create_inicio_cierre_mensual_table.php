<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInicioCierreMensualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inicio_cierre_mensual', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('cuenta_id');
            $table->integer('mes');
            $table->integer('anio');
            $table->integer('inicio_mensual')->nullable();
            $table->integer('cierre_mensual')->nullable();
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
        Schema::dropIfExists('inicio_cierre_mensual');
    }
}
