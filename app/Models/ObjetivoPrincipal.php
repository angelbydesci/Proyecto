<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoPrincipal extends Model
{
    use HasFactory;

    protected $table = 'objetivos_principales';

    protected $fillable = [
        'proyecto_id',
        'objetivo',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function objetivosEspecificos()
    {
        return $this->hasMany(ObjetivoEspecifico::class, 'objetivo_principal_id');
    }
}
