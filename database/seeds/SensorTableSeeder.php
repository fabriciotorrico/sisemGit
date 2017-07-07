<?php

use Illuminate\Database\Seeder;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->crearSensores();
    }

    //Faker para crear sensores al azar
    public function creaSensoressFaker($num)
    {
        //factory(App\Entities\Kardex::class, $num)->create();
    }

    //Creamos semaforos
    public function crearSensores()
    {
      factory(App\Entities\Sensor::class)->create([
          'ip'  => '192.168.1.1',
          'vehiculos'  => '19',
      ]);
    }
}
