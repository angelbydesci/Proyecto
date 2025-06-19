<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correcion extends Model
{
    use HasFactory;

    protected $table = 'correciones';

    protected $fillable = [
        'proyecto_id',
        'CDebilidades1',
        'CDebilidades2',
        'CDebilidades3',
        'CDebilidades4',
        'CAmenazas1',
        'CAmenazas2',
        'CAmenazas3',
        'CAmenazas4',
        'CFortalezas1',
        'CFortalezas2',
        'CFortalezas3',
        'CFortalezas4',
        'COportunidades1',
        'COportunidades2',
        'COportunidades3',
        'COportunidades4',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
