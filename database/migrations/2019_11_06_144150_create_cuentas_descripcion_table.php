<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasDescripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_descripcion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuenta_id');
            $table->date('fecha');
            $table->text('codigo')->nullable();
            $table->text('descripcion');
            $table->integer('sub_cuenta_id');
            $table->integer('tipo_monto_id');
            $table->bigInteger('monto_ingreso')->nullable();
            $table->bigInteger('monto_egreso')->nullable();
            $table->bigInteger('user_crea')->nullable();
            $table->text('archivo')->nullable();
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
        Schema::dropIfExists('cuentas_descripcion');
    }
}
