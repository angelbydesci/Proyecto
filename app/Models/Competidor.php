<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competidor extends Model
{
    use HasFactory;

    protected $table = 'Competidor'; // Laravel por defecto buscaría 'competidors'. Especificamos la tabla.

    protected $fillable = [
        'producto_id',
        'nombre',
        'venta',
    ];

    /**
     * Un competidor pertenece a un producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}