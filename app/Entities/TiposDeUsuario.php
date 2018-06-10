<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TiposDeUsuario extends Model
{
    //use Notifiable;
    protected $table = 'tipos_de_usuarios';
    protected $fillable = [
        'id_tipo_usuario', 'tipo_usuario',
    ];
}
