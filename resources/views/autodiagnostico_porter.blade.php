


    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8 text-center">8.1 AUTODIAGNÓSTICO PORTER</h1>

        <form method="POST" action="#"> <!-- Actualizar action a la ruta correcta -->
            @csrf
            <div class="shadow-lg rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">PERFIL COMPETITIVO</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Hostil</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Nada</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Poco</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Medio</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Alto</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Muy Alto</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Favorable</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <!-- Rivalidad empresas del sector -->
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-gray-100 text-sm font-semibold col-span-8" colspan="8">Rivalidad empresas del sector</td>
                        </tr>
                        @php
                            $rivalidadItems = [
                                ['label' => '- Crecimiento', 'hostil' => 'Lento', 'favorable' => 'Rápido', 'name' => 'crecimiento'],
                                ['label' => '- Naturaleza de los competidores', 'hostil' => 'Muchos', 'favorable' => 'Pocos', 'name' => 'naturaleza_competidores'],
                                ['label' => '- Exceso de capacidad productiva', 'hostil' => 'Sí', 'favorable' => 'No', 'name' => 'exceso_capacidad'],
                                ['label' => '- Rentabilidad media del sector', 'hostil' => 'Baja', 'favorable' => 'Alta', 'name' => 'rentabilidad_media'],
                                ['label' => '- Diferenciación del producto', 'hostil' => 'Escasa', 'favorable' => 'Elevada', 'name' => 'diferenciacion_producto'],
                                ['label' => '- Barreras de salida', 'hostil' => 'Bajas', 'favorable' => 'Altas', 'name' => 'barreras_salida']
                            ];
                            $valoresRadio = [-3, -2, -1, 0, 1, 2, 3];
                        @endphp
                        @foreach ($rivalidadItems as $item)
                        <tr>
                            <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                <span class="font-medium">{{ $item['hostil'] }}</span> <span class="text-gray-600">{{ $item['label'] }}</span> <span class="font-medium float-right">{{ $item['favorable'] }}</span>
                            </td>
                            @foreach ($valoresRadio as $valor)
                            <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                                <input type="radio" name="rivalidad_{{ $item['name'] }}" value="{{ $valor }}" class="form-radio h-5 w-5 text-blue-600">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach

                        <!-- Barreras de Entrada -->
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-gray-100 text-sm font-semibold col-span-8" colspan="8">Barreras de Entrada</td>
                        </tr>
                        @php
                            $barrerasItems = [
                                ['label' => '- Economías de escala', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'economias_escala'],
                                ['label' => '- Necesidad de capital', 'hostil' => 'Bajas', 'favorable' => 'Altas', 'name' => 'necesidad_capital'],
                                ['label' => '- Acceso a la tecnología', 'hostil' => 'Fácil', 'favorable' => 'Difícil', 'name' => 'acceso_tecnologia'],
                                ['label' => '- Reglamentos o leyes limitativos', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'reglamentos_leyes'],
                                ['label' => '- Trámites burocráticos', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'tramites_burocraticos'],
                                ['label' => '- Reacción esperada actuales competidores', 'hostil' => 'Escasa', 'favorable' => 'Enérgica', 'name' => 'reaccion_competidores']
                            ];
                        @endphp
                        @foreach ($barrerasItems as $item)
                        <tr>
                            <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                <span class="font-medium">{{ $item['hostil'] }}</span> <span class="text-gray-600">{{ $item['label'] }}</span> <span class="font-medium float-right">{{ $item['favorable'] }}</span>
                            </td>
                            @foreach ($valoresRadio as $valor)
                            <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                                <input type="radio" name="barreras_{{ $item['name'] }}" value="{{ $valor }}" class="form-radio h-5 w-5 text-blue-600">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach

                        <!-- Poder de los Clientes -->
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-gray-100 text-sm font-semibold col-span-8" colspan="8">Poder de los Clientes</td>
                        </tr>
                        @php
                            $clientesItems = [
                                ['label' => '- Número de clientes', 'hostil' => 'Pocos', 'favorable' => 'Muchos', 'name' => 'numero_clientes'],
                                ['label' => '- Posibilidad de integración ascendente', 'hostil' => 'Pequeña', 'favorable' => 'Grande', 'name' => 'integracion_ascendente'],
                                ['label' => '- Rentabilidad de los clientes', 'hostil' => 'Baja', 'favorable' => 'Alta', 'name' => 'rentabilidad_clientes'],
                                ['label' => '- Coste de cambio de proveedor para cliente', 'hostil' => 'Bajo', 'favorable' => 'Alto', 'name' => 'coste_cambio_proveedor']
                            ];
                        @endphp
                        @foreach ($clientesItems as $item)
                        <tr>
                            <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                <span class="font-medium">{{ $item['hostil'] }}</span> <span class="text-gray-600">{{ $item['label'] }}</span> <span class="font-medium float-right">{{ $item['favorable'] }}</span>
                            </td>
                            @foreach ($valoresRadio as $valor)
                            <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                                <input type="radio" name="clientes_{{ $item['name'] }}" value="{{ $valor }}" class="form-radio h-5 w-5 text-blue-600">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach

                        <!-- Productos sustitutivos -->
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-gray-100 text-sm font-semibold col-span-8" colspan="8">Productos sustitutivos</td>
                        </tr>
                        @php
                            $sustitutivosItems = [
                                ['label' => '- Disponibilidad de Productos Sustitutivos', 'hostil' => 'Grande', 'favorable' => 'Pequeña', 'name' => 'disponibilidad_sustitutivos']
                            ];
                        @endphp
                        @foreach ($sustitutivosItems as $item)
                        <tr>
                            <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                <span class="font-medium">{{ $item['hostil'] }}</span> <span class="text-gray-600">{{ $item['label'] }}</span> <span class="font-medium float-right">{{ $item['favorable'] }}</span>
                            </td>
                            @foreach ($valoresRadio as $valor)
                            <td class="px-5 py-3 border-b border-gray-200 text-sm text-center">
                                <input type="radio" name="sustitutivos_{{ $item['name'] }}" value="{{ $valor }}" class="form-radio h-5 w-5 text-blue-600">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 p-6 bg-gray-50 rounded-lg shadow">
                <h2 class="text-2xl font-semibold mb-4">CONCLUSIÓN</h2>
                <textarea name="conclusion" class="w-full h-24 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Escriba aquí su conclusión...">Estamos en un mercado altamente competitivo, en el que es muy difícil hacerse un hueco en el mercado.</textarea>
            </div>

            <div class="mt-8 p-6 bg-gray-50 rounded-lg shadow flex justify-between items-center">
                <h2 class="text-2xl font-semibold">TOTAL</h2>
                <div class="text-3xl font-bold text-blue-600" id="totalScore">
                    0
                </div>
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">
                    Guardar Autodiagnóstico
                </button>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[type="radio"]');
        const totalScoreEl = document.getElementById('totalScore');

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('input[type="radio"]:checked').forEach(function(radio) {
                total += parseInt(radio.value);
            });
            totalScoreEl.textContent = total;
        }

        radios.forEach(function(radio) {
            radio.addEventListener('change', calculateTotal);
        });

        // Calculate initial total if any radios are pre-checked (e.g. when loading saved data)
        calculateTotal();
    });
    </script>


