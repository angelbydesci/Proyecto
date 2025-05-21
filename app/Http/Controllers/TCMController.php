<?php

namespace App\Http\Controllers;

use App\Models\TCM;
use App\Models\Producto;
use Illuminate\Http\Request;

class TCMController extends Controller
{
    /**
     * Store a newly created TCM record in storage.
     */
    public function store(Request $request, Producto $producto)
    {
        $validatedData = $request->validate([
            'porcentaje' => 'required|numeric|min:0|max:100',
            'periodo' => 'required|string|max:255', // Ejemplo: '2023-2024'
        ]);

        $tcm = $producto->tcms()->create($validatedData);

        return redirect()->route('proyectos.showAutodiagnosticoBCG', $producto->proyecto)->with('success', 'TCM agregado exitosamente.');
    }

    /**
     * Update the specified TCM record in storage.
     */
    public function update(Request $request, TCM $tcm)
    {
        $validatedData = $request->validate([
            'porcentaje' => 'required|numeric|min:0|max:100',
            'periodo' => 'required|string|max:255',
        ]);

        $tcm->update($validatedData);

        return redirect()->route('proyectos.showAutodiagnosticoBCG', $tcm->producto->proyecto)->with('success', 'TCM actualizado exitosamente.');
    }

    /**
     * Remove the specified TCM record from storage.
     */
    public function destroy(TCM $tcm)
    {
        $proyecto = $tcm->producto->proyecto;
        $tcm->delete();

        return redirect()->route('proyectos.showAutodiagnosticoBCG', $proyecto)->with('success', 'TCM eliminado exitosamente.');
    }
}