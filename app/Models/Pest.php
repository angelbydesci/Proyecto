<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pest extends Model
{
    use HasFactory;

    protected $table = 'pest';

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
        'pregunta18',
        'pregunta19',
        'pregunta20',
        'pregunta21',
        'pregunta22',
        'pregunta23',
        'pregunta24',
        'pregunta25',
        'sumatorio',
        'RFSociales',    // Puntaje para Factores Sociales y Demográficos
        'RFAmbientales', // Puntaje para Factores Medio Ambientales
        'RFPoliticos',   // Puntaje para Factores Políticos
        'RFEconomicos',  // Puntaje para Factores Económicos
        'RFTecnologicos', // Puntaje para Factores Tecnológicos
        'reflexion_social_texto', 'reflexion_ambiental_texto', 'reflexion_politico_texto',
        'reflexion_economico_texto', 'reflexion_tecnologico_texto',
    ];

    /**
     * Get the proyecto that owns the pest analysis.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}