{{-- resources/views/vision.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])


<div class="container">
    <!-- Título de la Visión -->
    <h2>VISIÓN DEL PROYECTO: {{ $proyecto->nombre_proyecto }}</h2>
    
    <p>"La VISIÓN de una empresa define lo que quiere lograr en el futuro. Es lo que la organización aspira llegar a ser en torno a 2-3 años."</p>
    <ul>
        <li>Debe ser retadora, positiva, compartida y coherente con la misión.</li>
        <li>Marca el fin último que la estrategia debe seguir.</li>
        <li>Proyecta la imagen de destino que se pretende alcanzar.</li>
    </ul>

    <p>La visión debe ser conocida y compartida por todos los miembros de la empresa y también por aquellos que se relacionan con ella.</p>
    
    <h3>EJEMPLOS</h3>
    <h4>Empresa de servicios</h4>
    <p>"Ser el grupo empresarial de referencia en nuestras áreas de actividad."</p>

    <h4>Empresa productora de café</h4>
    <p>"Queremos ser en el mundo el punto de referencia de la cultura y de la excelencia del café. Una empresa innovadora que propone los mejores productos y lugares de consumo y que, gracias a ello, crece y se convierte en líder de la alta gama."</p>

    <h4>Agencia de certificación</h4>
    <p>"Ser líderes en nuestro sector y un actor principal en todos los segmentos de mercado en los que estamos presentes, en los mercados clave."</p>
    
    <h4>En este apartado describa la Visión de su proyecto:</h4>
    
    <form action="{{ route('proyectos.updateVision', $proyecto) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <textarea name="vision" class="form-control" rows="4" placeholder="Escriba la visión de su proyecto aquí...">{{ old('vision', $proyecto->vision ?? '') }}</textarea>
        </div>

        <!-- Relación entre Misión y Visión (No lo usare Creo)
        <div class="mt-4 p-3 bg-light rounded">
            <h3>Relación entre Misión y Visión</h3>
            <div class="row text-center">
                <div class="col-md-4">
                    <h5>¿Cuál es la situación actual?</h5>
                    <p class="text-muted">(Misión)</p>
                </div>
                <div class="col-md-4">
                    <h5>¿Qué camino a seguir?</h5>
                    <p class="text-muted">(Estrategia)</p>
                </div>
                <div class="col-md-4">
                    <h5>¿Cuál es la situación futura?</h5>
                    <p class="text-muted">(Visión)</p>
                </div>
            </div>
        </div> -->

        <!-- Botones en la parte inferior -->
        <div class="d-flex justify-content-between mt-4">
            <!-- Botón para volver a misión (izquierda) -->
            <div>
                <button type="submit" class="btn btn-primary mr-2">Guardar Visión</button>
            </div>
        </div>
    </form>


</div>
