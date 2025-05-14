{{-- resources/views/autodiagnostico_cadena_de_valor.blade.php --}}

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Autodiagnóstico de la Cadena de Valor Interna</h1>

    <p class="mb-4 text-sm text-gray-600">
        A continuación marque con una X para valorar su empresa en función de cada una de las afirmaciones, de tal forma que 0= En total en desacuerdo; 1= No está de acuerdo; 2=Está de acuerdo; 3= Está bastante de acuerdo; 4=En total acuerdo. En caso de no cumplimentar una casilla o duplicar su respuesta le aparecerá el mensaje de error ("¡REF!)
    </p>

    <form method="POST" action="#"> {{-- La acción se definirá después para el backend --}}
        @csrf
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
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
                        $preguntas = [
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
                    @endphp

                    @foreach ($preguntas as $num => $texto)
                    <tr>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-700">{{ $num }}. {{ $texto }}</td>
                        @for ($i = 0; $i <= 4; $i++)
                        <td class="px-2 py-4 text-center">
                            <input type="radio" name="pregunta{{ $num }}" value="{{ $i }}" class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </td>
                        @endfor
                    </tr>
                    @endforeach
                    <tr class="bg-gray-50">
                        <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            POTENCIAL DE MEJORA DE LA CADENA DE VALOR INTERNA
                        </td>
                        <td colspan="5" class="px-6 py-3 text-center text-sm font-semibold text-gray-700">
                            #¡REF! {{-- Esto se calculará después --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Reflexión</h2>
            <p class="text-sm text-gray-600 mb-3">
                Reflexione sobre el resultado obtenido. Anote aquellas observaciones que puedan ser de su interés. Identifique sus fortalezas y debilidades respecto a su cadena de valor.
            </p>
            <textarea name="reflexion" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Escriba aquí sus reflexiones..."></textarea>
        </div>

        <div class="mt-6 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">FORTALEZAS</h3>
            <div class="mb-4">
                <label for="f1" class="block text-sm font-medium text-gray-700">F1:</label>
                <input type="text" name="f1" id="f1" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
            </div>
            <div>
                <label for="f2" class="block text-sm font-medium text-gray-700">F2:</label>
                <input type="text" name="f2" id="f2" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
            </div>
        </div>

        <div class="mt-6 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">DEBILIDADES</h3>
            <div class="mb-4">
                <label for="d1" class="block text-sm font-medium text-gray-700">D1:</label>
                <input type="text" name="d1" id="d1" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
            </div>
            <div>
                <label for="d2" class="block text-sm font-medium text-gray-700">D2:</label>
                <input type="text" name="d2" id="d2" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Guardar Autodiagnóstico
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
    /* Ajustes para que los radio buttons no causen demasiado espacio si las preguntas son largas */
    td input[type="radio"] {
        margin-left: auto;
        margin-right: auto;
    }
    /* Evitar que el texto de las preguntas se expanda demasiado y rompa el layout */
    tbody td:first-child {
        word-wrap: break-word;
        overflow-wrap: break-word;
        max-width: 400px; /* Ajusta según necesidad */
    }
</style>
@endpush
