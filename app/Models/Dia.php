<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $table = 'dias';

    protected $fillable = ['id', 'dia_semana'];

    public function reservas()
    {
        return $this->hasMany('App\Models\Reserva');
    }
}
