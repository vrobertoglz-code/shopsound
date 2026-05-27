<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [

        'cliente',
        'correo',
        'telefono',
        'direccion',
        'total'

    ];

    public function detalles()
    {
        return $this->hasMany(
            DetalleOrden::class
        );
    }
}