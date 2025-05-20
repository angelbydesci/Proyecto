{{-- resources/views/autodiagnostico_cadena_de_valor.blade.php --}}

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Autodiagnóstico de la Cadena de Valor Interna</h1>

    {{-- Mostrar mensajes de sesión --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p class="mb-4 text-sm text-gray-600">
        A continuación marque con una X para valorar su empresa en función de cada una de las afirmaciones, de tal forma que 0= En total en desacuerdo; 1= No está de acuerdo; 2=Está de acuerdo; 3= Está bastante de acuerdo; 4=En total acuerdo.
    </p>

    <form method="POST" action="{{ route('cadenadevalor.storeOrUpdate', $proyecto) }}" id="reflexionForm">
        @csrf
        <div class="bg-white shadow-md rounded-lg overflow-x-auto mb-8">
            {{-- Tabla de preguntas (se mantiene la estructura para los radio buttons) --}}
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Afirmación</th>
                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">0</th>
                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">1</th>
                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">2</th>
                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">3</th>
                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">4</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $preguntasTextos = [
                            'pregunta1' => '1. ¿La empresa comunica claramente su misión y visión a todos los empleados?',
                            'pregunta2' => '2. ¿Existe un plan estratégico formal y se revisa periódicamente?',
                            'pregunta3' => '3. ¿Se establecen objetivos claros y medibles en todos los niveles de la organización?',
                            'pregunta4' => '4. ¿La alta dirección participa activamente en la definición y comunicación de la estrategia?',
                            'pregunta5' => '5. ¿Se realizan reuniones periódicas para evaluar el avance en el cumplimiento de la estrategia?',
                            'pregunta6' => '6. ¿La empresa tiene un sistema de gestión de la calidad certificado (por ejemplo, ISO 9001)?',
                            'pregunta7' => '7. ¿Se llevan a cabo auditorías internas y externas para evaluar la conformidad con los estándares de calidad?',
                            'pregunta8' => '8. ¿Se implementan acciones correctivas y preventivas de manera efectiva?',
                            'pregunta9' => '9. ¿La empresa tiene un enfoque sistemático para la mejora continua (por ejemplo, Kaizen)?',
                            'pregunta10' => '10. ¿Se utilizan indicadores clave de rendimiento (KPI) para medir el desempeño organizacional?',
                            'pregunta11' => '11. ¿La empresa realiza análisis FODA (fortalezas, oportunidades, debilidades y amenazas) periódicamente?',
                            'pregunta12' => '12. ¿Se lleva a cabo un análisis de la cadena de valor para identificar áreas de mejora?',
                            'pregunta13' => '13. ¿La empresa tiene un enfoque proactivo para la gestión de riesgos?',
                            'pregunta14' => '14. ¿Se capacita a los empleados en la identificación y gestión de riesgos?',
                            'pregunta15' => '15. ¿La empresa tiene un plan de continuidad del negocio documentado y probado?',
                            'pregunta16' => '16. ¿Se evalúa regularmente la satisfacción del cliente?',
                            'pregunta17' => '17. ¿La empresa tiene un proceso para gestionar y resolver quejas de clientes?',
                            'pregunta18' => '18. ¿Se analizan y utilizan los comentarios de los clientes para mejorar productos y servicios?',
                            'pregunta19' => '19. ¿La empresa colabora con los clientes en el desarrollo de nuevos productos o servicios?',
                            'pregunta20' => '20. ¿Se realizan estudios de mercado para identificar tendencias y oportunidades?',
                            'pregunta21' => '21. ¿La empresa tiene una estrategia de marketing digital?',
                            'pregunta22' => '22. ¿Se utilizan redes sociales para interactuar con clientes y promocionar productos/servicios?',
                            'pregunta23' => '23. ¿La empresa tiene un proceso de ventas bien definido y documentado?',
                            'pregunta24' => '24. ¿Se capacita regularmente al personal de ventas en técnicas de venta y negociación?',
                            'pregunta25' => '25. ¿La empresa invierte en la formación y desarrollo de sus empleados para mejorar sus habilidades y conocimientos en relación con la cadena de valor?'
                        ];
                    @endphp
                    @foreach ($preguntasTextos as $key => $texto)
                        <tr>
                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-700">{{ $texto }}</td>
                            @for ($i = 0; $i <= 4; $i++)
                                <td class="px-3 py-4 text-center">
                                    <input type="radio" name="{{ $key }}" value="{{ $i }}" 
                                           class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                           {{ (isset($autodiagnostico) && $autodiagnostico->$key !== null && $autodiagnostico->$key == $i) ? 'checked' : '' }}>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Contenedor para el botón de guardar respuestas y el campo de porcentaje --}}
        <div class="mt-4 mb-8 flex items-center justify-end">
            {{-- Campo para mostrar el porcentaje (no editable) --}}
            @if (isset($autodiagnostico) && $autodiagnostico->porcentaje !== null)
            <div class="mr-2">
                <label for="porcentaje_mostrado" class="block text-sm font-medium text-gray-700 mb-1 sr-only">Porcentaje:</label>
                <input type="text" id="porcentaje_mostrado" value="{{ $autodiagnostico->porcentaje }}%" 
                       class="w-20 text-center bg-gray-100 border border-gray-300 text-gray-700 py-2 px-3 rounded-md text-sm shadow-sm"
                       readonly>
            </div>
            @endif
            
            {{-- Botón para guardar solo las preguntas --}}
            <button type="submit" name="guardar_preguntas" value="1" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Guardar Respuestas
            </button>
        </div>

        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Reflexión</h2>
            <p class="text-sm text-gray-600 mb-3">
                Reflexione sobre el resultado obtenido. Anote aquellas observaciones que puedan ser de su interés.
            </p>
            <textarea name="reflexion" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Escriba aquí sus reflexiones...">{{ old('reflexion', $autodiagnostico->reflexion ?? '') }}</textarea>
            {{-- Se elimina el input hidden para "porcentaje" --}}
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" name="guardar_todo" value="1" form="reflexionForm" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Guardar Todo (Respuestas y Reflexión)
            </button>
        </div>
    </form>

    {{-- Sección FODA --}}
    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Análisis FODA</h2>
        <form method="POST" action="{{ route('foda.store', $proyecto) }}">
            @csrf
            <div class="grid grid-cols-1 gap-6"> {{-- Ajustado para una sola columna --}}
                {{-- Fortalezas --}}
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">FORTALEZAS</h3> {{-- Cambiado a mayúsculas como en la imagen --}}
                    @for ($i = 1; $i <= 2; $i++) {{-- Cambiado para mostrar solo 2 --}}
                        <div class="mb-4 flex items-center">
                            <label for="fortaleza{{ $i }}" class="block text-sm font-medium text-gray-700 w-10">F{{ $i }}:</label>
                            <input type="text" name="fortaleza{{ $i }}" id="fortaleza{{ $i }}" value="{{ old('fortaleza'.$i, $fortalezas['fortaleza'.$i] ?? '') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                        </div>
                    @endfor
                </div>

                {{-- Debilidades --}}
                <div class="bg-white shadow-md rounded-lg p-6 mt-6"> {{-- Añadido margen superior para separar de Fortalezas --}}
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">DEBILIDADES</h3> {{-- Cambiado a mayúsculas como en la imagen --}}
                    @for ($i = 1; $i <= 2; $i++) {{-- Cambiado para mostrar solo 2 --}}
                        <div class="mb-4 flex items-center">
                            <label for="debilidad{{ $i }}" class="block text-sm font-medium text-gray-700 w-10">D{{ $i }}:</label>
                            <input type="text" name="debilidad{{ $i }}" id="debilidad{{ $i }}" value="{{ old('debilidad'.$i, $debilidades['debilidad'.$i] ?? '') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                        </div>
                    @endfor
                </div>
            </div>
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Guardar FODA
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    td input[type="radio"] {
        margin-left: auto;
        margin-right: auto;
    }
    tbody td:first-child {
        word-wrap: break-word;
        overflow-wrap: break-word;
        max-width: 400px; 
    }
    /* Se eliminan los estilos para ajax-status ya que no se usan */
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reflexionForm');
    
    // Se elimina toda la lógica de cálculo de JavaScript.
    // El guardado de la posición de los botones se maneja a través del envío del formulario estándar
    // y la recarga de la página con los valores desde el backend.

    // Ejemplo de cómo podrías añadir listeners a los radios si fuera necesario para alguna otra funcionalidad futura,
    // pero para el simple guardado y recarga, no es estrictamente necesario aquí.
    if (form) {
        const radios = form.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Podrías hacer algo aquí si necesitas reaccionar a los cambios antes de enviar,
                // pero para el caso actual, el submit del formulario es suficiente.
                // console.log('Radio button changed:', this.name, this.value);
            });
        });
    }
});
</script>
@endpush

