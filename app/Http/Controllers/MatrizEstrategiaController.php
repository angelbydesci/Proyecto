<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstrategiaOfensiva;
use App\Models\EstrategiaDefensiva;
use App\Models\EstrategiaSupervivencia;
use App\Models\EstrategiaReorientacion;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Log;

class MatrizEstrategiaController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'proyecto_id' => 'required|integer|exists:proyectos,id_proyecto',
                'matriz' => 'required|string|in:ofensiva,defensiva,supervivencia,reorientacion',
                'celda' => 'required|string',
                'valor' => 'nullable|integer|min:0|max:4',
            ]);

            $proyecto_id = $validatedData['proyecto_id'];
            $matriz = $validatedData['matriz'];
            $celda = $validatedData['celda'];
            $valor = $validatedData['valor'];

            $modelMap = [
                'ofensiva' => EstrategiaOfensiva::class,
                'defensiva' => EstrategiaDefensiva::class,
                'supervivencia' => EstrategiaSupervivencia::class,
                'reorientacion' => EstrategiaReorientacion::class,
            ];

            $modelClass = $modelMap[$matriz];
            $matrizRecord = $modelClass::firstOrNew(['id_proyecto' => $proyecto_id]);
            $matrizRecord->{$celda} = $valor;
            
            // Calcular sumatoria
            $sumatoria = 0;
            for ($i = 1; $i <= 4; $i++) {
                for ($j = 1; $j <= 4; $j++) {
                    $nombre_celda = 'c' . $i . $j;
                    $sumatoria += $matrizRecord->{$nombre_celda} ?? 0;
                }
            }
            $matrizRecord->sumatoria = $sumatoria;

            $matrizRecord->save();

            return response()->json(['success' => true, 'sumatoria' => $sumatoria]);

        } catch (\Exception $e) {
            Log::error('Error saving matrix data: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al guardar los datos.'], 500);
        }
    }
}
