<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class PorterController extends Controller
{
    public function showAutodiagnosticoPorter(Proyecto $proyecto)
    {
        return view('autodiagnostico_porter', compact('proyecto'));
    }
}
