<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Proyectos</title>
    @vite(['resources/css/dashboard.css', 'resources/js/app.js', 'resources/js/dashboard.js'])
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
        <a href="#" id="select-project-link" class="btn btn-primary">Seleccionar Proyecto</a>
        <button id="add-project-btn" class="btn btn-secondary">Agregar Proyecto</button>
    </div>

    <!-- Formulario para agregar un proyecto -->
    <div id="add-project-form" class="add-project-form">
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_proyecto">Nombre del Proyecto</label>
                <input type="text" id="nombre_proyecto" name="nombre_proyecto" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" id="cancel-add-project" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>
  </div>
</body>
</html>