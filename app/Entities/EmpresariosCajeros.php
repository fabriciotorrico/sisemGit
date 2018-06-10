<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EmpresariosCajeros extends Model
{
    //use Notifiable;
    protected $table = 'empresarios_cajeros';
    protected $fillable = [
        'id', 'id_persona', 'id_tipo_usuario', 'id_empresa', 'email', 'password', 'activo',
    ];
}
