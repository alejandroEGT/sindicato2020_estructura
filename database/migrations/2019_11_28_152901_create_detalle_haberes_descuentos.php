<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleHaberesDescuentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liq_detalle_haberes_descuentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_detalle'); // 1 = haberes, 2 = descuento
            $table->text('concepto');
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
        Schema::dropIfExists('liq_detalle_haberes_descuentos');
    }
}
