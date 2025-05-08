<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'valores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'proyecto_id',
        'valor',
    ];

    /**
     * Indicates if the model should be timestamped.
     * (Confirmado por la estructura de tu tabla bd.sql)
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the proyecto that owns the valor.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
