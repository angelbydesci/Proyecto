@vite(['resources/css/autodiagnostico_porter.css', 'resources/js/autodiagnostico_porter.js'])

<div class="porter-container">
    <h1 class="porter-title">8.1 AUTODIAGNÓSTICO PORTER</h1>

    <form method="POST" action="{{ route('autodiagnostico_porter.store', $proyecto) }}" id="porterForm" class="porter-form">
        @csrf

        <div class="porter-table-container">
            <table class="porter-table">
                <thead>
                    <tr class="porter-table-header">
                        <th class="porter-th">PERFIL COMPETITIVO</th>
                        <th class="porter-th">Nada (1)</th>
                        <th class="porter-th">Poco (2)</th>
                        <th class="porter-th">Medio (3)</th>
                        <th class="porter-th">Alto (4)</th>
                        <th class="porter-th">Muy Alto (5)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $opcionesRadio = [1 => 'Nada', 2 => 'Poco', 3 => 'Medio', 4 => 'Alto', 5 => 'Muy Alto'];
                        $secciones = [
                            [
                                'titulo' => 'Rivalidad empresas del sector',
                                'preguntas' => [
                                    ['label' => '- Crecimiento', 'hostil' => 'Lento', 'favorable' => 'Rápido', 'name' => 'pregunta1'],
                                    ['label' => '- Naturaleza de los competidores', 'hostil' => 'Muchos', 'favorable' => 'Pocos', 'name' => 'pregunta2'],
                                    ['label' => '- Exceso de capacidad productiva', 'hostil' => 'Sí', 'favorable' => 'No', 'name' => 'pregunta3'],
                                    ['label' => '- Rentabilidad media del sector', 'hostil' => 'Baja', 'favorable' => 'Alta', 'name' => 'pregunta4'],
                                    ['label' => '- Diferenciación del producto', 'hostil' => 'Escasa', 'favorable' => 'Elevada', 'name' => 'pregunta5'],
                                    ['label' => '- Barreras de salida', 'hostil' => 'Bajas', 'favorable' => 'Altas', 'name' => 'pregunta6']
                                ]
                            ],
                            [
                                'titulo' => 'Barreras de Entrada',
                                'preguntas' => [
                                    ['label' => '- Economías de escala', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'pregunta7'],
                                    ['label' => '- Necesidad de capital', 'hostil' => 'Bajas', 'favorable' => 'Altas', 'name' => 'pregunta8'],
                                    ['label' => '- Acceso a la tecnología', 'hostil' => 'Fácil', 'favorable' => 'Difícil', 'name' => 'pregunta9'],
                                    ['label' => '- Reglamentos o leyes limitativos', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'pregunta10'],
                                    ['label' => '- Trámites burocráticos', 'hostil' => 'No', 'favorable' => 'Sí', 'name' => 'pregunta11'],
                                    ['label' => '- Reacción esperada actuales competidores', 'hostil' => 'Escasa', 'favorable' => 'Enérgica', 'name' => 'pregunta12']
                                ]
                            ],
                            [
                                'titulo' => 'Poder de los Clientes',
                                'preguntas' => [
                                    ['label' => '- Número de clientes', 'hostil' => 'Pocos', 'favorable' => 'Muchos', 'name' => 'pregunta13'],
                                    ['label' => '- Posibilidad de integración ascendente', 'hostil' => 'Pequeña', 'favorable' => 'Grande', 'name' => 'pregunta14'],
                                    ['label' => '- Rentabilidad de los clientes', 'hostil' => 'Baja', 'favorable' => 'Alta', 'name' => 'pregunta15'],
                                    ['label' => '- Coste de cambio de proveedor para cliente', 'hostil' => 'Bajo', 'favorable' => 'Alto', 'name' => 'pregunta16']
                                ]
                            ],
                            [
                                'titulo' => 'Productos sustitutivos',
                                'preguntas' => [
                                    ['label' => '- Disponibilidad de Productos Sustitutivos', 'hostil' => 'Grande', 'favorable' => 'Pequeña', 'name' => 'pregunta17']
                                ]
                            ]
                        ];
                    @endphp

                    @foreach ($secciones as $seccion)
                        <tr>
                            <td class="porter-section-title" colspan="6">{{ $seccion['titulo'] }}</td>
                        </tr>
                        
                        @foreach ($seccion['preguntas'] as $item)
                            <tr class="porter-question-row">
                                <td class="porter-question">
                                    {{ $item['label'] }}<br>
                                    <span class="porter-hostil">Hostil: {{ $item['hostil'] }}</span> / 
                                    <span class="porter-favorable">Favorable: {{ $item['favorable'] }}</span>
                                </td>
                                @foreach ($opcionesRadio as $value => $text)
                                    <td class="porter-option">
                                        <input type="radio" 
                                               name="{{ $item['name'] }}" 
                                               value="{{ $value }}" 
                                               class="porter-radio"
                                               {{ (old($item['name'], isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->{$item['name']} : '') == $value) ? 'checked' : '' }}>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="porter-conclusion-section">
            <h2 class="porter-subtitle">CONCLUSIÓN</h2>
            <textarea name="conclusion" id="conclusion" class="porter-conclusion" readonly>{{ old('conclusion', isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->conclusion : '') }}</textarea>
            
            <div class="porter-score">
                <label for="puntaje" class="porter-score-label">Total (Puntaje):</label>
                <input type="text" name="puntaje" id="puntaje" class="porter-score-input" 
                       value="{{ old('puntaje', isset($autodiagnosticoPorter) ? $autodiagnosticoPorter->puntaje : '0') }}" readonly>
            </div>
        </div>

        <div class="porter-foda-section">
            <h2 class="porter-subtitle">Análisis FODA</h2>

            <div class="porter-foda-group">
                <h3 class="porter-foda-subtitle">Oportunidades</h3>
                <div class="porter-foda-grid">
                    @for ($i = 1; $i <= 2; $i++)
                        <div class="porter-foda-item">
                            <label for="oportunidad{{ $i }}" class="porter-foda-label">Oportunidad {{ $i }}</label>
                            <textarea name="oportunidad{{ $i }}" id="oportunidad{{ $i }}" class="porter-foda-textarea">
                                {{ old('oportunidad'.$i, $oportunidades?->{'oportunidad'.$i} ?? '') }}
                            </textarea>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="porter-foda-group">
                <h3 class="porter-foda-subtitle">Amenazas</h3>
                <div class="porter-foda-grid">
                    @for ($i = 1; $i <= 2; $i++)
                        <div class="porter-foda-item">
                            <label for="amenaza{{ $i }}" class="porter-foda-label">Amenaza {{ $i }}</label>
                            <textarea name="amenaza{{ $i }}" id="amenaza{{ $i }}" class="porter-foda-textarea">
                                {{ old('amenaza'.$i, $amenazas?->{'amenaza'.$i} ?? '') }}
                            </textarea>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="porter-actions">
            <button type="submit" class="porter-submit-btn">
                Guardar Autodiagnóstico Porter y FODA
            </button>
        </div>
    </form>
</div>

<script>
    window.porterData = {
        autodiagnosticoPorter: @json($autodiagnosticoPorter ?? null),
        oldInput: @json(old() ?? []),
        oportunidades: @json($oportunidades ?? null),
        amenazas: @json($amenazas ?? null)
    };
</script>