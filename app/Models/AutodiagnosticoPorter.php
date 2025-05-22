<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutodiagnosticoPorter extends Model
{
    use HasFactory;

    protected $table = 'autodiagnosticoporter'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'proyecto_id',
        'pregunta1',
        'pregunta2',
        'pregunta3',
        'pregunta4',
        'pregunta5',
        'pregunta6',
        'pregunta7',
        'pregunta8',
        'pregunta9',
        'pregunta10',
        'pregunta11',
        'pregunta12',
        'pregunta13',
        'pregunta14',
        'pregunta15',
        'pregunta16',
        'pregunta17',
        'conclusion',
        'puntaje',
    ];

    /**
     * Get the proyecto that owns the autodiagnostico porter.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
