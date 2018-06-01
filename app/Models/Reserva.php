<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = ['id', 'fecha_inicio', 'fecha_fin', 'descripcion', 'dia_id', 'sala_id'];

    public function dia()
    {
        return $this->belongsTo('App\Models\Dia');
    }

    public function sala()
    {
        return $this->belongsTo('App\Models\Sala');
    }
}
