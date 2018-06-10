<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministradoresClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores_clientes', function (Blueprint $table) {
          $table->increments('id_administrador_cliente');
          $table->integer('id_persona')->unsigned();
          $table->integer('id_tipo_usuario')->unsigned();
          $table->string('email')->unique();
          $table->string('password');
          $table->boolean('activo')->default(true);
          $table->rememberToken();
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
        Schema::dropIfExists('administradores_clientes');
    }
}
