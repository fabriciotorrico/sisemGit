<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    //use Notifiable;
    protected $table = 'personas';
    protected $fillable = [
        'id_persona','name','lastname','id_ciudad','edad','sexo',
    ];

}
