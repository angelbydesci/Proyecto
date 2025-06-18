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
}
