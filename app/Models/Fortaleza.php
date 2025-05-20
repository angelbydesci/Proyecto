<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fortaleza extends Model
{
    use HasFactory;

    protected $table = 'fortalezas';

    protected $fillable = [
        'proyecto_id',
        'fortaleza1',
        'fortaleza2',
        'fortaleza3',
        'fortaleza4',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
