{{-- resources/views/valores.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])


<div class="container">
    <!-- Título -->
    <h2>VALORES DEL PROYECTO: {{ $proyecto->nombre_proyecto }}</h2>
    
    <!-- Explicación sobre valores -->
    <div class="mb-4 p-3 bg-light rounded">
        <p>Los <strong>VALORES</strong> de una empresa son el conjunto de principios, reglas y aspectos culturales con los que se rige la organización. Son las pautas de comportamiento de la empresa y generalmente son pocos, entre 3 y 6. Son tan fundamentales y tan arraigados que casi nunca cambian.</p>
    </div>

    <!-- Ejemplo de valores -->
    <div class="mb-4">
        <h4>Ejemplo de valores:</h4>
        <ul>
            <li>Integridad</li>
            <li>Compromiso con el desarrollo humano</li>
            <li>Ética profesional</li>
            <li>Responsabilidad social</li>
            <li>Innovación</li>
            <li>Etc</li>
        </ul>
    </div>

    <!-- Ejemplos por tipo de empresa -->
    <div class="mb-4">
        <h4>EJEMPLOS</h4>
        
        <div class="p-3 mb-3 border rounded">
            <h5>Empresa de servicios</h5>
            <ul>
                <li>La excelencia en la prestación de servicios</li>
                <li>La innovación orientada a la mejora continua de procesos productos y servicios</li>
                <li>La promoción del diálogo y compromiso con los grupos de interés</li>
            </ul>
        </div>
        
        <div class="p-3 mb-3 border rounded">
            <h5>Empresa productora de café</h5>
            <p>Nuestro valor es la búsqueda de la perfección o bien la pasión por la excelencia, entendida como amor por lo bello y bien hecho, y la ética, entendida como construcción de valor en el tiempo a través de la sostenibilidad, la transparencia, y la valorización de las personas.</p>
        </div>
        
        <div class="p-3 mb-3 border rounded">
            <h5>Agencia de certificación</h5>
            <ul>
                <li>Integridad y ética</li>
                <li>Consejo y validación imparciales</li>
                <li>Respeto por todas las personas</li>
                <li>Responsabilidad social y medioambiental</li>
            </ul>
        </div>
    </div>

    <!-- Sección para mostrar y agregar valores -->
    <div class="mb-4 p-4 border rounded bg-light">
        <h4 class="mb-3">Valores de su proyecto</h4>

        @if ($valores->isEmpty())
            <p>Aún no se han agregado valores para este proyecto.</p>
        @else
            <ul class="list-group mb-3">
                @foreach ($valores as $valor)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span style="flex-grow: 1; margin-right: 10px;">{{ $valor->valor }}</span>
                        {{-- Formulario para eliminar valor --}}
                        <form action="{{ route('valores.destroy', $valor) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este valor?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        {{-- Formulario para agregar valor --}}
        <div id="addValorSection" class="mt-3">
            <form action="{{ route('proyectos.valores.store', $proyecto) }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="valor_texto">Nuevo Valor:</label>
                    <textarea id="valor_texto" name="valor" class="form-control" rows="2" placeholder="Describa el nuevo valor aquí..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Valor</button>
            </form>
        </div>
    </div>

    <!-- Mensajes de éxito y error -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Botones de navegación -->
</div>
