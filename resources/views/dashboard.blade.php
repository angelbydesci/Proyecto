{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@vite(['resources/css/dashboard.css', 'resources/js/app.js'])
@section('content')
<div class="dashboard-container">
    <div class="header">
        <h1>Selección de Proyectos</h1>
        <p>Seleccione el proyecto con el que desea trabajar</p>
    </div>

    <div class="projects-list">
        <!-- Proyecto 1 - Estático -->
        <div class="project-card">
            <input type="radio" name="selected_project" id="project_1" value="1" checked>
            <label for="project_1">
                <h3>Proyecto Ejemplo 1</h3>
                <p>Creado: {{ now()->format('d/m/Y') }}</p>
                <p>Última modificación: {{ now()->format('d/m/Y') }}</p>
            </label>
        </div>

        <!-- Proyecto 2 - Estático -->
        <div class="project-card">
            <input type="radio" name="selected_project" id="project_2" value="2">
            <label for="project_2">
                <h3>Proyecto Ejemplo 2</h3>
                <p>Creado: {{ now()->subDays(3)->format('d/m/Y') }}</p>
                <p>Última modificación: {{ now()->subDays(1)->format('d/m/Y') }}</p>
            </label>
        </div>

        <!-- Proyecto 3 - Estático -->
        <div class="project-card">
            <input type="radio" name="selected_project" id="project_3" value="3">
            <label for="project_3">
                <h3>Proyecto Ejemplo 3</h3>
                <p>Creado: {{ now()->subWeek()->format('d/m/Y') }}</p>
                <p>Última modificación: {{ now()->subDays(2)->format('d/m/Y') }}</p>
            </label>
        </div>
    </div>

    <div class="actions">
        
        <a href="{{ route('dashboard2') }}" class="btn btn-primary">Seleccionar Proyecto</a>
    </div>
</div>
@endsection
