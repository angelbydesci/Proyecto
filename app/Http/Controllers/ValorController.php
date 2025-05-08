<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Valor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ValorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Proyecto $proyecto): View
    {
        // Cargar los valores asociados al proyecto, ordenados por fecha de creación
        $valores = $proyecto->valores()->orderBy('created_at', 'asc')->get();
        return view('valores', compact('proyecto', 'valores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Proyecto $proyecto)
    {
        // Este método podría usarse si tuvieras una página separada para "Crear Valor"
        // Por ahora, el formulario estará en la vista index (valores.blade.php)
        // return view('valores.create', compact('proyecto')); 
        return redirect()->route('proyectos.valores.index', $proyecto);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Proyecto $proyecto): RedirectResponse
    {
        $request->validate([
            'valor' => 'required|string|max:255',
        ]);

        $proyecto->valores()->create([
            'valor' => $request->input('valor'),
        ]);

        return redirect()->route('proyectos.valores.index', $proyecto)
                         ->with('success', 'Valor agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Valor $valor)
    {
        // No es común necesitar una vista "show" para un solo valor en este contexto
        // Se podría redirigir o implementar si es necesario
        return redirect()->route('proyectos.valores.index', $valor->proyecto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valor $valor)
    {
        // Implementar si se necesita editar valores individualmente
        // $proyecto = $valor->proyecto;
        // return view('valores.edit', compact('valor', 'proyecto'));
        return redirect()->route('proyectos.valores.index', $valor->proyecto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Valor $valor)
    {
        // Implementar si se necesita editar valores individualmente
        // $request->validate(['valor' => 'required|string|max:255']);
        // $valor->update(['valor' => $request->input('valor')]);
        // return redirect()->route('proyectos.valores.index', $valor->proyecto)
        //                  ->with('success', 'Valor actualizado exitosamente.');
        return redirect()->route('proyectos.valores.index', $valor->proyecto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valor $valor): RedirectResponse
    {
        $proyecto = $valor->proyecto; // Guardar el proyecto antes de eliminar
        $valor->delete();
        return redirect()->route('proyectos.valores.index', $proyecto)
                         ->with('success', 'Valor eliminado exitosamente.');
    }
}
