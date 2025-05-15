<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\ObjetivoPrincipal;
use App\Models\ObjetivoEspecifico;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    /**
     * Almacena un nuevo objetivo principal para un proyecto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePrincipal(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'objetivo_principal' => 'required|string|max:1000',
        ]);

        $proyecto->objetivosPrincipales()->create([
            'objetivo' => $request->input('objetivo_principal'),
        ]);

        return redirect()->route('proyectos.showObjetivos', $proyecto)->with('success_obj_principal', 'Objetivo principal añadido correctamente.');
    }

    /**
     * Almacena un nuevo objetivo específico para un objetivo principal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObjetivoPrincipal  $objetivoPrincipal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeEspecifico(Request $request, ObjetivoPrincipal $objetivoPrincipal)
    {
        $request->validate([
            'objetivo_especifico' => 'required|string|max:1000',
        ]);

        $objetivoPrincipal->objetivosEspecificos()->create([
            'objetivo' => $request->input('objetivo_especifico'),
        ]);

        return redirect()->route('proyectos.showObjetivos', $objetivoPrincipal->proyecto_id)->with('success_obj_especifico', 'Objetivo específico añadido correctamente.');
    }

    /**
     * Edita un objetivo principal.
     */
    public function updatePrincipal(Request $request, ObjetivoPrincipal $objetivoPrincipal)
    {
        $request->validate([
            'objetivo_principal' => 'required|string|max:1000',
        ]);

        $objetivoPrincipal->update([
            'objetivo' => $request->input('objetivo_principal'),
        ]);

        return redirect()->route('proyectos.showObjetivos', $objetivoPrincipal->proyecto_id)->with('success_obj_principal', 'Objetivo principal actualizado correctamente.');
    }

    /**
     * Elimina un objetivo principal.
     */
    public function destroyPrincipal(ObjetivoPrincipal $objetivoPrincipal)
    {
        $proyectoId = $objetivoPrincipal->proyecto_id;
        $objetivoPrincipal->delete();

        return redirect()->route('proyectos.showObjetivos', $proyectoId)->with('success_obj_principal', 'Objetivo principal eliminado correctamente.');
    }

    /**
     * Edita un objetivo específico.
     */
    public function updateEspecifico(Request $request, ObjetivoEspecifico $objetivoEspecifico)
    {
        $request->validate([
            'objetivo_especifico' => 'required|string|max:1000',
        ]);

        $objetivoEspecifico->update([
            'objetivo' => $request->input('objetivo_especifico'),
        ]);

        return redirect()->route('proyectos.showObjetivos', $objetivoEspecifico->objetivoPrincipal->proyecto_id)->with('success_obj_especifico', 'Objetivo específico actualizado correctamente.');
    }

    /**
     * Elimina un objetivo específico.
     */
    public function destroyEspecifico(ObjetivoEspecifico $objetivoEspecifico)
    {
        $proyectoId = $objetivoEspecifico->objetivoPrincipal->proyecto_id;
        $objetivoEspecifico->delete();

        return redirect()->route('proyectos.showObjetivos', $proyectoId)->with('success_obj_especifico', 'Objetivo específico eliminado correctamente.');
    }
}
