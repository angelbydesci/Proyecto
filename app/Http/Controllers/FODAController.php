<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Fortaleza;
use App\Models\Debilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Asegúrate de importar Validator

class FODAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        $validator = Validator::make($request->all(), [
            'fortaleza1' => 'nullable|string|max:65535', // TEXT puede almacenar hasta 65,535 caracteres
            'fortaleza2' => 'nullable|string|max:65535',
            'debilidad1' => 'nullable|string|max:65535',
            'debilidad2' => 'nullable|string|max:65535',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Guardar o actualizar Fortalezas
        Fortaleza::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            [
                'fortaleza1' => $request->filled('fortaleza1') ? $request->input('fortaleza1') : null,
                'fortaleza2' => $request->filled('fortaleza2') ? $request->input('fortaleza2') : null,
                // Los campos fortaleza3 y fortaleza4 se omiten ya que no están en el formulario actual
            ]
        );

        // Guardar o actualizar Debilidades
        Debilidad::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            [
                'debilidad1' => $request->filled('debilidad1') ? $request->input('debilidad1') : null,
                'debilidad2' => $request->filled('debilidad2') ? $request->input('debilidad2') : null,
                // Los campos debilidad3 y debilidad4 se omiten
            ]
        );

        // Opcional: Eliminar registros de Oportunidades y Amenazas si ya no se usan
        // Oportunidad::where('proyecto_id', $proyecto->id)->delete();
        // Amenaza::where('proyecto_id', $proyecto->id)->delete();

        return redirect()->route('proyectos.showAutodiagnosticoCadenaDeValor', $proyecto->id)
                         ->with('success', 'Análisis FODA guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
