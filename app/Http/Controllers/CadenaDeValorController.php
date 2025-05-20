<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\CadenaDeValor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CadenaDeValorController extends Controller
{
    /**
     * Store or update the autodiagnostico data for a Proyecto.
     */
    public function storeOrUpdate(Request $request, Proyecto $proyecto)
    {
        Log::info('Datos recibidos en storeOrUpdate:', $request->all());

        $rules = [];
        // Si se presiona "Guardar Todo", la reflexión es opcional pero validada si se envía.
        if ($request->has('guardar_todo')) {
            $rules['reflexion'] = 'nullable|string';
        }
        // No hay reglas de validación específicas para las preguntas aquí,
        // ya que se tomarán directamente del input y pueden ser null.
        $request->validate($rules);

        $dataToUpdate = [];
        $todasRespondidas = true;
        $sumaRespuestas = 0;

        // Recoger las respuestas de las preguntas y verificar si todas están respondidas
        for ($i = 1; $i <= 25; $i++) {
            $preguntaField = 'pregunta' . $i;
            $valorRespuesta = $request->input($preguntaField, null);
            $dataToUpdate[$preguntaField] = $valorRespuesta; // Siempre actualizar las preguntas

            if ($valorRespuesta === null) {
                $todasRespondidas = false;
            } else {
                $sumaRespuestas += (int)$valorRespuesta;
            }
        }

        // Manejar la reflexión: solo se actualiza si se presionó "Guardar Todo"
        if ($request->has('guardar_todo')) {
            $dataToUpdate['reflexion'] = $request->input('reflexion');
        }
        // Si solo se presionó "Guardar Respuestas", el campo 'reflexion' no se incluye en $dataToUpdate,
        // por lo que updateOrCreate no lo modificará si ya tiene un valor en la BD.

        // Calcular y añadir el porcentaje
        if ($todasRespondidas) {
            $porcentajeCalculado = 100 - $sumaRespuestas;
            $dataToUpdate['porcentaje'] = max(0, min(100, $porcentajeCalculado));
            Log::info('Todas las preguntas respondidas. Suma: ' . $sumaRespuestas . '. Porcentaje calculado: ' . $dataToUpdate['porcentaje']);
        } else {
            $dataToUpdate['porcentaje'] = null; // Si no todas están respondidas, el porcentaje es null
            Log::info('No todas las preguntas fueron respondidas. Porcentaje establecido a null.');
        }
        
        Log::info('Datos preparados para updateOrCreate:', $dataToUpdate);

        // Actualizar o crear el registro de cadena de valor
        // Usamos updateOrCreate para manejar tanto la creación si no existe como la actualización si ya existe.
        $cadenaDeValor = CadenaDeValor::updateOrCreate(
            ['proyecto_id' => $proyecto->id], // Condición para encontrar el registro
            $dataToUpdate // Valores para actualizar o crear
        );

        Log::info('CadenaDeValor guardada/actualizada:', $cadenaDeValor->toArray());

        $successMessage = 'Respuestas guardadas correctamente.';
        if ($request->has('guardar_todo')) {
            $successMessage = 'Autodiagnóstico y reflexión guardados correctamente.';
        }

        if ($cadenaDeValor->porcentaje !== null) {
            $successMessage .= ' Porcentaje de cumplimiento: ' . $cadenaDeValor->porcentaje . '%.';
        } else if ($todasRespondidas === false) { // Solo añadir este mensaje si no se calcularon por falta de respuestas
            $successMessage .= ' El porcentaje se calculará cuando todas las preguntas sean respondidas.';
        }

        return redirect()->route('proyectos.showAutodiagnosticoCadenaDeValor', $proyecto)
                         ->with('success', $successMessage);
    }
}
