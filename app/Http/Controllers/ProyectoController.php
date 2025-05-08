<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProyectoController extends Controller
{
    /**
     * Muestra la lista de proyectos en el dashboard.
     */
    public function index(): View
    {
        $proyectos = Proyecto::listarProyectosPorUsuario(auth()->id());
        return view('dashboard', compact('proyectos'));
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto.
     */
    public function create(): View
    {
        return view('crear-proyecto'); // Asumiendo que tienes una vista para esto
    }

    /**
     * Almacena un nuevo proyecto en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_proyecto' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            // No se validan mision, vision, unidades_estrategicas aquí directamente,
            // ya que se manejarán como nulos por defecto en el modelo si no se proporcionan.
        ]);

        Proyecto::agregarProyecto([
            'user_id' => auth()->id(),
            'nombre_proyecto' => $request->nombre_proyecto,
            'descripcion' => $request->descripcion,
            // Los campos mision, vision, unidades_estrategicas se pasarán como null
            // o con su valor si se envían desde el formulario (aunque el form actual no los tiene)
            'mision' => $request->input('mision'),
            'vision' => $request->input('vision'),
            'unidades_estrategicas' => $request->input('unidades_estrategicas'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Muestra la misión de un proyecto específico.
     */
    public function showMision(Proyecto $proyecto): View
    {
        // Aquí se podría añadir lógica de autorización si es necesario
        // if ($proyecto->user_id !== auth()->id()) {
        //     abort(403);
        // }
        return view('mision', [ // Cambiado de 'proyectos.show_mision' a 'mision'
            'proyecto' => $proyecto,
            'mision' => $proyecto->getMision() // Usando el método del modelo
        ]);
    }

    /**
     * Muestra la visión de un proyecto específico.
     */
    public function showVision(Proyecto $proyecto): View
    {
        return view('vision', [ // CORREGIDO: Cambiado de 'proyectos.show_vision' a 'vision'
            'proyecto' => $proyecto,
            'vision' => $proyecto->getVision() // Usando el método del modelo
        ]);
    }

    /**
     * Muestra las unidades estratégicas de un proyecto específico.
     */
    public function showUnidadesEstrategicas(Proyecto $proyecto): View
    {
        return view('proyectos.show_unidades_estrategicas', [
            'proyecto' => $proyecto,
            'unidades_estrategicas' => $proyecto->getUnidadesEstrategicas() // Usando el método del modelo
        ]);
    }

    /**
     * Actualiza la misión de un proyecto específico.
     */
    public function updateMision(Request $request, Proyecto $proyecto): RedirectResponse
    {
        $request->validate(['mision' => 'nullable|string']);
        $proyecto->actualizarMision($request->input('mision')); // Usando el método del modelo
        return redirect()->back()->with('success', 'Misión actualizada exitosamente.');
    }

    /**
     * Actualiza la visión de un proyecto específico.
     */
    public function updateVision(Request $request, Proyecto $proyecto): RedirectResponse
    {
        $request->validate(['vision' => 'nullable|string']);
        $proyecto->actualizarVision($request->input('vision')); // Usando el método del modelo
        return redirect()->back()->with('success', 'Visión actualizada exitosamente.');
    }

    /**
     * Actualiza las unidades estratégicas de un proyecto específico.
     */
    public function updateUnidadesEstrategicas(Request $request, Proyecto $proyecto): RedirectResponse
    {
        $request->validate(['unidades_estrategicas' => 'nullable|string']);
        $proyecto->actualizarUnidadesEstrategicas($request->input('unidades_estrategicas')); // Usando el método del modelo
        return redirect()->back()->with('success', 'Unidades estratégicas actualizadas exitosamente.');
    }

    /**
     * Muestra el dashboard secundario para un proyecto específico.
     */
    public function showDashboard2(Proyecto $proyecto): View
    {
        // Aquí se podría añadir lógica de autorización si es necesario
        // if ($proyecto->user_id !== auth()->id()) {
        //     abort(403);
        // }
        return view('dashboard2', compact('proyecto'));
    }
}
