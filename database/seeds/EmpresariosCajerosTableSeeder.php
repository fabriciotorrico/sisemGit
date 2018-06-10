<?php

use Illuminate\Database\Seeder;

class EmpresariosCajerosTableSeeder extends Seeder
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
      $this->crearEmpresariosCajeros();
    }

    //Creamos EmpresariosCajeros
    public function crearEmpresariosCajeros()
    {
        factory(App\Entities\EmpresariosCajeros::class)->create([
            'id'  => '1',
            'id_persona'  => '1',
            'id_tipo_usuario'  => '3',
            'id_empresa'  => '1',
            'email'  => 'empresa@hotmail.com',
            'password'  => bcrypt('123456'),
            'activo'  => '1',
        ]);
    }
}
