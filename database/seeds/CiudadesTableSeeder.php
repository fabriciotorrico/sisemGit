<?php

use Illuminate\Database\Seeder;

class CiudadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
      DB::table('tipos_de_usuarios')->truncate();   // Eliminamos registros existentes
      DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
      $this->crearCiudades();
    }

    //Creamos Ciudades
    public function crearCiudades()
    {
        factory(App\Entities\Ciudades::class)->create([
            'id_ciudad'  => '1',
            'ciudad'  => 'La Paz',
        ]);

        factory(App\Entities\Ciudades::class)->create([
            'id_ciudad'  => '2',
            'ciudad'  => 'Santa Cruz',
        ]);
    }
}
