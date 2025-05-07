<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Proyectos</title>
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
</head>
<body>
  <div class="dashboard-container">
    <!-- Contenido del dashboard aquí -->
    <div class="header">
        <h1>Selección de Proyectos</h1>
        <p>Seleccione el proyecto con el que desea trabajar</p>
    </div>

    <div class="projects-list">
        @forelse ($proyectos as $proyecto)
            <div class="project-card">
                <input type="radio" name="selected_project" id="project_{{ $proyecto->id }}" value="{{ $proyecto->id }}">
                <label for="project_{{ $proyecto->id }}">
                    <h3>{{ $proyecto->nombre_proyecto }}</h3>
                    <p>Creado: {{ $proyecto->created_at->format('d/m/Y') }}</p>
                    <p>Última modificación: {{ $proyecto->updated_at ? $proyecto->updated_at->format('d/m/Y') : 'Sin modificaciones' }}</p>
                </label>
            </div>
        @empty
            <p>No hay proyectos disponibles. ¡Crea uno nuevo!</p>
        @endforelse
    </div>

    <div class="actions">

        <a href="{{ route('dashboard2') }}" class="btn btn-primary">Seleccionar Proyecto</a>
    </div>
  </div>
</body>
</html>