<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'proyecto_id',
        'nombre',
        'venta',
    ];

    /**
     * Un producto pertenece a un proyecto.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    /**
     * Un producto tiene muchos registros TCM.
     */
    public function tcms()
    {
        return $this->hasMany(TCM::class, 'producto_id');
    }

    /**
     * Un producto tiene muchos competidores.
     */
    public function competidores()
    {
        return $this->hasMany(Competidor::class, 'producto_id');
    }
}