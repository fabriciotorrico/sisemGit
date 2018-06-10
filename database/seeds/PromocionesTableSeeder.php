<?php

use Illuminate\Database\Seeder;

class PromocionesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
    DB::table('promociones')->truncate();   // Eliminamos registros existentes
    DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
    $this->crearPromociones();
  }

  //Creamos Personas
  public function crearPromociones()
  {
      factory(App\Entities\Promociones::class)->create([
          'codigo_promocion'    => 'LP-BK-RODEO',
          'id_categoria'           => '1',
          'id_empresa'             => '1',
          'imagen'                 => 'img/img_promociones/LP-BK-RODEO.jpg',
          'nombre'                 => 'Hambrugesa Rodeo',
          'descripcion'            => 'Doble carne de whopper a la parrilla, aros de cebolla empanizados, queso  y salsa BBQ. ¡Comprala con un 40% de descuento!',
          'precio_real'            => '45',
          'precio_promocion'       => '27',
          'precio_pagar'           => '0',
          'cantidad_requerida'     => '50',
          'restantes'              => '20',
          'activo'                 => '1',
      ]);

      factory(App\Entities\Promociones::class)->create([
          'codigo_promocion'    => 'LP-BK-NUGGETS',
          'id_categoria'           => '1',
          'id_empresa'             => '1',
          'imagen'                 => 'img/img_promociones/LP-BK-NUGGETS.jpg',
          'nombre'                 => 'Nuggets de Pollo',
          'descripcion'            => 'Nuevos deliciosos, crujientes, dorados Chicken Nuggets… dipéalos en su sabrosa salsa. ¡Compralo con un 50% de descuento! Paga Bs. 5
                                        por el cupón y Bs. 10 en cajas al canjear tu cupón.',
          'precio_real'            => '30',
          'precio_promocion'       => '15',
          'precio_pagar'           => '10',
          'cantidad_requerida'     => '20',
          'restantes'              => '5',
          'activo'                 => '1',
      ]);
  }
}
