<?php

use Illuminate\Database\Seeder;

class SemaforoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->crearSemaforos();
    }

    //Faker para crear semaforos al azar
    public function creaSemaforosFaker($num)
    {
        //factory(App\Entities\Kardex::class, $num)->create();
    }

    //Creamos semaforos
    public function crearSemaforos()
    {
        factory(App\Entities\Semaforo::class)->create([
            'ip'  => '192.168.1.1',
            'lat'  => '1.5',
            'lng'   => '2.5',
            't_rojo'   => '10',
            't_amarillo'   => '20',
            't_verde'     => '30',
            'vehiculos'  => '19',
            'descripcion'     => 'Semaforo villalobos',
        ]);

        factory(App\Entities\Semaforo::class)->create([
            'ip'  => '192.168.1.2',
            'lat'  => '-16.502586',
            'lng'   => '-68.120895',
            't_rojo'   => '10',
            't_amarillo'   => '20',
            't_verde'     => '30',
            'vehiculos'  => '192',
            'descripcion'     => 'Semaforo villalobos',
        ]);
    }
}
