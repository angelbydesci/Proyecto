<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaReorientacion extends Model
{
    use HasFactory;
    protected $table = 'estrategia_reorientacion';
    protected $fillable = ['proyecto_id', 'O1D1', 'O1D2', 'O1D3', 'O1D4', 'O2D1', 'O2D2', 'O2D3', 'O2D4', 'O3D1', 'O3D2', 'O3D3', 'O3D4', 'O4D1', 'O4D2', 'O4D3', 'O4D4', 'sumatoria'];
}
