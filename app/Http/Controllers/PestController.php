<?php

namespace App\Http\Controllers;

use App\Models\Pest;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        $rules = [];
        for ($i = 1; $i <= 25; $i++) {
            $rules['pregunta'.$i] = 'required|integer|min:0|max:4';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('proyectos.showPest', $proyecto->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $dataToSave = $request->only(array_keys($rules));
        $dataToSave['proyecto_id'] = $proyecto->id;

        // Calcular sumatorio total de las preguntas PEST
        $sumatorioTotal = 0;
        for ($i = 1; $i <= 25; $i++) {
            $sumatorioTotal += (int)$request->input('pregunta'.$i);
        }
        $dataToSave['sumatorio'] = $sumatorioTotal;

        // Calcular puntajes específicos por factor
        $puntajesNumericos = [
            'RFSociales' => 0,
            'RFPoliticos' => 0,
            'RFEconomicos' => 0,
            'RFTecnologicos' => 0,
            'RFAmbientales' => 0,
        ];

        for ($i = 1; $i <= 5; $i++) { $puntajesNumericos['RFSociales'] += (int)$request->input('pregunta'.$i); }
        for ($i = 6; $i <= 10; $i++) { $puntajesNumericos['RFPoliticos'] += (int)$request->input('pregunta'.$i); }
        for ($i = 11; $i <= 15; $i++) { $puntajesNumericos['RFEconomicos'] += (int)$request->input('pregunta'.$i); }
        for ($i = 16; $i <= 20; $i++) { $puntajesNumericos['RFTecnologicos'] += (int)$request->input('pregunta'.$i); }
        for ($i = 21; $i <= 25; $i++) { $puntajesNumericos['RFAmbientales'] += (int)$request->input('pregunta'.$i); }

        $dataToSave['RFSociales'] = $puntajesNumericos['RFSociales'] * 5;
        $dataToSave['RFPoliticos'] = $puntajesNumericos['RFPoliticos'] * 5;
        $dataToSave['RFEconomicos'] = $puntajesNumericos['RFEconomicos'] * 5;
        $dataToSave['RFTecnologicos'] = $puntajesNumericos['RFTecnologicos'] * 5;
        $dataToSave['RFAmbientales'] = $puntajesNumericos['RFAmbientales'] * 5;

        // Generar y guardar textos de reflexión
        $umbral = 70;
        $dataToSave['reflexion_social_texto'] = ($dataToSave['RFSociales'] >= $umbral) ? "HAY UN NOTABLE IMPACTO DE FACTORES SOCIALES Y DEMOGRÁFICOS EN EL FUNCIONAMIENTO DE LA EMPRESA" : "NO HAY UN NOTABLE IMPACTO DE FACTORES SOCIALES Y DEMOGRÁFICOS EN EL FUNCIONAMIENTO DE LA EMPRESA";
        $dataToSave['reflexion_ambiental_texto'] = ($dataToSave['RFAmbientales'] >= $umbral) ? "HAY UN NOTABLE IMPACTO DE FACTORES MEDIO AMBIENTALES EN EL FUNCIONAMIENTO DE LA EMPRESA" : "NO HAY UN NOTABLE IMPACTO DE FACTORES MEDIO AMBIENTALES EN EL FUNCIONAMIENTO DE LA EMPRESA";
        $dataToSave['reflexion_politico_texto'] = ($dataToSave['RFPoliticos'] >= $umbral) ? "HAY UN NOTABLE IMPACTO DE FACTORES POLÍTICOS EN EL FUNCIONAMIENTO DE LA EMPRESA" : "NO HAY UN NOTABLE IMPACTO DE FACTORES POLÍTICOS EN EL FUNCIONAMIENTO DE LA EMPRESA";
        $dataToSave['reflexion_economico_texto'] = ($dataToSave['RFEconomicos'] >= $umbral) ? "HAY UN NOTABLE IMPACTO DE FACTORES ECONÓMICOS EN EL FUNCIONAMIENTO DE LA EMPRESA" : "NO HAY UN NOTABLE IMPACTO DE FACTORES ECONÓMICOS EN EL FUNCIONAMIENTO DE LA EMPRESA";
        $dataToSave['reflexion_tecnologico_texto'] = ($dataToSave['RFTecnologicos'] >= $umbral) ? "HAY UN NOTABLE IMPACTO DE FACTORES TECNOLÓGICOS EN EL FUNCIONAMIENTO DE LA EMPRESA" : "NO HAY UN NOTABLE IMPACTO DE FACTORES TECNOLÓGICOS EN EL FUNCIONAMIENTO DE LA EMPRESA";

        Pest::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            $dataToSave
        );

        return redirect()->route('proyectos.showPest', $proyecto->id)->with('success', 'Análisis PEST guardado con éxito.');
    }
}