<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleHaberesDescuentosEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liq_detalle_haberes_descuentos_empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('liquidacion_id');
            $table->bigInteger('liq_detalle_haberes_descuentos_id');
            $table->bigInteger('empleado_id');
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
        Schema::dropIfExists('liq_detalle_haberes_descuentos_empleado');
    }
}
