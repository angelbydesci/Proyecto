<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto</title>
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
</head>
<body>
    <div class="form-container">
        <h1>Crear Nuevo Proyecto</h1>
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_proyecto">Nombre del Proyecto</label>
                <input type="text" id="nombre_proyecto" name="nombre_proyecto" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
                <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>