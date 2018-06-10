<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


//Para semaforos
$factory->define(App\Entities\Semaforo::class, function (Faker\Generator $faker) {
    return [
        //'t_rojo'  => $faker>numberBetween($min = 1, $max = 10),
        //'t_amarillo' => $faker>numberBetween($min = 1, $max = 10),
    ];
});

//Para sensores
$factory->define(App\Entities\Sensor::class, function (Faker\Generator $faker) {
    return [
        //'t_rojo'  => $faker>numberBetween($min = 1, $max = 10),
        //'t_amarillo' => $faker>numberBetween($min = 1, $max = 10),
    ];
});


//Para tipos de usuarios
$factory->define(App\Entities\TiposDeUsuario::class, function (Faker\Generator $faker) {
    return [
        'tipo_usuario' => $faker->name,
    ];
});

//Para ciudades
$factory->define(App\Entities\Ciudades::class, function (Faker\Generator $faker) {
    return [
        'ciudad' => $faker->name,
    ];
});

//Para empresas
$factory->define(App\Entities\Empresas::class, function (Faker\Generator $faker) {
    return [
        'id_empresa'   => $faker->numberBetween($min = 1, $max = 10),
        'id_contrato'  => $faker->numberBetween($min = 1, $max = 10),
        'id_ciudad'    => $faker->numberBetween($min = 1, $max = 2),
        'lat'          => $faker->numberBetween($min = 1, $max = 10),
        'lng'          => $faker->numberBetween($min = 1, $max = 10),
        'nombre'       => $faker->name,
        'logo'         => $faker->name,
        'activo'       => $faker->boolean($chanceOfGettingTrue = 90),
    ];
});

//Para personas
$factory->define(App\Entities\Personas::class, function (Faker\Generator $faker) {
    return [
        'id_persona'   => $faker->numberBetween($min = 1, $max = 10),
        'name'         => $faker->name,
        'lastname'     => $faker->name,
        'id_ciudad'    => $faker->numberBetween($min = 1, $max = 2),
        'edad'         => $faker->numberBetween($min = 1, $max = 50),
        'sexo'         => $faker->name,
      ];
});

//Para empresarios_cajeros
$factory->define(App\Entities\EmpresariosCajeros::class, function (Faker\Generator $faker) {
    return [
        'id'                  => $faker->numberBetween($min = 1, $max = 10),
        'id_persona'          => $faker->numberBetween($min = 1, $max = 10),
        'id_tipo_usuario'     => $faker->numberBetween($min = 1, $max = 2),
        'id_empresa'          => $faker->numberBetween($min = 1, $max = 10),
        'email'               => $faker->unique()->safeEmail,
        'password'            => $faker->numberBetween($min = 1, $max = 10),
        'remember_token'      => str_random(10),
        'activo'              => $faker->boolean($chanceOfGettingTrue = 90),
    ];
});

//Para categorias
$factory->define(App\Entities\Categorias::class, function (Faker\Generator $faker) {
    return [
        'nombre_de_categoria'    => $faker->name,
    ];
});

//Para promociones
$factory->define(App\Entities\Promociones::class, function (Faker\Generator $faker) {
    return [
        'codigo_promocion'       => $faker->name,
        'id_categoria'           => $faker->unique()->numberBetween($min = 1, $max = 100),
        'id_empresa'             => $faker->unique()->numberBetween($min = 1, $max = 100),
        'imagen'                 => $faker->name,
        'nombre'                 => $faker->title,
        'descripcion'            => $faker->paragraph,
        'precio_real'            => $faker->numberBetween($min = 1, $max = 100),
        'precio_promocion'       => $faker->numberBetween($min = 1, $max = 100),
        'precio_pagar'           => $faker->numberBetween($min = 1, $max = 100),
        'cantidad_requerida'     => $faker->numberBetween($min = 1, $max = 100),
        'restantes'              => $faker->numberBetween($min = 1, $max = 100),
        'activo'                 => $faker->boolean($chanceOfGettingTrue = 90),
    ];
});

//Para cupones
$factory->define(App\Entities\Cupones::class, function (Faker\Generator $faker) {
    return [
        'id_codigo_promocion'  => $faker->name,
        'id_cliente'           => $faker->unique()->numberBetween($min = 1, $max = 100),
        'codigo_de_cupon'      => $faker->name,
        'comprado'             => $faker->boolean($chanceOfGettingTrue = 90),
        'fecha_comprado'       => $faker->dateTime($max = 'now'),
        'utilizado'            => $faker->boolean($chanceOfGettingTrue = 90),
        'fecha_utilizado'      => $faker->dateTime($max = 'now'),
        'id_cajero'            => $faker->unique()->numberBetween($min = 1, $max = 100),
    ];
});
