<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    //use Notifiable;
    protected $table = 'empresas';
    protected $fillable = [
        'id_empresa', 'id_contrato', 'id_ciudad', 'lat', 'lng', 'nombre', 'logo','activo',
    ];
}
