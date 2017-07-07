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
        this->crearUsuario();
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
            'name'  => 'Admin Root',
            'email'  => 'abcdef@hotmail.com',
            'password'   => bcrypt('abcdef'),
        ]);
    }
}
