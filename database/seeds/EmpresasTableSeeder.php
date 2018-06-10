<?php

use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
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
      $this->crearEmpresas();
    }

    //Creamos Empresas
    public function crearEmpresas()
    {
        factory(App\Entities\Empresas::class)->create([
            'id_empresa'  => '1',
            'id_contrato'  => '1',
            'id_ciudad'  => '1',
            'lat'  => '22.12345',
            'lng'  => '21.54321',
            'nombre'  => 'Burger King',
            'logo'  => 'bk.jpg',
            'activo'  => '1',
        ]);
    }
}
