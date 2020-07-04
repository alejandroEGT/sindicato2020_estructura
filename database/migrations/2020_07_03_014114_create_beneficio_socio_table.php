<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficioSocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficio_socio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('socio_id');
            $table->integer('persona_id')->nullable();
            $table->string('tipo');
            $table->text('archivo_1')->nullable();
            $table->text('archivo_2')->nullable();
            $table->date('fecha');
            $table->bigInteger('monto');
            $table->text('numero_comprobante')->nullable();
            $table->text('detalle');
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
        Schema::dropIfExists('beneficio_socio');
    }
}
