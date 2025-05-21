<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCM extends Model
{
    use HasFactory;

    protected $table = 'TCM'; // Laravel por defecto buscaría 't_c_m_s' o 'tcms'. Especificamos la tabla.

    protected $fillable = [
        'producto_id',
        'porcentaje',
        'periodo',
    ];

    /**
     * Un registro TCM pertenece a un producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}