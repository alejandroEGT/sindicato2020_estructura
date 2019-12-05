<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacion', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->bigInteger('empleado_id');
            $table->text('empresa');
            $table->text('rut');
            $table->integer('cargo_id');
            $table->bigInteger('sueldo_base_mensual');
            $table->integer('dias_trabajados');
            $table->integer('horas_extras');
            $table->bigInteger('valor_horas_extras');
            $table->bigInteger('valor_horas_ordinarias');
            $table->integer('afp_id');
            $table->integer('isapre_id');
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
        Schema::dropIfExists('liquidacion');
    }
}
