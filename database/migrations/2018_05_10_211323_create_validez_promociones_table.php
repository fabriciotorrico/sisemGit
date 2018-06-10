<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidezPromocionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validez_promociones', function (Blueprint $table) {
            $table->increments('id_validez');
            $table->integer('id_codigo_promocion')->unsigned()->nullable();
            $table->text('dia');
            $table->time('de_horas'); //Revisar el tipo de dato para que entre horas!
            $table->time('a_horas'); //Revisar el tipo de dato para que entre horas!
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
        Schema::dropIfExists('validez_promociones');
    }
}
