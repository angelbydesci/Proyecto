<?php

namespace App\Http\Controllers;

use App\Models\Correcion;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class CorrecionController extends Controller
{
    public function create(Proyecto $proyecto)
    {
        if ($proyecto->user_id !== auth()->id()) {
            abort(403);
        }

        $correcion = Correcion::where('proyecto_id', $proyecto->id)->first();
        return view('matriz_came', compact('correcion', 'proyecto'));
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        if ($proyecto->user_id !== auth()->id()) {
            abort(403);
        }

        Correcion::updateOrCreate(
            ['proyecto_id' => $proyecto->id],
            $request->except(['_token', 'proyecto_id'])
        );

        return redirect()->route('proyectos.showMatrizCame', ['proyecto' => $proyecto->id])->with('success', 'Matriz CAME guardada con éxito.');
    }
}
