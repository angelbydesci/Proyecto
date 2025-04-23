{{-- resources/views/valores.blade.php --}}
@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container">
    <!-- Título -->
    <h2>VALORES</h2>
    
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

    <!-- Formulario para valores de la empresa -->
    <div class="mb-4 p-4 border rounded bg-light">
        <h4 class="mb-3">En este apartado exponga los Valores de su empresa</h4>
        
        @for($i = 1; $i <= 6; $i++)
            <div class="form-group mb-3">
                <label for="valor{{ $i }}">Valor {{ $i }}:</label>
                <textarea 
                    id="valor{{ $i }}" 
                    class="form-control" 
                    rows="2" 
                    placeholder="Describa el valor {{ $i }} de su empresa"
                    name="valores[]"></textarea>
            </div>
        @endfor
    </div>

    <!-- Botones de navegación -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('vision') }}" class="btn btn-secondary">Volver a Vision</a>
        <a href="{{ route('objetivos') }}" class="btn btn-success">Ir a Objetivos Estrategicos</a>
    </div>
</div>
@endsection