<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\TCM;
use App\Models\Competidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importante para transacciones

class AutodiagnosticoBCGController extends Controller
{
    /**
     * Muestra la vista del autodiagnóstico BCG para un proyecto específico.
     * Asumo que ya tienes una ruta y método para mostrar la vista, 
     * como 'proyectos.showAutodiagnosticoBCG' que se ve en el error.
     * Si no, necesitarías algo como esto:
     */
    // public function show(Proyecto $proyecto)
    // {
    //     // Cargar productos y datos relacionados si es necesario para la vista inicial
    //     $productos = $proyecto->productos()->with(['tcms', 'competidores'])->get();
    //     return view('autodiagnostico_bcg', compact('proyecto', 'productos'));
    // }

    /**
     * Guarda los datos del formulario del Autodiagnóstico BCG.
     */
    public function saveBcgData(Request $request, Proyecto $proyecto)
    {
        // Validación básica inicial (puedes expandirla)
        $validatedData = $request->validate([
            'products' => 'sometimes|array',
            'products.*.id_temp' => 'required|string',
            'products.*.name' => 'required|string|max:255',
            'products.*.sales' => 'required|numeric|min:0',
            'products.*.historical_growth' => 'sometimes|array',
            'products.*.historical_growth.*' => 'nullable|numeric', // Porcentaje para cada período
            'products.*.competitors' => 'sometimes|array',
            'products.*.competitors.*.id_temp' => 'required|string',
            'products.*.competitors.*.name' => 'required|string|max:255',
            'products.*.competitors.*.sales' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            if (isset($validatedData['products'])) {
                foreach ($validatedData['products'] as $productData) {
                    // Aquí asumimos que podrías estar actualizando o creando.
                    // Para un sistema robusto, necesitarías identificar si el producto ya existe en la BD
                    // (por ejemplo, si pasas un 'id' real desde el frontend o buscas por nombre y proyecto_id).
                    // Por ahora, vamos a crear o actualizar basándonos en el nombre si ya existe para este proyecto,
                    // o crear uno nuevo. Esto es una simplificación.

                    $producto = $proyecto->productos()->updateOrCreate(
                        ['nombre' => $productData['name']], // Criterio de búsqueda
                        ['venta' => $productData['sales']]   // Valores para actualizar o crear
                    );

                    // Eliminar TCMs y Competidores antiguos para este producto antes de agregar los nuevos
                    // Esto simplifica la lógica para no tener que rastrear IDs individuales desde el frontend para borrados.
                    $producto->tcms()->delete();
                    $producto->competidores()->delete();

                    // Guardar TCMs
                    if (!empty($productData['historical_growth'])) {
                        foreach ($productData['historical_growth'] as $periodo => $porcentaje) {
                            if (!is_null($porcentaje)) { // Solo guardar si hay un valor
                                $producto->tcms()->create([
                                    'periodo' => $periodo, // '2023-2024', etc.
                                    'porcentaje' => $porcentaje,
                                ]);
                            }
                        }
                    }

                    // Guardar Competidores
                    if (!empty($productData['competitors'])) {
                        foreach ($productData['competitors'] as $competitorData) {
                            $producto->competidores()->create([
                                'nombre' => $competitorData['name'],
                                'venta' => $competitorData['sales'],
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            // La ruta 'proyectos.showAutodiagnosticoBCG' debe existir y aceptar $proyecto como parámetro.
            return redirect()->route('proyectos.showAutodiagnosticoBCG', $proyecto)->with('success', 'Datos del BCG guardados exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Error guardando BCG: '.$e->getMessage()); // Es buena idea loguear el error
            return redirect()->back()->with('error', 'Error al guardar los datos del BCG: ' . $e->getMessage())->withInput();
        }
    }
}
