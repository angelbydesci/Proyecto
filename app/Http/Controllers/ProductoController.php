<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Store a newly created producto in storage.
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'venta' => 'required|numeric|min:0',
        ]);

        $producto = $proyecto->productos()->create($validatedData);

        // Redirigir a la vista del autodiagnóstico BCG, pasando el proyecto
        return redirect()->route('proyectos.showAutodiagnosticoBCG', $proyecto)->with('success', 'Producto agregado exitosamente.');
    }

    /**
     * Update the specified producto in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'venta' => 'required|numeric|min:0',
        ]);

        $producto->update($validatedData);
        
        // Redirigir a la vista del autodiagnóstico BCG, pasando el proyecto del producto
        return redirect()->route('proyectos.showAutodiagnosticoBCG', $producto->proyecto)->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified producto from storage.
     */
    public function destroy(Producto $producto)
    {
        $proyecto = $producto->proyecto; // Guardar la referencia al proyecto antes de eliminar
        // Considerar eliminar TCMs y Competidores asociados si es necesario (on delete cascade en BD ya lo hace)
        $producto->delete();

        return redirect()->route('proyectos.showAutodiagnosticoBCG', $proyecto)->with('success', 'Producto eliminado exitosamente.');
    }
}