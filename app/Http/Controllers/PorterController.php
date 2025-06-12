<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\AutodiagnosticoPorter;
use App\Models\Oportunidad;
use App\Models\Amenaza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // Importar DB para transacciones si se decide usar

class PorterController extends Controller
{
    public function showAutodiagnosticoPorter(Proyecto $proyecto)
    {
        $autodiagnosticoPorter = AutodiagnosticoPorter::where('proyecto_id', $proyecto->id)->first();
        $oportunidades = Oportunidad::where('proyecto_id', $proyecto->id)->first();
        $amenazas = Amenaza::where('proyecto_id', $proyecto->id)->first();

        return view('autodiagnostico_porter', compact(
            'proyecto', 
            'autodiagnosticoPorter',
            'oportunidades',
            'amenazas'
        ));
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        Log::info('INICIO PorterController@store para proyecto ID: ' . $proyecto->id, $request->all());

        $validatedData = $request->validate([
            'pregunta1' => 'required|integer|min:1|max:5',
            'pregunta2' => 'required|integer|min:1|max:5',
            'pregunta3' => 'required|integer|min:1|max:5',
            'pregunta4' => 'required|integer|min:1|max:5',
            'pregunta5' => 'required|integer|min:1|max:5',
            'pregunta6' => 'required|integer|min:1|max:5',
            'pregunta7' => 'required|integer|min:1|max:5',
            'pregunta8' => 'required|integer|min:1|max:5',
            'pregunta9' => 'required|integer|min:1|max:5',
            'pregunta10' => 'required|integer|min:1|max:5',
            'pregunta11' => 'required|integer|min:1|max:5',
            'pregunta12' => 'required|integer|min:1|max:5',
            'pregunta13' => 'required|integer|min:1|max:5',
            'pregunta14' => 'required|integer|min:1|max:5',
            'pregunta15' => 'required|integer|min:1|max:5',
            'pregunta16' => 'required|integer|min:1|max:5',
            'pregunta17' => 'required|integer|min:1|max:5',
            'oportunidad1' => 'nullable|string|max:65535',
            'oportunidad2' => 'nullable|string|max:65535',
            'amenaza1' => 'nullable|string|max:65535',
            'amenaza2' => 'nullable|string|max:65535',
        ]);
        Log::info('Datos validados en PorterController@store:', $validatedData);

        $puntaje = 0;
        for ($i = 1; $i <= 17; $i++) {
            $puntaje += $validatedData['pregunta' . $i];
        }

        $conclusion = '';
        if ($puntaje >= 17 && $puntaje <= 29) {
            $conclusion = "Estamos en un mercado altamente competitivo, en el que es muy difícil hacerse un hueco en el mercado.";
        } elseif ($puntaje >= 30 && $puntaje <= 44) {
            $conclusion = "Estamos en un mercado de competitividad relativamente alta, pero con ciertas modificaciones en el producto y la política comercial de la empresa, podría encontrarse un nicho de mercado.";
        } elseif ($puntaje >= 45 && $puntaje <= 59) {
            $conclusion = "La situación actual del mercado es favorable a la empresa.";
        } elseif ($puntaje >= 60 && $puntaje <= 85) {
            $conclusion = "Estamos en una situación excelente para la empresa.";
        }

        // DB::beginTransaction(); // Descomentar para usar transacciones explícitas si es necesario

        try {
            AutodiagnosticoPorter::updateOrCreate(
                ['proyecto_id' => $proyecto->id],
                [
                    'pregunta1' => $validatedData['pregunta1'],
                    'pregunta2' => $validatedData['pregunta2'],
                    'pregunta3' => $validatedData['pregunta3'],
                    'pregunta4' => $validatedData['pregunta4'],
                    'pregunta5' => $validatedData['pregunta5'],
                    'pregunta6' => $validatedData['pregunta6'],
                    'pregunta7' => $validatedData['pregunta7'],
                    'pregunta8' => $validatedData['pregunta8'],
                    'pregunta9' => $validatedData['pregunta9'],
                    'pregunta10' => $validatedData['pregunta10'],
                    'pregunta11' => $validatedData['pregunta11'],
                    'pregunta12' => $validatedData['pregunta12'],
                    'pregunta13' => $validatedData['pregunta13'],
                    'pregunta14' => $validatedData['pregunta14'],
                    'pregunta15' => $validatedData['pregunta15'],
                    'pregunta16' => $validatedData['pregunta16'],
                    'pregunta17' => $validatedData['pregunta17'],
                    'puntaje' => $puntaje,
                    'conclusion' => $conclusion,
                ]
            );
            Log::info('AutodiagnosticoPorter guardado/actualizado.');

            // Guardar o actualizar Oportunidades
            $oportunidadesActual = Oportunidad::where('proyecto_id', $proyecto->id)->first();
            $oportunidadData = [
                'oportunidad1' => $validatedData['oportunidad1'] === '' ? null : $validatedData['oportunidad1'], 
                'oportunidad2' => $validatedData['oportunidad2'] === '' ? null : $validatedData['oportunidad2'],
                'oportunidad3' => $oportunidadesActual?->oportunidad3, 
                'oportunidad4' => $oportunidadesActual?->oportunidad4, 
            ];
            Log::info('Datos para Oportunidad::updateOrCreate:', ['proyecto_id' => $proyecto->id, 'data' => $oportunidadData]);
            
            $oportunidadModel = Oportunidad::updateOrCreate(
                ['proyecto_id' => $proyecto->id],
                $oportunidadData
            );
            Log::info('Resultado Oportunidad::updateOrCreate (modelo en memoria):', [
                'id' => $oportunidadModel->id, 
                'exists' => $oportunidadModel->exists, 
                'wasRecentlyCreated' => $oportunidadModel->wasRecentlyCreated, 
                'attributes' => $oportunidadModel->getAttributes()
            ]);
            
            // Re-consultar para verificar persistencia
            $oportunidadPersistida = Oportunidad::where('proyecto_id', $proyecto->id)->first();
            Log::info('Oportunidad re-consultada de BD:', $oportunidadPersistida ? $oportunidadPersistida->toArray() : ['mensaje' => 'No encontrada después de updateOrCreate']);


            // Guardar o actualizar Amenazas
            $amenazasActual = Amenaza::where('proyecto_id', $proyecto->id)->first();
            $amenazaData = [
                'amenaza1' => $validatedData['amenaza1'] === '' ? null : $validatedData['amenaza1'], 
                'amenaza2' => $validatedData['amenaza2'] === '' ? null : $validatedData['amenaza2'],
                'amenaza3' => $amenazasActual?->amenaza3, 
                'amenaza4' => $amenazasActual?->amenaza4, 
            ];
            Log::info('Datos para Amenaza::updateOrCreate:', ['proyecto_id' => $proyecto->id, 'data' => $amenazaData]);
            
            $amenazaModel = Amenaza::updateOrCreate(
                ['proyecto_id' => $proyecto->id],
                $amenazaData
            );
            Log::info('Resultado Amenaza::updateOrCreate (modelo en memoria):', [
                'id' => $amenazaModel->id, 
                'exists' => $amenazaModel->exists, 
                'wasRecentlyCreated' => $amenazaModel->wasRecentlyCreated, 
                'attributes' => $amenazaModel->getAttributes()
            ]);

            // Re-consultar para verificar persistencia
            $amenazaPersistida = Amenaza::where('proyecto_id', $proyecto->id)->first();
            Log::info('Amenaza re-consultada de BD:', $amenazaPersistida ? $amenazaPersistida->toArray() : ['mensaje' => 'No encontrada después de updateOrCreate']);

            // DB::commit(); // Descomentar para usar transacciones explícitas si es necesario
            Log::info('FIN PorterController@store - ÉXITO para proyecto ID: ' . $proyecto->id);
            return redirect()->route('proyectos.showAutodiagnosticoPorter', $proyecto->id)
                             ->with('success', 'Autodiagnóstico de Porter y Análisis FODA guardados con éxito.');
        } catch (\Exception $e) {
            // DB::rollBack(); // Descomentar para usar transacciones explícitas si es necesario
            Log::error('ERROR en PorterController@store para proyecto ID: ' . $proyecto->id . ' - ' . $e->getMessage(), [
                'exception_class' => get_class($e),
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                             ->withErrors(['error_general' => 'Error al guardar los datos: ' . $e->getMessage()])
                             ->withInput();
        }
    }
}
