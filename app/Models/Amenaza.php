<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenaza extends Model
{
    use HasFactory;

    protected $table = 'amenazas';

    protected $fillable = [
        'proyecto_id',
        'amenaza1',
        'amenaza2',
        'amenaza3',
        'amenaza4',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
