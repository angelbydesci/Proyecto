<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Muestra la vista de la misión
    public function mision()
    {
        return view('mision');
    }

    // Muestra la vista de la visión
    public function vision()
    {
        return view('vision');
    }

    public function valores()
    {
        return view('valores');
    }

    // Muestra la vista del dashboard
    public function dashboard()
    {
        return view('dashboard');
    }
    public function dashboard2()
    {
        return view('dashboard2');
    }

    public function analisis_interno()
    {
        return view('analisis_interno');
    }

    public function objetivos()
    {
        return view('objetivos');
    }
    
}
