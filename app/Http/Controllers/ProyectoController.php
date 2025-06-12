<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\CadenaDeValor; // Asegúrate de importar el modelo CadenaDeValor
use App\Models\Fortaleza; // Importar el modelo Fortaleza
use App\Models\Debilidad; // Importar el modelo Debilidad
use Illuminate\Http\Request;
// Asegúrate de que los modelos Producto, TCM y Competidor están importados si no lo están ya.
use App\Models\Producto; 
use App\Models\Pest; // Asegúrate de importar el modelo Pest

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

        $proyecto = Proyecto::agregarProyecto([
            'user_id' => auth()->id(),
            'nombre_proyecto' => $request->nombre_proyecto,
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir a la vista dashboard2 del proyecto recién creado
        return redirect()->route('dashboard2', ['proyecto' => $proyecto]);
    }

    /**
     * Muestra el dashboard específico de un proyecto.
     *
     * @param \App\Models\Proyecto $proyecto
     * @return \Illuminate\View\View
     */
    public function showDashboard2(Proyecto $proyecto)
    {
        // Asegurarse de que el proyecto pertenece al usuario autenticado (opcional, pero recomendado)
        if ($proyecto->user_id !== auth()->id()) {
            abort(403); // O redirigir a alguna parte, o manejar como prefieras
        }

        return view('dashboard2', compact('proyecto'));
    }

    // ... Aquí podrían ir los métodos showMision, showVision, etc. que ya tienes en tu archivo de rutas ...
    // Asegúrate de que existan o créalos según sea necesario. Por ejemplo:

    public function showMision(Proyecto $proyecto)
    {
        // Lógica para mostrar la misión del proyecto
        return view('mision', compact('proyecto'));
    }

    public function showVision(Proyecto $proyecto)
    {
        // Lógica para mostrar la visión del proyecto
        return view('vision', compact('proyecto'));
    }

    public function showUnidadesEstrategicas(Proyecto $proyecto)
    {
        // Lógica para mostrar las unidades estratégicas
        return view('ruta.a.tu.vista.unidades.estrategicas', compact('proyecto')); // Ajusta la ruta de la vista
    }

    public function showObjetivos(Proyecto $proyecto)
    {
        // Lógica para mostrar los objetivos
        return view('objetivos', compact('proyecto'));
    }

    public function showCadenaDeValor(Proyecto $proyecto)
    {
        // Solo mostrar la vista, sin consultar la base de datos
        return view('cadena_de_valor', compact('proyecto'));
    }

    public function showMatrizParticipacion(Proyecto $proyecto)
    {
        // Lógica para mostrar la matriz de participación
        // Asegúrate de que la vista y los datos necesarios estén configurados
        return view('matriz_participacion', compact('proyecto')); // Ajusta la ruta de la vista
    }

    public function showAutodiagnosticoBCG(Proyecto $proyecto)
    {
        if ($proyecto->user_id !== auth()->id()) {
            abort(403);
        }

        $productosExistentes = $proyecto->productos()->with(['tcms', 'competidores'])->get()->map(function ($producto) {
            return [
                'id_producto' => $producto->id,
                'nombre_producto' => $producto->nombre,
                'ventas_anuales_producto' => $producto->venta,
                'tcms' => $producto->tcms->map(function ($tcm) {
                    return [
                        'id_tcm' => $tcm->id,
                        'anio_crecimiento' => $tcm->periodo,
                        'tasa_crecimiento' => $tcm->porcentaje,
                    ];
                })->toArray(),
                'competidores' => $producto->competidores->map(function ($competidor) {
                    return [
                        'id_competidor' => $competidor->id,
                        'nombre_competidor' => $competidor->nombre,
                        'ventas_anuales_competidor' => $competidor->venta,
                    ];
                })->toArray(),
            ];
        })->toArray();

        // Cargar fortalezas y debilidades del proyecto
        $fortalezas = \App\Models\Fortaleza::where('proyecto_id', $proyecto->id)->first();
        $debilidades = \App\Models\Debilidad::where('proyecto_id', $proyecto->id)->first();

        return view('autodiagnostico_bcg', compact('proyecto', 'productosExistentes', 'fortalezas', 'debilidades'));
    }
    
    public function showLas5Fuerzas(Proyecto $proyecto)
    {
        return view('las_5_fuerzas', compact('proyecto'));
    }

    public function showPest(Proyecto $proyecto)
    {
        // Cargar los datos de PEST existentes para este proyecto, si los hay
        $pestData = Pest::where('proyecto_id', $proyecto->id)->first();
        return view('pest', compact('proyecto', 'pestData')); // Pasar $pestData a la vista
    }

    public function showEstrategia(Proyecto $proyecto)
    {
        return view('estrategia', compact('proyecto'));
    }

    public function showMatrizCame(Proyecto $proyecto)
    {
        return view('matriz_came', compact('proyecto'));
    }

    public function showAutodiagnosticoCadenaDeValor(Proyecto $proyecto)
    {
        // Asegurarse de que el proyecto pertenece al usuario autenticado (opcional, pero recomendado)
        if ($proyecto->user_id !== auth()->id()) {
            abort(403);
        }
        // Cargar los datos existentes de CadenaDeValor para este proyecto
        $autodiagnostico = CadenaDeValor::where('proyecto_id', $proyecto->id)->first();
        // Cargar los datos existentes de Fortalezas para este proyecto
        $fortalezas = Fortaleza::where('proyecto_id', $proyecto->id)->first();
        // Cargar los datos existentes de Debilidades para este proyecto
        $debilidades = Debilidad::where('proyecto_id', $proyecto->id)->first();

        return view('autodiagnostico_cadena_de_valor', compact('proyecto', 'autodiagnostico', 'fortalezas', 'debilidades'));
    }

    // Métodos para actualizar (PATCH/PUT)
    public function updateMision(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'mision' => 'required|string',
        ]);
        $proyecto->mision = $request->input('mision');
        $proyecto->save(); // Asegúrate de guardar el proyecto
        return redirect()->route('proyectos.showMision', $proyecto)->with('success', 'Misión actualizada correctamente.');
    }

    public function updateVision(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'vision' => 'required|string',
        ]);
        $proyecto->vision = $request->input('vision');
        $proyecto->save(); // Asegúrate de guardar el proyecto
        return redirect()->route('proyectos.showVision', $proyecto)->with('success', 'Visión actualizada correctamente.');
    }

    public function updateUnidadesEstrategicas(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'unidades_estrategicas' => 'nullable|string',
        ]);

        $proyecto->unidades_estrategicas = $request->input('unidades_estrategicas');
        $proyecto->save();

        return redirect()->route('proyectos.showObjetivos', $proyecto)->with('success_uen', 'Unidades Estratégicas actualizadas correctamente.');
    }

    public function showAnalisisInterno($proyecto)
    {
        // Puedes pasar $proyecto a la vista si lo necesitas
        return view('analisis_interno', compact('proyecto'));
    }
}