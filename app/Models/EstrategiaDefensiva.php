<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaDefensiva extends Model
{
    use HasFactory;
    protected $table = 'estrategia_defensiva';
    protected $fillable = ['proyecto_id', 'A1F1', 'A1F2', 'A1F3', 'A1F4', 'A2F1', 'A2F2', 'A2F3', 'A2F4', 'A3F1', 'A3F2', 'A3F3', 'A3F4', 'A4F1', 'A4F2', 'A4F3', 'A4F4', 'sumatoria'];
}
