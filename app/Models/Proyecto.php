<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre_proyecto',
        'descripcion',
        'created_at',
        'updated_at',
    ];

    /**
     * Relación con el modelo User (muchos a uno).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Agregar un nuevo proyecto.
     *
     * @param array $data
     * @return Proyecto
     */
    public static function agregarProyecto(array $data)
    {
        return self::create($data);
    }

    /**
     * Listar todos los proyectos de un usuario.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listarProyectosPorUsuario(int $userId)
    {
        return self::where('user_id', $userId)->get();
    }
}