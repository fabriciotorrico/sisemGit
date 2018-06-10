<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    protected $table = 'promociones';
    protected $fillable = [
        'id', 'codigo_promocion', 'id_categoria', 'id_empresa', 'imagen', 'nombre',
        'descripcion', 'precio_real', 'precio_promocion', 'precio_pagar', 'cantidad_requerida',
        'restantes', 'activo',
    ];
}
