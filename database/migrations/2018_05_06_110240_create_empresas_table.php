<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
          $table->increments('id_empresa');
          $table->integer('id_contrato')->unsigned()->nullable();
          $table->integer('id_ciudad')->unsigned()->nullable();
          $table->double('lat',25,20);
          $table->double('lng',25,20);
          $table->string('nombre');
          $table->string('logo');
          $table->boolean('activo')->default(true);
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
        Schema::dropIfExists('empresas');
    }
}
