<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
    DB::table('categorias')->truncate();   // Eliminamos registros existentes
    DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
    $this->crearCategorias();
  }

  //Creamos Categorias de Promociones
  public function crearCategorias()
  {
      factory(App\Entities\Categorias::class)->create([
          'nombre_de_categoria'  => 'Comida',
      ]);

      factory(App\Entities\Categorias::class)->create([
          'nombre_de_categoria'  => 'Ropa',
      ]);

      factory(App\Entities\Categorias::class)->create([
          'nombre_de_categoria'  => 'Entretenimiento',
      ]);
  }
}
