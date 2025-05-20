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
        // Log para ver todos los datos del request
        Log::info('Datos recibidos en storeOrUpdate:', $request->all());

        $validatedData = $request->validate([
            'reflexion' => 'nullable|string',
            // Hacer el porcentaje opcional y permitir null
            'porcentaje' => 'nullable|numeric|min:0|max:100', 
        ]);

        // Log para ver los datos validados
        Log::info('Datos validados:', $validatedData);

        $dataToUpdate = [
            'reflexion' => $validatedData['reflexion'] ?? null,
            // Asignar porcentaje validado o null si no está presente
            'porcentaje' => $validatedData['porcentaje'] ?? null, 
        ];

        // Recoger las respuestas de las preguntas
        for ($i = 1; $i <= 25; $i++) {
            $preguntaField = 'pregunta' . $i;
            // Si la pregunta existe en el request (radio button marcado), se guarda su valor.
            // Si no existe (ningún radio button marcado para esa pregunta), se guarda null.
            $dataToUpdate[$preguntaField] = $request->input($preguntaField, null);
        }

        // Actualizar o crear el registro de cadena de valor
        $cadenaDeValor = CadenaDeValor::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            $dataToUpdate
        );

        // Log para confirmar el guardado y ver el objeto
        Log::info('CadenaDeValor guardada/actualizada:', $cadenaDeValor->toArray());

        // Modificar el mensaje de éxito para no mostrar el porcentaje si es null
        $successMessage = 'Autodiagnóstico y reflexión guardados correctamente.';
        if (isset($cadenaDeValor->porcentaje)) {
            $successMessage .= ' Porcentaje: ' . $cadenaDeValor->porcentaje;
        }

        return redirect()->route('proyectos.showAutodiagnosticoCadenaDeValor', $proyecto)
                         ->with('success', $successMessage);
    }
}
