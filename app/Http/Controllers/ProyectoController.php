<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Muestra la lista de proyectos en el dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener los proyectos del usuario autenticado
        $proyectos = Proyecto::listarProyectosPorUsuario(auth()->id());

        return view('dashboard', compact('proyectos'));
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('crear-proyecto');
    }

    /**
     * Almacena un nuevo proyecto en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_proyecto' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        Proyecto::agregarProyecto([
            'user_id' => auth()->id(),
            'nombre_proyecto' => $request->nombre_proyecto,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('dashboard')->with('success', 'Proyecto creado exitosamente.');
    }
}