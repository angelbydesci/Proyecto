<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\AutodiagnosticoPorter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PorterController extends Controller
{
    public function showAutodiagnosticoPorter(Proyecto $proyecto)
    {
        $autodiagnosticoPorter = AutodiagnosticoPorter::where('proyecto_id', $proyecto->id)->first();
        $fortalezas = \App\Models\Fortaleza::where('proyecto_id', $proyecto->id)->first();
        $debilidades = \App\Models\Debilidad::where('proyecto_id', $proyecto->id)->first();
        $oportunidades = \App\Models\Oportunidad::where('proyecto_id', $proyecto->id)->first();
        $amenazas = \App\Models\Amenaza::where('proyecto_id', $proyecto->id)->first();

        return view('autodiagnostico_porter', compact(
            'proyecto', 
            'autodiagnosticoPorter',
            'fortalezas',
            'debilidades',
            'oportunidades',
            'amenazas'
        ));
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        Log::info('Datos recibidos en PorterController@store:', $request->all());

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
            'fortaleza1' => 'nullable|string|max:65535',
            'fortaleza2' => 'nullable|string|max:65535',
            'debilidad1' => 'nullable|string|max:65535',
            'debilidad2' => 'nullable|string|max:65535',
            'oportunidad1' => 'nullable|string|max:65535',
            'oportunidad2' => 'nullable|string|max:65535',
            'amenaza1' => 'nullable|string|max:65535',
            'amenaza2' => 'nullable|string|max:65535',
        ]);

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

            \App\Models\Fortaleza::updateOrCreate(
                ['proyecto_id' => $proyecto->id],
                [
                    'fortaleza1' => $request->input('fortaleza1'),
                    'fortaleza2' => $request->input('fortaleza2'),
                ]
            );
            \App\Models\Debilidad::updateOrCreate(
                ['proyecto_id' => $proyecto->id],
                [
                    'debilidad1' => $request->input('debilidad1'),
                    'debilidad2' => $request->input('debilidad2'),
                ]
            );
            \App\Models\Oportunidad::updateOrCreate(
                ['proyecto_id' => $proyecto->id],
                [
                    'oportunidad1' => $request->input('oportunidad1'),
                    'oportunidad2' => $request->input('oportunidad2'),
                ]
            );
            \App\Models\Amenaza::updateOrCreate(
                ['proyecto_id' => $proyecto->id],
                [
                    'amenaza1' => $request->input('amenaza1'),
                    'amenaza2' => $request->input('amenaza2'),
                ]
            );

            Log::info('Datos de Porter y FODA guardados correctamente para el proyecto ID: ' . $proyecto->id);
            return redirect()->route('proyectos.showAutodiagnosticoPorter', $proyecto->id)
                             ->with('success', 'Autodiagnóstico de Porter y Análisis FODA guardados con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al guardar datos para el proyecto ID: ' . $proyecto->id . ' - ' . $e->getMessage());
            return redirect()->back()
                             ->withErrors(['error' => 'Error al guardar los datos: ' . $e->getMessage()])
                             ->withInput();
        }
    }
}
