<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupones', function (Blueprint $table) {
            $table->increments('id_cupon');
            $table->string('id_codigo_promocion');
            $table->integer('id_cliente')->unsigned()->nullable();
            $table->string('codigo_de_cupon')->unique();
            $table->boolean('comprado')->default(false);
            $table->dateTime('fecha_comprado'); //Si no sirve, proar con date
            $table->boolean('utilizado')->default(false);
            $table->dateTime('fecha_utilizado')->nullable(); //Si no sirve, proar con date
            $table->integer('id_cajero')->unsigned()->nullable();
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
        Schema::dropIfExists('cupones');
    }
}
