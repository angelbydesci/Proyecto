<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoEspecifico extends Model
{
    use HasFactory;

    protected $table = 'objetivos_especificos';

    protected $fillable = [
        'objetivo_principal_id',
        'objetivo',
    ];

    public function objetivoPrincipal()
    {
        return $this->belongsTo(ObjetivoPrincipal::class, 'objetivo_principal_id');
    }
}
