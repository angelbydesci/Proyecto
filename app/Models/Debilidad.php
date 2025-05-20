<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debilidad extends Model
{
    use HasFactory;

    protected $table = 'debilidades';

    protected $fillable = [
        'proyecto_id',
        'debilidad1',
        'debilidad2',
        'debilidad3',
        'debilidad4',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
