<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">8.1 AUTODIAGNÓSTICO PORTER</h1>

    <form method="POST" action="{{ route('autodiagnostico_porter.store', $proyecto) }}" id="porterForm">
        @csrf
        {{-- Asumiendo que $proyecto está disponible en la vista y se pasa al controlador --}}
        {{-- <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}"> --}}

        <div class="shadow-lg rounded-lg overflow-hidden mb-8">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider w-2/5">PERFIL COMPETITIVO</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Nada (1)</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Poco (2)</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Medio (3)</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Alto (4)</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Muy Alto (5)</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <!-- Sección 1: Rivalidad empresas del sector -->
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-sm font-semibold" colspan="6">Rivalidad empresas del sector</td>
                    </tr>
                    @php
                        $opcionesRadio = [1 => 'Nada', 2 => 'Poco', 3 => 'Medio', 4 => 'Alto', 5 => 'Muy Alto'];
                        $rivalidadItems = [
                            ['label' => '- Crecimiento', 'hostil' => 'Lento', 'favorable' => 'Rápido', 'name' => 'pregunta1'],
                            ['label' => '- Naturaleza de los competidores', 'hostil' => 'Muchos', 'favorable' => 'Pocos', 'name' => 'pregunta2'],
                            ['label' => '- Exceso de capacidad productiva', 'hostil' => 'Sí', 'favorable' => 'No', 'name' => 'pregunta3'],
                            ['label' => '- Rentabilidad media del sector', 'hostil' => 'Baja', 'favorable' => 'Alta', 'name' => 'pregunta4'],
                            ['label' => '- Diferenciación del producto', 'hostil' => 'Escasa', 'favorable' => 'Elevada', 'name' => 'pregunta5'],
                            ['label' => '- Barreras de salida', 'hostil' => 'Bajas', 'favorable' => 'Altas', 'name' => 'pregunta6']
                        ];
                        // Suponiendo que $autodiagnosticoPorter contiene los datos guardados.
                        // $autodiagnosticoData = $autodiagnosticoPorter ?? null; 
                        // Para el ejemplo, usaremos old() o un valor por defecto (ej. null o 0)
                    @endphp
                    @foreach ($rivalidadItems as $item)
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 text-sm">
                            {{ $item['label'] }}<br>
                            <span class="text-xs text-red-500">Hostil: {{ $item['hostil'] }}</span> / <span class="text-xs text-green-500">Favorable: {{ $item['favorable'] }}</span>
                        </td>
                        @foreach ($opcionesRadio as $value => $text)
                        <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                            <input type="radio" name="{{ $item['name'] }}" value="{{ $value }}" 
                                   class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                   {{ (old($item['name'], isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->{$item['name']} : '') == $value) ? 'checked' : '' }}
                                   >
                        </td>
                        @endforeach
                    </tr>
                    @endforeach

                    <!-- Sección 2: Barreras de Entrada -->
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-sm font-semibold" colspan="6">Barreras de Entrada</td>
                    </tr>
                    @php
                        $barrerasItems = [
                            ['label' => '- Economías de escala', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'pregunta7'],
                            ['label' => '- Necesidad de capital', 'hostil' => 'Bajas', 'favorable' => 'Altas', 'name' => 'pregunta8'],
                            ['label' => '- Acceso a la tecnología', 'hostil' => 'Fácil', 'favorable' => 'Difícil', 'name' => 'pregunta9'],
                            ['label' => '- Reglamentos o leyes limitativos', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'pregunta10'],
                            ['label' => '- Trámites burocráticos', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'pregunta11'],
                            ['label' => '- Reacción esperada actuales competidores', 'hostil' => 'Escasa', 'favorable' => 'Enérgica', 'name' => 'pregunta12']
                        ];
                    @endphp
                    @foreach ($barrerasItems as $item)
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 text-sm">
                            {{ $item['label'] }}<br>
                            <span class="text-xs text-red-500">Hostil: {{ $item['hostil'] }}</span> / <span class="text-xs text-green-500">Favorable: {{ $item['favorable'] }}</span>
                        </td>
                        @foreach ($opcionesRadio as $value => $text)
                        <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                            <input type="radio" name="{{ $item['name'] }}" value="{{ $value }}" 
                                   class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                   {{ (old($item['name'], isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->{$item['name']} : '') == $value) ? 'checked' : '' }}
                                   >
                        </td>
                        @endforeach
                    </tr>
                    @endforeach

                    <!-- Sección 3: Poder de los Clientes -->
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-sm font-semibold" colspan="6">Poder de los Clientes</td>
                    </tr>
                    @php
                        $clientesItems = [
                            ['label' => '- Número de clientes', 'hostil' => 'Pocos', 'favorable' => 'Muchos', 'name' => 'pregunta13'],
                            ['label' => '- Posibilidad de integración ascendente', 'hostil' => 'Pequeña', 'favorable' => 'Grande', 'name' => 'pregunta14'], // Nota: Hostil/Favorable invertido respecto a la imagen para que "Grande" sea Favorable (menor poder del cliente)
                            ['label' => '- Rentabilidad de los clientes', 'hostil' => 'Baja', 'favorable' => 'Alta', 'name' => 'pregunta15'],
                            ['label' => '- Coste de cambio de proveedor para cliente', 'hostil' => 'Bajo', 'favorable' => 'Alto', 'name' => 'pregunta16']
                        ];
                    @endphp
                    @foreach ($clientesItems as $item)
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 text-sm">
                            {{ $item['label'] }}<br>
                            <span class="text-xs text-red-500">Hostil: {{ $item['hostil'] }}</span> / <span class="text-xs text-green-500">Favorable: {{ $item['favorable'] }}</span>
                        </td>
                        @foreach ($opcionesRadio as $value => $text)
                        <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                            <input type="radio" name="{{ $item['name'] }}" value="{{ $value }}" 
                                   class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                   {{ (old($item['name'], isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->{$item['name']} : '') == $value) ? 'checked' : '' }}
                                   >
                        </td>
                        @endforeach
                    </tr>
                    @endforeach

                    <!-- Sección 4: Productos sustitutivos -->
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-sm font-semibold" colspan="6">Productos sustitutivos</td>
                    </tr>
                    @php
                        $sustitutosItems = [
                            ['label' => '- Disponibilidad de Productos Sustitutivos', 'hostil' => 'Grande', 'favorable' => 'Pequeña', 'name' => 'pregunta17']
                        ];
                    @endphp
                    @foreach ($sustitutosItems as $item)
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 text-sm">
                            {{ $item['label'] }}<br>
                            <span class="text-xs text-red-500">Hostil: {{ $item['hostil'] }}</span> / <span class="text-xs text-green-500">Favorable: {{ $item['favorable'] }}</span>
                        </td>
                        @foreach ($opcionesRadio as $value => $text)
                        <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                            <input type="radio" name="{{ $item['name'] }}" value="{{ $value }}" 
                                   class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                   {{ (old($item['name'], isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->{$item['name']} : '') == $value) ? 'checked' : '' }}
                                   >
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Sección 2: Barreras de Entrada -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">CONCLUSIÓN</h2>
            <textarea name="conclusion" id="conclusion" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="La conclusión se generará automáticamente aquí..." readonly>{{ old('conclusion', isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->conclusion : '') }}</textarea>
            
            <div class="mt-4">
                <label for="puntaje" class="block text-sm font-medium text-gray-700">Total (Puntaje):</label>
                <input type="text" name="puntaje" id="puntaje" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('puntaje', isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->puntaje : '0') }}" readonly>
                {{-- Este campo de puntaje podría ser calculado con JS o en el backend --}}
            </div>
        </div>

        <!-- Sección FODA -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Análisis FODA</h2>

            <!-- Oportunidades -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-600 mb-2">Oportunidades</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="oportunidad1" class="block text-sm font-medium text-gray-700">Oportunidad 1</label>
                        <textarea name="oportunidad1" id="oportunidad1" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2">{{ old('oportunidad1', optional($oportunidades)->oportunidad1 ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="oportunidad2" class="block text-sm font-medium text-gray-700">Oportunidad 2</label>
                        <textarea name="oportunidad2" id="oportunidad2" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2">{{ old('oportunidad2', optional($oportunidades)->oportunidad2 ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Amenazas -->
            <div>
                <h3 class="text-lg font-medium text-gray-600 mb-2">Amenazas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="amenaza1" class="block text-sm font-medium text-gray-700">Amenaza 1</label>
                        <textarea name="amenaza1" id="amenaza1" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2">{{ old('amenaza1', optional($amenazas)->amenaza1 ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="amenaza2" class="block text-sm font-medium text-gray-700">Amenaza 2</label>
                        <textarea name="amenaza2" id="amenaza2" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2">{{ old('amenaza2', optional($amenazas)->amenaza2 ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Sección FODA --}}

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Guardar Autodiagnóstico Porter y FODA
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    /* Estilo para asegurar que la primera columna tenga suficiente ancho */
    table th:first-child, table td:first-child {
        width: 40%; /* Ajusta este valor según sea necesario */
    }
    .form-radio { /* Estilos básicos para los radio, Tailwind puede manejarlos mejor con plugins */
        appearance: none;
        border-radius: 50%;
        border: 1px solid #ccc;
        margin: auto; /* Centrar el radio en la celda */
    }
    .form-radio:checked {
        background-color: #4f46e5; /* Color indigo para el checkeado */
        border-color: #4f46e5;
    }
     .form-radio:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.5); /* Sombra de foco */
    }

    body {
        font-family: sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    .description {
        font-size: 0.9em;
    }

    .hostil {
        color: red;
        font-weight: bold;
    }

    .favorable {
        color: green;
        font-weight: bold;
    }

    .conclusion-section textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 20px;
        resize: vertical;
    }

    .total-score {
        margin-bottom: 20px;
        font-weight: bold;
    }

    .total-score input {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-left: 10px;
    }

    .submit-btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    .alert-danger ul {
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aquí podrías agregar lógica de JavaScript si necesitas calcular el puntaje automáticamente
    // o realizar otras interacciones dinámicas.
    // Por ejemplo, para calcular el puntaje sumando los valores de los radios seleccionados:
    const form = document.querySelector('form'); // Asegúrate de que este selector sea el correcto para tu formulario
    if (form) {
        const puntajeInput = form.querySelector('#puntaje');
        const radios = form.querySelectorAll('input[type="radio"]');

        function calcularPuntaje() {
            let totalPuntaje = 0;
            const gruposPreguntas = {};

            radios.forEach(radio => {
                if (radio.checked) {
                    // Agrupa por nombre para sumar solo una vez por grupo de pregunta
                    if (!gruposPreguntas[radio.name]) {
                        gruposPreguntas[radio.name] = parseInt(radio.value, 10);
                    }
                }
            });
            for (const nombrePregunta in gruposPreguntas) {
                totalPuntaje += gruposPreguntas[nombrePregunta];
            }
            
            if (puntajeInput) {
                puntajeInput.value = totalPuntaje;
            }
        }

        radios.forEach(radio => {
            radio.addEventListener('change', calcularPuntaje);
        });

        // Calcular puntaje inicial al cargar la página si hay valores preseleccionados
        // Esto es importante si estás cargando datos existentes.
        // calcularPuntaje(); // Descomenta si cargas datos y quieres el cálculo inicial.
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('porterForm');
    const puntajeInput = document.getElementById('puntaje');
    const conclusionTextarea = document.getElementById('conclusion');
    const radioGroups = [];

    for (let i = 1; i <= 17; i++) {
        radioGroups.push(form.querySelectorAll(`input[name="pregunta${i}"]`));
    }

    function calculatePuntaje() {
        let totalPuntaje = 0;
        radioGroups.forEach(group => {
            const checkedRadio = Array.from(group).find(radio => radio.checked);
            if (checkedRadio) {
                totalPuntaje += parseInt(checkedRadio.value);
            }
        });
        puntajeInput.value = totalPuntaje;
        updateConclusion(totalPuntaje);
    }

    function updateConclusion(puntaje) {
        let conclusion = '';
        if (puntaje >= 17 && puntaje <= 29) {
            conclusion = "Estamos en un mercado altamente competitivo, en el que es muy difícil hacerse un hueco en el mercado.";
        } else if (puntaje >= 30 && puntaje <= 44) {
            conclusion = "Estamos en un mercado de competitividad relativamente alta, pero con ciertas modificaciones en el producto y la política comercial de la empresa, podría encontrarse un nicho de mercado.";
        } else if (puntaje >= 45 && puntaje <= 59) {
            conclusion = "La situación actual del mercado es favorable a la empresa.";
        } else if (puntaje >= 60 && puntaje <= 85) {
            conclusion = "Estamos en una situación excelente para la empresa.";
        }
        conclusionTextarea.value = conclusion;
    }

    radioGroups.forEach(group => {
        group.forEach(radio => {
            radio.addEventListener('change', calculatePuntaje);
        });
    });

    // Initial calculation on page load if data is pre-filled
    calculatePuntaje();

    // Pre-fill form if data exists (e.g., from server-side validation error or existing record)
    @if(isset($autodiagnosticoPorter) && $autodiagnosticoPorter)
        @foreach($autodiagnosticoPorter->getAttributes() as $key => $value)
            @if(strpos($key, 'pregunta') === 0 && $value !== null)
                const preguntaRadios = form.querySelectorAll(`input[name="{{ $key }}"]`);
                preguntaRadios.forEach(radio => {
                    if (radio.value == '{{ $value }}') {
                        radio.checked = true;
                    }
                });
            @endif
        @endforeach
        calculatePuntaje(); // Recalculate puntaje and conclusion based on loaded data
    @elseif(old())
        @for($i = 1; $i <= 17; $i++)
            @if(old('pregunta'.$i))
                const preguntaRadios{{$i}} = form.querySelectorAll(`input[name="pregunta{{$i}}"]`);
                preguntaRadios{{$i}}.forEach(radio => {
                    if (radio.value == '{{ old("pregunta".$i) }}') {
                        radio.checked = true;
                    }
                });
            @endif
        @endfor
        calculatePuntaje(); // Recalculate puntaje and conclusion based on old input
    @endif
});
</script>
@endpush


