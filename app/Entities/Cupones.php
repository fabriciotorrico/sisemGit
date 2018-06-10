<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Cupones extends Model
{
    protected $table = 'cupones';
    protected $fillable = [
      'id_codigo_promocion', 'id_cliente', 'codigo_de_cupon', 'comprado', 'fecha_comprado', 'utilizado',
      'fecha_utilizado', 'id_cajero',
    ];
}
