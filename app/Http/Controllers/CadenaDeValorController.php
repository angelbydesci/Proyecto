<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\CadenaDeValor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CadenaDeValorController extends Controller
{
    /**
     * Store or update the reflexion for a Proyecto.
     */
    public function storeOrUpdate(Request $request, Proyecto $proyecto)
    {
        $validatedData = $request->validate([
            'reflexion' => 'nullable|string',
        ]);

        CadenaDeValor::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            ['reflexion' => $validatedData['reflexion'] ?? null] // Asegurar que solo se pasa la reflexión
        );

        return redirect()->route('proyectos.showAutodiagnosticoCadenaDeValor', $proyecto)
                         ->with('success', 'Reflexión guardada correctamente.');
    }

    /**
     * Update a specific pregunta's value for a Proyecto asynchronously.
     */
    public function updatePregunta(Request $request, Proyecto $proyecto)
    {
        $preguntaField = $request->input('pregunta_field'); // e.g., 'pregunta1', 'pregunta2'
        $value = $request->input('value');

        // Basic validation
        if (!preg_match('/^pregunta([1-9]|1[0-9]|2[0-5])$/', $preguntaField)) {
            return response()->json(['error' => 'Nombre de pregunta inválido.'], 400);
        }
        if (!in_array($value, [0, 1, 2, 3, 4])) {
            return response()->json(['error' => 'Valor de pregunta inválido.'], 400);
        }

        try {
            $cadenaDeValor = CadenaDeValor::firstOrNew(['proyecto_id' => $proyecto->id]);
            $cadenaDeValor->{$preguntaField} = $value;
            $cadenaDeValor->save();

            return response()->json(['success' => 'Respuesta guardada.', 'pregunta' => $preguntaField, 'valor' => $value]);
        } catch (\Exception $e) {
            Log::error("Error al actualizar pregunta de cadena de valor: " . $e->getMessage());
            return response()->json(['error' => 'No se pudo guardar la respuesta.'], 500);
        }
    }
}
