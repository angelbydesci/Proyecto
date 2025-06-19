@vite(['resources/css/pest.css', 'resources/js/pest.js'])

<div class="pest-container">
    <div class="pest-card">
        <div class="pest-header">
            <h1 class="pest-title">9. ANÁLISIS EXTERNO MACROENTORNO: PEST</h1>
        </div>

        <div class="pest-body">
            <div class="pest-intro">
                <p><strong>PEST</strong> es un acrónimo y las letras representan el macro entorno de la empresa.</p>

                <div class="pest-factors">
                    <div class="pest-factor">
                        <h2 class="pest-factor-title">Políticos</h2>
                        <p class="pest-factor-description">Aquellos factores que puedan determinar la actividad de la empresa. Por ejemplo, la legislación tributaria, laboral, tratados comerciales, normas de medio ambiente, etc.</p>
                    </div>

                    <div class="pest-factor">
                        <h2 class="pest-factor-title">Económicos</h2>
                        <p class="pest-factor-description">Los factores políticos implican efectos económicos. El comportamiento, la confianza del comprador y su nivel adquisitivo están relacionados con el auge, estancamiento, recesión y recuperación de la economía. Ejemplos de ellos son; tasas impositivas, tasas de interés, niveles de deuda y ahorro, tasa de empleo, índices de precio, etc.</p>
                    </div>

                    <div class="pest-factor">
                        <h2 class="pest-factor-title">Sociales</h2>
                        <p class="pest-factor-description">Se enfoca a las fuerzas que actúan dentro de la sociedad y que afectan a las actitudes, opiniones e intereses de las personas. Varían de un país a otro de forma notable. Ejemplos de estas variables son: estratos demográficos, estilos de vida, distribuciones del ingreso, ocio, factores étnicos y religiosos, etc.</p>
                    </div>

                    <div class="pest-factor">
                        <h2 class="pest-factor-title">Tecnológicos</h2>
                        <p class="pest-factor-description">Este factor es muy importante para casi toda la totalidad de las empresas industriales. La tecnología es una fuerza impulsora de negocios, mejora la calidad y puede reducir los tiempos para el mercadeo. La tecnología puede por tanto eliminar las barreras de entrada pero a veces es difícil la asimilación y adaptación de los cambios tecnológicos por la velocidad de los mismos. Ejemplos de esta variable son: las tasas de obsolescencia tecnológica, los incentivos a la modernización tecnológica, la automatización de los procesos de producción, el impacto de las tecnologías de información, etc.</p>
                    </div>
                </div>
            </div>

            <div class="pest-instructions">
                <p><em>El siguiente gráfico reflejará la valoración obtenida en cada una de las variables del diagnóstico macro-entorno.</em></p>
                <p>A continuación marque con una X para valorar su empresa en función de cada una de las afirmaciones, de tal forma que 0= En total en desacuerdo; 1= No está de acuerdo; 2= Está de acuerdo; 3= Está bastante de acuerdo; 4= En total acuerdo. En caso de no cumplimentar una casilla o duplicar su respuesta le aparecerá el mensaje de error ("¡REF!)</p>
            </div>

            <form method="POST" action="{{ route('pest.store', ['proyecto' => $proyecto->id]) }}" class="pest-form">
                @csrf
                
                <div class="pest-table-container">
                    <table class="pest-table">
                        <thead>
                            <tr>
                                <th rowspan="2" class="pest-table-header">AUTODIAGNÓSTICO ENTORNO GLOBAL P.E.S.T.</th>
                                <th colspan="5" class="pest-table-header">VALORACIÓN</th>
                            </tr>
                            <tr>
                                @foreach(['En total desacuerdo (0)', 'No está de acuerdo (1)', 'Está de acuerdo (2)', 'Está bastante de acuerdo (3)', 'En total acuerdo (4)'] as $option)
                                <th class="pest-table-option">{{ $option }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $preguntasText = [
                                    "1. Los cambios en la composicón étnica de los consumidores de nuestro mercado está teniendo un notable impacto.",
                                    "2. El envejecimiento de la población tiene un importante impacto en la demanda.",
                                    "3. Los nuevos estilos de vida y tendencias originan cambios en la oferta de nuestro sector.",
                                    "4. El envejecimiento de la población tiene un importante impacto en la oferta del sector donde operamos.",
                                    "5. Las variaciones en el nivel de riqueza de la población impactan considerablemente en la demanda de los productos/servicios del sector donde operamos.",
                                    "6. La legislación fiscal afecta muy considerablemente a la economía de las empresas del sector donde operamos.",
                                    "7. La legislación laboral afecta muy considerablemente a la operativa del sector donde actuamos.",
                                    "8. Las subvenciones otorgadas por las Administraciones Públicas son claves en el desarrollo competitivo del mercado donde operamos.",
                                    "9. El impacto que tiene la legislación de protección al consumidor, en la manera de producir bienes y/o servicios es muy importante.",
                                    "10. La normativa autonómica tiene un impacto considerable en el funcionamiento del sector donde actuamos.",
                                    "11. Las expectativas de crecimiento económico generales afectan crucialmente al mercado donde operamos.",
                                    "12. La política de tipos de interés es fundamental en el desarrollo financiero del sector donde trabaja nuestra empresa.",
                                    "13. La globalización permite a nuestra industria gozar de importantes oportunidades en nuevos mercados.",
                                    "14. La situación del empleo es fundamental para el desarrollo económico de nuestra empresa y nuestro sector.",
                                    "15. Las expectativas del ciclo económico de nuestro sector impactan en la situación económica de sus empresas.",
                                    "16. Las Administraciones Públicas están incentivando el esfuerzo tecnológico de las empresas de nuestro sector.",
                                    "17. Internet, el comercio electrónico, el wireless y otras NTIC están impactando en la demanda de nuestros productos/servicios y en los de la competencia.",
                                    "18. El empleo de NTICs es generalizado en el sector donde trabajamos.",
                                    "19. En nuestro sector, es de gran importancia ser pionero o referente en el empleo de aplicaciones tecnológicas.",
                                    "20. En el sector donde operamos, para ser competitivos, es condición \"sine qua non\" innovar constantemente.",
                                    "21. La legislación medioambiental afecta al desarrollo de nuestro sector.",
                                    "22. Los clientes de nuestro mercado exigen que se seamos socialmente responsables, en el plano medioambiental.",
                                    "23. En nuestro sector, la políticas medioambientales son una fuente de ventajas competitivas.",
                                    "24. La creciente preocupación social por el medio ambiente impacta notablemente en la demanda de productos/servicios ofertados en nuestro mercado.",
                                    "25. El factor ecológico es una fuente de diferenciación clara en el sector donde opera nuestra empresa."
                                ];
                            @endphp

                            @foreach ($preguntasText as $index => $pregunta)
                            <tr class="pest-question-row">
                                <td class="pest-question">{{ $pregunta }}</td>
                                @for ($i = 0; $i <= 4; $i++)
                                <td class="pest-option">
                                    @php
                                        $fieldName = 'pregunta'.($index + 1);
                                        $radioValue = $i;
                                        $isChecked = false;
                                        
                                        if (old($fieldName)) {
                                            $isChecked = old($fieldName) == $radioValue;
                                        } elseif (isset($pestData) && isset($pestData->$fieldName)) {
                                            $isChecked = $pestData->$fieldName == $radioValue;
                                        }
                                    @endphp
                                    <input type="radio" 
                                           name="{{ $fieldName }}" 
                                           value="{{ $radioValue }}" 
                                           class="pest-radio"
                                           @if($isChecked) checked @endif   
                                           required>
                                </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pest-reflection-section">
                    <h2 class="pest-subtitle">Reflexión sobre los Factores</h2>
                    
                    @php
                        $reflexiones = [
                            [
                                'id' => 'social_demografico',
                                'label' => 'FACTORES SOCIALES Y DEMOGRÁFICOS (Reflexión)',
                                'texto' => $pestData->reflexion_social_texto ?? '',
                                'puntaje' => $pestData->RFSociales ?? 0
                            ],
                            [
                                'id' => 'medio_ambiental',
                                'label' => 'FACTORES MEDIO AMBIENTALES (Reflexión)',
                                'texto' => $pestData->reflexion_ambiental_texto ?? '',
                                'puntaje' => $pestData->RFAmbientales ?? 0
                            ],
                            [
                                'id' => 'politicos',
                                'label' => 'FACTORES POLÍTICOS (Reflexión)',
                                'texto' => $pestData->reflexion_politico_texto ?? '',
                                'puntaje' => $pestData->RFPoliticos ?? 0
                            ],
                            [
                                'id' => 'economicos',
                                'label' => 'FACTORES ECONÓMICOS (Reflexión)',
                                'texto' => $pestData->reflexion_economico_texto ?? '',
                                'puntaje' => $pestData->RFEconomicos ?? 0
                            ],
                            [
                                'id' => 'tecnologicos',
                                'label' => 'FACTORES TECNOLÓGICOS (Reflexión)',
                                'texto' => $pestData->reflexion_tecnologico_texto ?? '',
                                'puntaje' => $pestData->RFTecnologicos ?? 0
                            ]
                        ];
                    @endphp

                    @foreach ($reflexiones as $reflexion)
                    <div class="pest-reflection-group">
                        <label for="reflexion_{{ $reflexion['id'] }}" class="pest-reflection-label">{{ $reflexion['label'] }}</label>
                        <textarea class="pest-reflection-textarea" 
                                  id="reflexion_{{ $reflexion['id'] }}" 
                                  name="reflexion_RF{{ ucfirst($reflexion['id']) }}_display" 
                                  readonly>{{ $reflexion['texto'] }}</textarea>
                        
                        <div class="pest-score-group">
                            <label for="puntaje_RF{{ ucfirst($reflexion['id']) }}" class="pest-score-label">Puntaje:</label>
                            <input type="number" 
                                   class="pest-score-input" 
                                   id="puntaje_RF{{ ucfirst($reflexion['id']) }}" 
                                   name="RF{{ ucfirst($reflexion['id']) }}_display" 
                                   value="{{ $reflexion['puntaje'] }}" 
                                   readonly>
                        </div>
                    </div>
                    @endforeach

                    <div class="pest-actions">
                        <button type="submit" class="pest-submit-btn">Guardar Análisis PEST</button>
                    </div>
                </div>
            </form>

            <div class="pest-chart-section">
                <h2 class="pest-subtitle">Gráfico de Impacto de Factores Generales Externos</h2>
                <div class="pest-chart-container" id="pestChartContainer">
                    {{-- El gráfico se generará aquí con CSS y se actualizará con JS --}}
                    <div class="css-chart">
                        <div class="chart-grid">
                            <div class="y-axis-label">Impacto (%)</div>
                            <div class="line">100%</div>
                            <div class="line">80%</div>
                            <div class="line">60%</div>
                            <div class="line">40%</div>
                            <div class="line">20%</div>
                            <div class="line">0%</div>
                        </div>
                        <div class="chart-bars">
                            @foreach (['social', 'ambiental', 'politico', 'economico', 'tecnologico'] as $factor)
                                <div class="chart-bar-group">
                                    <div class="chart-bar" data-factor="{{ $factor }}">
                                        <div class="bar-value" id="bar-{{$factor}}" style="height: 0%;"></div>
                                    </div>
                                    <div class="chart-label">{{ ucfirst($factor) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('pest.storeFoda', ['proyecto' => $proyecto->id]) }}" class="pest-form">
                @csrf
                <div class="pest-foda-section">
                    <h2 class="pest-subtitle">Análisis FODA (Externo)</h2>

                    <div class="pest-foda-group">
                        <h3 class="pest-foda-subtitle">Oportunidades</h3>
                        <div class="pest-foda-grid">
                            @for ($i = 3; $i <= 4; $i++)
                                <div class="pest-foda-item">
                                    <label for="oportunidad{{ $i }}" class="pest-foda-label">Oportunidad {{ $i }}</label>
                                    <textarea name="oportunidad{{ $i }}" id="oportunidad{{ $i }}" class="pest-foda-textarea">{{ old('oportunidad'.$i, $oportunidades['oportunidad'.$i] ?? '') }}</textarea>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="pest-foda-group">
                        <h3 class="pest-foda-subtitle">Amenazas</h3>
                        <div class="pest-foda-grid">
                            @for ($i = 3; $i <= 4; $i++)
                                <div class="pest-foda-item">
                                    <label for="amenaza{{ $i }}" class="pest-foda-label">Amenaza {{ $i }}</label>
                                    <textarea name="amenaza{{ $i }}" id="amenaza{{ $i }}" class="pest-foda-textarea">{{ old('amenaza'.$i, $amenazas['amenaza'.$i] ?? '') }}</textarea>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="pest-actions">
                        <button type="submit" class="pest-submit-btn">Guardar Oportunidades y Amenazas</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.pestData = {
        pestData: @json($pestData ?? null),
        oldInput: @json(old() ?? [])
    };
</script>