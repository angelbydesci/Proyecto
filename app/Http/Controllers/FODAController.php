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
            'fortaleza3' => 'nullable|string|max:65535',
            'fortaleza4' => 'nullable|string|max:65535',
            'debilidad1' => 'nullable|string|max:65535',
            'debilidad2' => 'nullable|string|max:65535',
            'debilidad3' => 'nullable|string|max:65535',
            'debilidad4' => 'nullable|string|max:65535',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Obtener fortalezas y debilidades actuales
        $fortalezasActual = \App\Models\Fortaleza::where('proyecto_id', $proyecto->id)->first();
        $debilidadesActual = \App\Models\Debilidad::where('proyecto_id', $proyecto->id)->first();

        // Guardar o actualizar Fortalezas SIN borrar las existentes
        \App\Models\Fortaleza::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            [
                'fortaleza1' => $request->filled('fortaleza1') ? $request->input('fortaleza1') : ($fortalezasActual->fortaleza1 ?? null),
                'fortaleza2' => $request->filled('fortaleza2') ? $request->input('fortaleza2') : ($fortalezasActual->fortaleza2 ?? null),
                'fortaleza3' => $request->filled('fortaleza3') ? $request->input('fortaleza3') : ($fortalezasActual->fortaleza3 ?? null),
                'fortaleza4' => $request->filled('fortaleza4') ? $request->input('fortaleza4') : ($fortalezasActual->fortaleza4 ?? null),
            ]
        );

        // Guardar o actualizar Debilidades SIN borrar las existentes
        \App\Models\Debilidad::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            [
                'debilidad1' => $request->filled('debilidad1') ? $request->input('debilidad1') : ($debilidadesActual->debilidad1 ?? null),
                'debilidad2' => $request->filled('debilidad2') ? $request->input('debilidad2') : ($debilidadesActual->debilidad2 ?? null),
                'debilidad3' => $request->filled('debilidad3') ? $request->input('debilidad3') : ($debilidadesActual->debilidad3 ?? null),
                'debilidad4' => $request->filled('debilidad4') ? $request->input('debilidad4') : ($debilidadesActual->debilidad4 ?? null),
            ]
        );

        return redirect()->back()->with('success', 'Análisis FODA guardado correctamente.');
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
