<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->crearUsuario();
    }

    //Faker para crear semaforos al azar
    public function creaUsuariosFaker($num)
    {
        //factory(App\Entities\Kardex::class, $num)->create();
    }

    //Creamos semaforos
    public function crearUsuario()
    {
        factory(App\User::class)->create([
            'name'  => 'Admin',
            'lastname'  => 'Root',
            'email'  => 'Admin@hotmail.com',
            'password'   => bcrypt('123456'),
            'id_tipo_usuario'  => '1',
        ]);
    }
}
