<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaSupervivencia extends Model
{
    use HasFactory;
    protected $table = 'estrategia_supervivencia';
    protected $fillable = ['proyecto_id', 'A1D1', 'A1D2', 'A1D3', 'A1D4', 'A2D1', 'A2D2', 'A2D3', 'A2D4', 'A3D1', 'A3D2', 'A3D3', 'A3D4', 'A4D1', 'A4D2', 'A4D3', 'A4D4', 'sumatoria'];
}
