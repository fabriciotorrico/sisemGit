<?php

use Illuminate\Database\Seeder;

class TiposDeUsuariosTableSeeder extends Seeder
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
        $this->crearTipoUsuario();
    }

    //Creamos Tipos de Usuarios
    public function crearTipoUsuario()
    {
        factory(App\Entities\TiposDeUsuario::class)->create([
            'tipo_usuario'  => 'admin_root',

        ]);

        factory(App\Entities\TiposDeUsuario::class)->create([
            'tipo_usuario'  => 'colaborador',
        ]);

        factory(App\Entities\TiposDeUsuario::class)->create([
            'tipo_usuario'  => 'admin_empresa',
        ]);

        factory(App\Entities\TiposDeUsuario::class)->create([
            'tipo_usuario'  => 'cajero',
        ]);

        factory(App\Entities\TiposDeUsuario::class)->create([
            'tipo_usuario'  => 'cliente',
        ]);
    }
}
