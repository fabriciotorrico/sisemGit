<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';
    protected $fillable = [
        'id', 'nombre_de_categoria',
    ];
}
