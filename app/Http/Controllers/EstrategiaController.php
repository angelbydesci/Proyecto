<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Fortaleza;
use App\Models\Debilidad;
use App\Models\Oportunidad;
use App\Models\Amenaza;
use App\Models\EstrategiaOfensiva;
use App\Models\EstrategiaDefensiva;
use App\Models\EstrategiaSupervivencia;
use App\Models\EstrategiaReorientacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EstrategiaController extends Controller
{
    public function show(Proyecto $proyecto)
    {
        // Asegurarse de que el proyecto pertenece al usuario autenticado
        if ($proyecto->user_id !== auth()->id()) {
            abort(403);
        }

        // Cargar la fila única de datos para cada elemento FODA
        $fortalezas_record = Fortaleza::where('proyecto_id', $proyecto->id)->first();
        $oportunidades_record = Oportunidad::where('proyecto_id', $proyecto->id)->first();
        $debilidades_record = Debilidad::where('proyecto_id', $proyecto->id)->first();
        $amenazas_record = Amenaza::where('proyecto_id', $proyecto->id)->first();

        // Extraer los valores en arrays simples
        $fortalezas = $fortalezas_record ? [$fortalezas_record->fortaleza1, $fortalezas_record->fortaleza2, $fortalezas_record->fortaleza3, $fortalezas_record->fortaleza4] : [];
        $oportunidades = $oportunidades_record ? [$oportunidades_record->oportunidad1, $oportunidades_record->oportunidad2, $oportunidades_record->oportunidad3, $oportunidades_record->oportunidad4] : [];
        $debilidades = $debilidades_record ? [$debilidades_record->debilidad1, $debilidades_record->debilidad2, $debilidades_record->debilidad3, $debilidades_record->debilidad4] : [];
        $amenazas = $amenazas_record ? [$amenazas_record->amenaza1, $amenazas_record->amenaza2, $amenazas_record->amenaza3, $amenazas_record->amenaza4] : [];

        $matrizOfensiva = EstrategiaOfensiva::firstOrNew(['proyecto_id' => $proyecto->id]);
        $matrizDefensiva = EstrategiaDefensiva::firstOrNew(['proyecto_id' => $proyecto->id]);
        $matrizSupervivencia = EstrategiaSupervivencia::firstOrNew(['proyecto_id' => $proyecto->id]);
        $matrizReorientacion = EstrategiaReorientacion::firstOrNew(['proyecto_id' => $proyecto->id]);

        return view('estrategia', compact(
            'proyecto',
            'fortalezas',
            'oportunidades',
            'debilidades',
            'amenazas',
            'matrizOfensiva',
            'matrizDefensiva',
            'matrizSupervivencia',
            'matrizReorientacion'
        ));
    }

    public function guardarTodo(Request $request)
    {
        $validated = $request->validate([
            'proyecto_id' => 'required|integer|exists:proyectos,id',
            'matrices' => 'required|array',
            'matrices.ofensiva' => 'present|array',
            'matrices.defensiva' => 'present|array',
            'matrices.reorientacion' => 'present|array',
            'matrices.supervivencia' => 'present|array',
        ]);

        $proyecto = Proyecto::findOrFail($validated['proyecto_id']);
        if ($proyecto->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'No autorizado'], 403);
        }

        DB::beginTransaction();
        try {
            $this->actualizarMatriz('ofensiva', $validated['matrices']['ofensiva'], $validated['proyecto_id']);
            $this->actualizarMatriz('defensiva', $validated['matrices']['defensiva'], $validated['proyecto_id']);
            $this->actualizarMatriz('reorientacion', $validated['matrices']['reorientacion'], $validated['proyecto_id']);
            $this->actualizarMatriz('supervivencia', $validated['matrices']['supervivencia'], $validated['proyecto_id']);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Estrategias guardadas con éxito.']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar todas las matrices: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error interno del servidor al guardar.'], 500);
        }
    }

    private function actualizarMatriz(string $nombreMatriz, array $celdas, int $proyectoId)
    {
        $modelClass = null;
        switch ($nombreMatriz) {
            case 'ofensiva': $modelClass = EstrategiaOfensiva::class; break;
            case 'defensiva': $modelClass = EstrategiaDefensiva::class; break;
            case 'reorientacion': $modelClass = EstrategiaReorientacion::class; break;
            case 'supervivencia': $modelClass = EstrategiaSupervivencia::class; break;
        }

        if (!$modelClass) return;

        $matriz = $modelClass::firstOrNew(['proyecto_id' => $proyectoId]);
        $sumatoria = 0;

        // Asignar valores de las celdas y calcular sumatoria
        foreach ($celdas as $celda => $valor) {
            if (in_array($celda, $matriz->getFillable())) {
                $matriz->{$celda} = $valor;
                $sumatoria += $valor;
            }
        }
        $matriz->sumatoria = $sumatoria;
        $matriz->save();
    }
}
