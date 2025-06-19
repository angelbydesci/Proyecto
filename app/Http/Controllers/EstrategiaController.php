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
use Illuminate\Support\Facades\Log; // Importar Log

class EstrategiaController extends Controller
{
    public function show(Proyecto $proyecto)
    {
        // Asegurarse de que el proyecto pertenece al usuario autenticado
        if ($proyecto->user_id !== auth()->id()) {
            abort(403);
        }

        $fortalezas = Fortaleza::where('proyecto_id', $proyecto->id)->first();
        $debilidades = Debilidad::where('proyecto_id', $proyecto->id)->first();
        $oportunidades = Oportunidad::where('proyecto_id', $proyecto->id)->first();
        $amenazas = Amenaza::where('proyecto_id', $proyecto->id)->first();

        $matrizOfensiva = EstrategiaOfensiva::firstOrNew(['proyecto_id' => $proyecto->id]);
        $matrizDefensiva = EstrategiaDefensiva::firstOrNew(['proyecto_id' => $proyecto->id]);
        $matrizSupervivencia = EstrategiaSupervivencia::firstOrNew(['proyecto_id' => $proyecto->id]);
        $matrizReorientacion = EstrategiaReorientacion::firstOrNew(['proyecto_id' => $proyecto->id]);

        return view('estrategia', compact(
            'proyecto',
            'fortalezas',
            'debilidades',
            'oportunidades',
            'amenazas',
            'matrizOfensiva',
            'matrizDefensiva',
            'matrizSupervivencia',
            'matrizReorientacion'
        ));
    }

    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'proyecto_id' => 'required|integer|exists:proyectos,id',
            'matriz' => 'required|string|in:ofensiva,defensiva,supervivencia,reorientacion',
            'celda' => 'required|string',
            'valor' => 'required|integer|min:0|max:4',
        ]);

        // Asegurarse de que el proyecto pertenece al usuario autenticado
        $proyecto = Proyecto::findOrFail($validated['proyecto_id']);
        if ($proyecto->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $modelClass = null;
        switch ($validated['matriz']) {
            case 'ofensiva':
                $modelClass = EstrategiaOfensiva::class;
                break;
            case 'defensiva':
                $modelClass = EstrategiaDefensiva::class;
                break;
            case 'supervivencia':
                $modelClass = EstrategiaSupervivencia::class;
                break;
            case 'reorientacion':
                $modelClass = EstrategiaReorientacion::class;
                break;
        }

        if (!$modelClass) {
            return response()->json(['success' => false, 'message' => 'Matriz no válida'], 400);
        }

        try {
            $matriz = $modelClass::firstOrNew(['proyecto_id' => $validated['proyecto_id']]);
            
            // Validar que la celda existe en el modelo
            if (!in_array($validated['celda'], $matriz->getFillable())) {
                 return response()->json(['success' => false, 'message' => 'Celda no válida'], 400);
            }

            $matriz->{$validated['celda']} = $validated['valor'];
            
            // Recalcular sumatoria
            $sumatoria = 0;
            // Obtener solo las columnas que representan celdas de la matriz (ej. O1F1, A2D3)
            $cellColumns = array_filter($matriz->getFillable(), function($column) {
                return preg_match('/^[OADF][1-4][OADF][1-4]$/', $column);
            });

            foreach ($cellColumns as $column) {
                $sumatoria += $matriz->{$column} ?? 0;
            }
            $matriz->sumatoria = $sumatoria;
            
            $matriz->save();

            return response()->json(['success' => true, 'message' => 'Guardado con éxito', 'sumatoria' => $matriz->sumatoria]);

        } catch (\Exception $e) {
            Log::error('Error al guardar matriz: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error interno del servidor.'], 500);
        }
    }
}
