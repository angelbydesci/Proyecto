<?php

namespace App\Http\Controllers;

use App\Models\Competidor;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompetidorController extends Controller
{
    /**
     * Store a newly created competidor in storage.
     */
    public function store(Request $request, Producto $producto)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'venta' => 'required|numeric|min:0',
        ]);

        $competidor = $producto->competidores()->create($validatedData);

        return redirect()->route('proyectos.showAutodiagnosticoBCG', $producto->proyecto)->with('success', 'Competidor agregado exitosamente.');
    }

    /**
     * Update the specified competidor in storage.
     */
    public function update(Request $request, Competidor $competidor)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'venta' => 'required|numeric|min:0',
        ]);

        $competidor->update($validatedData);

        return redirect()->route('proyectos.showAutodiagnosticoBCG', $competidor->producto->proyecto)->with('success', 'Competidor actualizado exitosamente.');
    }

    /**
     * Remove the specified competidor from storage.
     */
    public function destroy(Competidor $competidor)
    {
        $proyecto = $competidor->producto->proyecto;
        $competidor->delete();

        return redirect()->route('proyectos.showAutodiagnosticoBCG', $proyecto)->with('success', 'Competidor eliminado exitosamente.');
    }
}