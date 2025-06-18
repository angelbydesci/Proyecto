<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaOfensiva extends Model
{
    use HasFactory;
    protected $table = 'estrategia_ofensiva';
    protected $fillable = ['proyecto_id', 'O1F1', 'O1F2', 'O1F3', 'O1F4', 'O2F1', 'O2F2', 'O2F3', 'O2F4', 'O3F1', 'O3F2', 'O3F3', 'O3F4', 'O4F1', 'O4F2', 'O4F3', 'O4F4', 'sumatoria'];
}
