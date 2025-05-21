<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection; // Asegurar que Collection está importada

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre_proyecto',
        'descripcion',
        'mision',
        'vision',
        'unidades_estrategicas',
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
    public static function agregarProyecto(array $data): Proyecto
    {
        // Aseguramos que los campos opcionales tengan un valor por defecto si no están en $data
        $data['mision'] = $data['mision'] ?? null;
        $data['vision'] = $data['vision'] ?? null;
        $data['unidades_estrategicas'] = $data['unidades_estrategicas'] ?? null;
        return self::create($data);
    }

    /**
     * Listar todos los proyectos de un usuario.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public static function listarProyectosPorUsuario(int $userId): Collection
    {
        return self::where('user_id', $userId)->get();
    }

    /**
     * Obtener la misión de un proyecto.
     *
     * @return string|null
     */
    public function getMision(): ?string
    {
        return $this->mision;
    }

    /**
     * Actualizar la misión de un proyecto.
     *
     * @param string|null $mision
     * @return bool
     */
    public function actualizarMision(?string $mision): bool
    {
        return $this->update(['mision' => $mision]);
    }

    /**
     * Obtener la visión de un proyecto.
     *
     * @return string|null
     */
    public function getVision(): ?string
    {
        return $this->vision;
    }

    /**
     * Actualizar la visión de un proyecto.
     *
     * @param string|null $vision
     * @return bool
     */
    public function actualizarVision(?string $vision): bool
    {
        return $this->update(['vision' => $vision]);
    }

    /**
     * Relación con el modelo ObjetivoPrincipal (uno a muchos).
     */
    public function objetivosPrincipales()
    {
        return $this->hasMany(ObjetivoPrincipal::class, 'proyecto_id');
    }

    /**
     * Obtener las unidades estratégicas de un proyecto.
     *
     * @return string|null
     */
    public function getUnidadesEstrategicas(): ?string
    {
        return $this->unidades_estrategicas;
    }

    /**
     * Actualizar las unidades estratégicas de un proyecto.
     *
     * @param string|null $unidades_estrategicas
     * @return void
     */
    public function actualizarUnidadesEstrategicas(?string $unidades_estrategicas): void
    {
        $this->unidades_estrategicas = $unidades_estrategicas;
        $this->save();
    }

    /**
     * Obtener los valores asociados a un proyecto.
     */
    public function valores()
    {
        return $this->hasMany(Valor::class, 'proyecto_id');
    }
    /**
     * Un proyecto tiene muchos productos.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'proyecto_id');
    }
}