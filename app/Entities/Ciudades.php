<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    //use Notifiable;
    protected $table = 'ciudades';
    protected $fillable = [
        'id_ciudad', 'ciudad',
    ];
}
