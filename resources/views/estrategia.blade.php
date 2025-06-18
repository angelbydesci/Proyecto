{{-- resources/views/estrategia.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/estrategia.js'])

<div class="container">
    <h2>10. IDENTIFICACIÓN DE ESTRATEGIAS</h2>

    <p>Tras el análisis realizado habiéndose identificado las oportunidades, amenazas, fortalezas y debilidades, es momento de identificar la estrategia que debe seguir en su empresa para el logro de sus objetivos empresariales.</p>
    <p>Se trata de realizar una Matriz Cruzada tal y como se refleja en el siguente dibujo para identificar la estrategía más conveniente a llevar a cabo.</p>

    <div class="text-center" style="margin-top: 20px;">
        <p><em>Visualización de la Matriz Cruzada</em></p>
        {{-- Aquí puedes insertar la imagen --}}
        {{-- <img src="..." alt="Matriz Cruzada"> --}}
    </div>

    <div class="foda-grid">
        <div class="foda-cell">DEBILIDADES</div>
        <div class="foda-cell">
            @if($debilidades)
                <p>{{ $debilidades->debilidad1 }}</p>
                <p>{{ $debilidades->debilidad2 }}</p>
                <p>{{ $debilidades->debilidad3 }}</p>
                <p>{{ $debilidades->debilidad4 }}</p>
            @endif
        </div>
        <div class="foda-cell">AMENAZAS</div>
        <div class="foda-cell">
            @if($amenazas)
                <p>{{ $amenazas->amenaza1 }}</p>
                <p>{{ $amenazas->amenaza2 }}</p>
                <p>{{ $amenazas->amenaza3 }}</p>
                <p>{{ $amenazas->amenaza4 }}</p>
            @endif
        </div>
        <div class="foda-cell">FORTALEZAS</div>
        <div class="foda-cell">
            @if($fortalezas)
                <p>{{ $fortalezas->fortaleza1 }}</p>
                <p>{{ $fortalezas->fortaleza2 }}</p>
                <p>{{ $fortalezas->fortaleza3 }}</p>
                <p>{{ $fortalezas->fortaleza4 }}</p>
            @endif
        </div>
        <div class="foda-cell">OPORTUNIDADES</div>
        <div class="foda-cell">
            @if($oportunidades)
                <p>{{ $oportunidades->oportunidad1 }}</p>
                <p>{{ $oportunidades->oportunidad2 }}</p>
                <p>{{ $oportunidades->oportunidad3 }}</p>
                <p>{{ $oportunidades->oportunidad4 }}</p>
            @endif
        </div>
    </div>

    <div class="sintesis-resultados">
        <h3>SÍNTESIS DE RESULTADOS</h3>
        <table>
            <thead>
                <tr>
                    <th>Relaciones</th>
                    <th>Tipología de estrategia</th>
                    <th>Puntuación</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>FO</td>
                    <td>Estrategia Ofensiva</td>
                    <td></td>
                    <td>Deberá adoptar estrategias de crecimiento</td>
                </tr>
                <tr>
                    <td>AF</td>
                    <td>Estrategia Defensiva</td>
                    <td></td>
                    <td>La empresa está preparada para enfrentarse a las amenazas</td>
                </tr>
                <tr>
                    <td>AD</td>
                    <td>Estrategia de Supervivencia</td>
                    <td></td>
                    <td>Se enfrenta a amenazas externas sin las fortalezas necesarias para luchar con la competencia</td>
                </tr>
                <tr>
                    <td>OD</td>
                    <td>Estrategia de Reorientación</td>
                    <td></td>
                    <td>La empresa no puede aprovechar las oportunidades porque carece de preparación adecuada</td>
                </tr>
            </tbody>
        </table>
    </div>

    <input type="hidden" id="proyecto_id" value="{{ $proyecto->id_proyecto }}">

    <div class="estrategia-container" id="matriz-ofensiva">
        <h3>Estrategia Ofensiva</h3>
        <p>Las fortalezas se usan para tomar ventaja en cada una las oportunidades.</p>
        <p>0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo y 4=En total acuerdo</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="4">OPORTUNIDADES</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>O1</th>
                    <th>O2</th>
                    <th>O3</th>
                    <th>O4</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 4; $i++)
                <tr>
                    @if ($i == 1)
                    <th rowspan="4">FORTALEZAS</th>
                    @endif
                    <th>F{{$i}}</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td><input type="number" min="0" max="4" data-matriz="ofensiva" data-celda="c{{$i}}{{$j}}" value="{{ $matrizOfensiva->{'c'.$i.$j} }}"></td>
                    @endfor
                </tr>
                @endfor
                <tr>
                    <th colspan="2">Total</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td class="total-vertical">0</td>
                    @endfor
                    <td id="total-ofensiva">{{$matrizOfensiva->sumatoria ?? 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="estrategia-container" id="matriz-defensiva">
        <h3>Estrategia Defensiva</h3>
        <p>Las fortalezas evaden el efecto negativo de las amenazas.</p>
        <p>0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo y 4=En total acuerdo</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="4">AMENAZAS</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 4; $i++)
                <tr>
                    @if ($i == 1)
                    <th rowspan="4">FORTALEZAS</th>
                    @endif
                    <th>F{{$i}}</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td><input type="number" min="0" max="4" data-matriz="defensiva" data-celda="c{{$i}}{{$j}}" value="{{ $matrizDefensiva->{'c'.$i.$j} }}"></td>
                    @endfor
                </tr>
                @endfor
                <tr>
                    <th colspan="2">Total</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td class="total-vertical">0</td>
                    @endfor
                    <td id="total-defensiva">{{$matrizDefensiva->sumatoria ?? 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="estrategia-container" id="matriz-reorientacion">
        <h3>Estrategia de Reorientación</h3>
        <p>Superamos las debilidades tomando ventaja de las oportunidades</p>
        <p>0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo y 4=En total acuerdo</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="4">OPORTUNIDADES</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>O1</th>
                    <th>O2</th>
                    <th>O3</th>
                    <th>O4</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 4; $i++)
                <tr>
                    @if ($i == 1)
                    <th rowspan="4">DEBILIDADES</th>
                    @endif
                    <th>D{{$i}}</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td><input type="number" min="0" max="4" data-matriz="reorientacion" data-celda="c{{$i}}{{$j}}" value="{{ $matrizReorientacion->{'c'.$i.$j} }}"></td>
                    @endfor
                </tr>
                @endfor
                <tr>
                    <th colspan="2">Total</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td class="total-vertical">0</td>
                    @endfor
                    <td id="total-reorientacion">{{$matrizReorientacion->sumatoria ?? 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="estrategia-container" id="matriz-supervivencia">
        <h3>Estrategia de Supervivencia</h3>
        <p>Las debilidades intensifican notablemente el efecto negativo de las amenazas</p>
        <p>0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo y 4=En total acuerdo</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="4">AMENAZAS</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 4; $i++)
                <tr>
                    @if ($i == 1)
                    <th rowspan="4">DEBILIDADES</th>
                    @endif
                    <th>D{{$i}}</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td><input type="number" min="0" max="4" data-matriz="supervivencia" data-celda="c{{$i}}{{$j}}" value="{{ $matrizSupervivencia->{'c'.$i.$j} }}"></td>
                    @endfor
                </tr>
                @endfor
                <tr>
                    <th colspan="2">Total</th>
                    @for ($j = 1; $j <= 4; $j++)
                    <td class="total-vertical">0</td>
                    @endfor
                    <td id="total-supervivencia">{{$matrizSupervivencia->sumatoria ?? 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
