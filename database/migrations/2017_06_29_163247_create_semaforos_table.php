<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemaforosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semaforos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('ip', 15);
            $table->double('lat',25,20);
            $table->double('lng',25,20);
            $table->integer('t_rojo');
            $table->integer('t_amarillo');
            $table->integer('t_verde');
            $table->text('descripcion');
            $table->integer('vehiculos');
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
        Schema::dropIfExists('semaforos');
    }
}
