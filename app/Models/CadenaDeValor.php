<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadenaDeValor extends Model
{
    use HasFactory;

    protected $table = 'cadenadevalor'; // Especificar el nombre de la tabla si no sigue la convención

    protected $fillable = [
        'proyecto_id',
        'reflexion',
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
        'pregunta18',
        'pregunta19',
        'pregunta20',
        'pregunta21',
        'pregunta22',
        'pregunta23',
        'pregunta24',
        'pregunta25',
        'porcentaje', // Añadir el nuevo campo porcentaje
    ];

    /**
     * Get the proyecto that owns the cadena de valor record.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
