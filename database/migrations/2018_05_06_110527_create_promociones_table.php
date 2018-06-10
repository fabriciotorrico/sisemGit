<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->increments('id_promocion');
            $table->string('codigo_promocion')->unique();
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->integer('id_empresa')->unsigned()->nullable();
            $table->string('imagen');
            $table->string('nombre');
            $table->text('descripcion');
            $table->double('precio_real',6,2);
            $table->double('precio_promocion',6,2);
            $table->double('precio_pagar',6,2);
            $table->integer('cantidad_requerida')->unsigned();
            $table->integer('restantes')->unsigned();
            $table->boolean('activo')->default(false);
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
        Schema::dropIfExists('promociones');
    }
}
