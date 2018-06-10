<?php

use Illuminate\Database\Seeder;

class CuponesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
    DB::table('cupones')->truncate();   // Eliminamos registros existentes
    DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
    $this->crearCupones();
  }

  //Creamos Ciudades
  public function crearCupones()
  {
      factory(App\Entities\Cupones::class)->create([
          'id_codigo_promocion'  => 'LP-BK-RODEO',
          'id_cliente'           => '1',
          'codigo_de_cupon'      => 'QWERTY123',
          'comprado'             => '1',
          'fecha_comprado'       => '2018-05-13 00:54:02',
          'utilizado'            => '0',
      ]);

      factory(App\Entities\Cupones::class)->create([
          'id_codigo_promocion'  => 'LP-BK-RODEO',
          'id_cliente'           => '1',
          'codigo_de_cupon'      => 'QWERTY456',
          'comprado'             => '1',
          'fecha_comprado'       => '2018-05-13 00:54:02',
          'utilizado'            => '1',
          'fecha_utilizado'      => '2018-05-15 00:54:02',
          'id_cajero'            => '7',
      ]);
  }
}
