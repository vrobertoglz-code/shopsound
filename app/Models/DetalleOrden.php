<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $fillable = [

        'orden_id',
        'producto_id',
        'cantidad',
        'precio'

    ];

    public function producto()
    {
        return $this->belongsTo(
            Producto::class
        );
    }

    public function orden()
    {
        return $this->belongsTo(
            Orden::class
        );
    }
}