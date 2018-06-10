<?php

use Illuminate\Database\Seeder;

class PersonasTableSeeder extends Seeder
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
      $this->crearPersonas();
    }

    //Creamos Personas
    public function crearPersonas()
    {
        factory(App\Entities\Personas::class)->create([
            'id_persona'  => '1',
            'name'  => 'Fabricio',
            'lastname'  => 'Torrico',
            'id_ciudad'  => '1',
            'edad'  => '23',
            'sexo'  => 'Masculino',
        ]);
    }
}
