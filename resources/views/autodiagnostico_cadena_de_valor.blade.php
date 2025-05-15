{{-- resources/views/autodiagnostico_cadena_de_valor.blade.php --}}

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Autodiagnóstico de la Cadena de Valor Interna</h1>

    {{-- Mostrar mensajes de sesión --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">¡Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">¡Atención!</strong>
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
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/5">
                            AUTODIAGNÓSTICO DE LA CADENA DE VALOR INTERNA
                        </th>
                        <th scope="col" colspan="5" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            VALORACIÓN
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">0</th>
                        <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">1</th>
                        <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">2</th>
                        <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">3</th>
                        <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">4</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $preguntasTextos = [
                            1 => "La empresa tiene una política sistematizada de cero defectos en la producción de productos/servicios.",
                            2 => "La empresa emplea los medios productivos tecnológicamente más avanzados de su sector.",
                            3 => "La empresa dispone de un sistema de información y control de gestión eficiente y eficaz.",
                            4 => "Los medios técnicos y tecnológicos de la empresa están preparados para competir en un futuro a corto, medio y largo plazo.",
                            5 => "La empresa es un referente en su sector en I+D+i.",
                            6 => "La excelencia de los procedimientos de la empresa (en ISO, etc.) son una principal fuente de ventaja competitiva.",
                            7 => "La empresa dispone de página web, y esta se emplea no sólo como escaparate virtual de productos/servicios, sino también para establecer relaciones con clientes y proveedores.",
                            8 => "Los productos/servicios que desarrolla nuestra empresa llevan incorporada una tecnología difícil de imitar.",
                            9 => "La empresa es referente en su sector en la optimización, en términos de coste, de su cadena de producción, siendo ésta una de sus principales ventajas competitivas.",
                            10 => "La informatización de la empresa es una fuente de ventaja competitiva clara respecto a sus competidores.",
                            11 => "Los canales de distribución de la empresa son una importante fuente de ventajas competitivas.",
                            12 => "Los productos/servicios de la empresa son altamente, y diferencialmente, valorados por el cliente respecto a nuestros competidores.",
                            13 => "La empresa dispone y ejecuta un sistemático plan de marketing y ventas.",
                            14 => "La empresa tiene optimizada su gestión financiera.",
                            15 => "La empresa busca continuamente el mejorar la relación con sus clientes cortando los plazos de ejecución, personalizando la oferta o mejorando las condiciones de entrega. Pero siempre partiendo de un plan previo.",
                            16 => "La empresa es referente en su sector en el lanzamiento de innovadores productos y servicio de éxito demostrado en el mercado.",
                            17 => "Los Recursos Humanos son especialmente responsables del éxito de la empresa, considerándolos incluso como el principal activo estratégico.",
                            18 => "Se tiene una plantilla altamente motivada, que conoce con claridad las metas, objetivos y estrategias de la organización.",
                            19 => "La empresa siempre trabaja conforme a una estrategia y objetivos claros.",
                            20 => "La gestión del circulante está optimizada.",
                            21 => "Se tiene definido claramente el posicionamiento estratégico de todos los productos de la empresa.",
                            22 => "Se dispone de una política de marca basada en la reputación que la empresa genera, en la gestión de relación con el cliente y en el posicionamiento estratégico previamente definido.",
                            23 => "La cartera de clientes de nuestra empresa está altamente fidelizada, ya que tenemos como principal propósito el deleitarlos día a día.",
                            24 => "Nuestra política y equipo de ventas y marketing es una importante ventaja competitiva de nuestra empresa respecto al sector.",
                            25 => "El servicio al cliente que prestamos es uno de nuestras principales ventajas competitivas respecto a nuestros competidores."
                        ];
                        $totalSuma = 0;
                        $preguntasRespondidas = 0;
                    @endphp

                    @foreach ($preguntasTextos as $num => $texto)
                    @php
                        $nombreCampo = 'pregunta' . $num;
                        $valorGuardado = null;
                        if ($autodiagnostico && property_exists($autodiagnostico, $nombreCampo)) {
                            $valorGuardado = $autodiagnostico->{$nombreCampo};
                        }
                        // Usar old() para mantener el valor si falla la validación del formulario principal (aunque aquí es menos relevante para radios AJAX)
                        $valorActual = old($nombreCampo, $valorGuardado);

                        if (!is_null($valorActual) && $valorActual !== '') {
                            $totalSuma += (int)$valorActual;
                            $preguntasRespondidas++;
                        }
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-700">{{ $num }}. {{ $texto }}</td>
                        @for ($i = 0; $i <= 4; $i++)
                        <td class="px-2 py-4 text-center">
                            <input type="radio" name="pregunta{{ $num }}" value="{{ $i }}" 
                                   class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out radio-pregunta"
                                   data-pregunta-field="pregunta{{ $num }}"
                                   id="pregunta{{ $num }}_{{ $i }}" {{-- Añadir ID único para posible label --}}
                                   @if(!is_null($valorActual) && (string)$valorActual === (string)$i) checked @endif>
                        </td>
                        @endfor
                         <td class="px-2 py-4 text-center"><span class="ajax-status text-xs"></span></td> {{-- Celda para el estado AJAX --}}
                    </tr>
                    @endforeach
                    <tr class="bg-gray-50">
                        <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            POTENCIAL DE MEJORA DE LA CADENA DE VALOR INTERNA
                        </td>
                        <td colspan="5" class="px-6 py-3 text-center text-sm font-semibold text-gray-700" id="potencialMejora">
                            {{-- El cálculo se hará con JS y también al cargar la página --}}
                        </td>
                        <td class="px-2 py-4 text-center"></td> {{-- Celda vacía para alinear con status --}}
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Reflexión</h2>
            <p class="text-sm text-gray-600 mb-3">
                Reflexione sobre el resultado obtenido. Anote aquellas observaciones que puedan ser de su interés.
            </p>
            <textarea name="reflexion" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Escriba aquí sus reflexiones...">{{ old('reflexion', $autodiagnostico->reflexion ?? '') }}</textarea>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" form="reflexionForm" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Guardar Reflexión
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <a href="{{ route('dashboard2', $proyecto) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
            &larr; Volver al Dashboard del Proyecto
        </a>
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
    .ajax-status {
        display: inline-block;
        min-width: 60px; /* Espacio para "Guardando..." */
        text-align: left;
    }
    .ajax-success {
        color: green;
    }
    .ajax-error {
        color: red;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Asegurar que la meta tag CSRF existe
    let csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        csrfToken = document.createElement('meta');
        csrfToken.setAttribute('name', 'csrf-token');
        csrfToken.setAttribute('content', '{{ csrf_token() }}');
        document.head.appendChild(csrfToken);
    }
    const csrfTokenValue = csrfToken.getAttribute('content');

    const radios = document.querySelectorAll('.radio-pregunta');
    const updatePreguntaUrl = "{{ route('cadenadevalor.updatePregunta', $proyecto) }}";
    const potencialMejoraCell = document.getElementById('potencialMejora');
    const totalPreguntas = {{ count($preguntasTextos) }};
    let valoresPreguntas = {}; 

    // Inicializar valoresPreguntas y calcular potencial al cargar
    radios.forEach(radio => {
        if (radio.checked) {
            valoresPreguntas[radio.dataset.preguntaField] = parseInt(radio.value);
        }
    });
    recalculatePotencial(); 

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            const preguntaField = this.dataset.preguntaField;
            const value = this.value;
            const statusSpan = this.closest('tr').querySelector('.ajax-status');

            statusSpan.textContent = 'Guardando...';
            statusSpan.className = 'ajax-status'; // Reset classes
            
            // Log de datos a enviar
            console.log('Enviando AJAX:', { pregunta_field: preguntaField, value: value, _token: csrfTokenValue });

            fetch(updatePreguntaUrl, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfTokenValue,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    pregunta_field: preguntaField,
                    value: value
                })
            })
            .then(response => {
                if (!response.ok) {
                    // Capturar errores HTTP (ej. 419, 500) antes de intentar parsear JSON
                    return response.json().then(errData => {
                        throw { status: response.status, data: errData };
                    }).catch(() => {
                         // Si el cuerpo del error no es JSON o está vacío
                        throw { status: response.status, data: { error: response.statusText || 'Error de red' } };
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Respuesta AJAX:', data);
                if (data.success) {
                    statusSpan.textContent = 'Guardado ✓';
                    statusSpan.classList.add('ajax-success');
                    valoresPreguntas[preguntaField] = parseInt(value);
                    recalculatePotencial();
                } else {
                    statusSpan.textContent = 'Error X';
                    statusSpan.classList.add('ajax-error');
                    console.error('Error al guardar (respuesta servidor):', data.error);
                }
                setTimeout(() => {
                    if (statusSpan.classList.contains('ajax-success') || statusSpan.classList.contains('ajax-error')) {
                         statusSpan.textContent = '';
                         statusSpan.classList.remove('ajax-success', 'ajax-error');
                    }
                }, 3000);
            })
            .catch(error => {
                console.error('Error en fetch o respuesta:', error);
                statusSpan.textContent = 'Error X';
                statusSpan.classList.add('ajax-error');
                let errorMessage = 'Error de conexión.';
                if (error.status) {
                    errorMessage = `Error ${error.status}: ${error.data.error || 'Desconocido'}`;
                    if (error.status === 419) {
                        errorMessage = 'Sesión expirada o token CSRF inválido. Por favor, recargue la página.';
                    }
                }
                console.error('Error detallado:', errorMessage);
                // No limpiar el mensaje de error inmediatamente para que el usuario lo vea
                // setTimeout(...)
            });
        });
    });

    function recalculatePotencial() {
        let sumaActual = 0;
        let respondidas = 0;
        
        // Recalcular desde los inputs actuales por si acaso el objeto valoresPreguntas no está sincronizado
        // O confiar en valoresPreguntas si el guardado es la única fuente de verdad
        document.querySelectorAll('.radio-pregunta:checked').forEach(r => {
            sumaActual += parseInt(r.value);
            respondidas++;
        });

        if (respondidas === totalPreguntas) {
            const media = sumaActual / totalPreguntas;
            potencialMejoraCell.textContent = media.toFixed(2);
        } else {
            potencialMejoraCell.textContent = `${respondidas}/${totalPreguntas} resp.`;
        }
    }
});
</script>
@endpush
