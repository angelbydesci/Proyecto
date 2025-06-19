
<div class="container py-4">
    <h1 class="text-center mb-4">Matriz de Estrategias FODA</h1>

    <!-- Síntesis de Resultados -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">SÍNTESIS DE RESULTADOS</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Estrategia</th>
                        <th>Puntuación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Estrategia Ofensiva (F-O)</td>
                        <td id="sintesis-ofensiva">0</td>
                    </tr>
                    <tr>
                        <td>Estrategia Defensiva (F-A)</td>
                        <td id="sintesis-defensiva">0</td>
                    </tr>
                    <tr>
                        <td>Estrategia Reorientación (D-O)</td>
                        <td id="sintesis-reorientacion">0</td>
                    </tr>
                    <tr>
                        <td>Estrategia Supervivencia (D-A)</td>
                        <td id="sintesis-supervivencia">0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" id="proyecto_id" value="{{ $proyecto->id }}">

    <!-- Matriz Ofensiva -->
    <div id="matriz-ofensiva" class="card mb-4 estrategia-container">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Estrategia Ofensiva (Fortalezas-Oportunidades)</h3>
        </div>
        <div class="card-body">
            <p>Las fortalezas se usan para tomar ventaja en cada una las oportunidades.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            
            <div class="table-responsive">
                <table class="table table-bordered text-center matriz-table">
                    <thead>
                        <tr>
                            <th>Oportunidades vs Fortalezas</th>
                            @for ($i = 1; $i <= 4; $i++)
                                <th>F{{ $i }}</th>
                            @endfor
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 4; $i++)
                        <tr>
                            <th>O{{ $i }}</th>
                            @for ($j = 1; $j <= 4; $j++)
                                @php $celda = "O{$i}F{$j}"; @endphp
                                <td>
                                    <select class="form-select" data-matriz="ofensiva" data-celda="{{ $celda }}">
                                        @for ($k = 0; $k <= 4; $k++)
                                            <option value="{{ $k }}" {{ (isset($matrizOfensiva) && $matrizOfensiva->$celda == $k) ? 'selected' : '' }}>{{ $k }}</option>
                                        @endfor
                                    </select>
                                </td>
                            @endfor
                            <td class="total-horizontal">0</td>
                        </tr>
                        @endfor
                        <tr>
                            <th>Total</th>
                            @for ($j = 1; $j <= 4; $j++)
                                <td class="total-vertical">0</td>
                            @endfor
                            <td id="total-ofensiva">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriz Defensiva -->
    <div id="matriz-defensiva" class="card mb-4 estrategia-container">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">Estrategia Defensiva (Fortalezas-Amenazas)</h3>
        </div>
        <div class="card-body">
            <p>Las fortalezas evaden el efecto negativo de las amenazas.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            <div class="table-responsive">
                <table class="table table-bordered text-center matriz-table">
                    <thead>
                        <tr>
                            <th>Amenazas vs Fortalezas</th>
                            @for ($i = 1; $i <= 4; $i++)
                                <th>F{{ $i }}</th>
                            @endfor
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 4; $i++)
                        <tr>
                            <th>A{{ $i }}</th>
                            @for ($j = 1; $j <= 4; $j++)
                                @php $celda = "A{$i}F{$j}"; @endphp
                                <td>
                                    <select class="form-select" data-matriz="defensiva" data-celda="{{ $celda }}">
                                        @for ($k = 0; $k <= 4; $k++)
                                            <option value="{{ $k }}" {{ (isset($matrizDefensiva) && $matrizDefensiva->$celda == $k) ? 'selected' : '' }}>{{ $k }}</option>
                                        @endfor
                                    </select>
                                </td>
                            @endfor
                            <td class="total-horizontal">0</td>
                        </tr>
                        @endfor
                        <tr>
                            <th>Total</th>
                            @for ($j = 1; $j <= 4; $j++)
                                <td class="total-vertical">0</td>
                            @endfor
                            <td id="total-defensiva">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriz Reorientación -->
    <div id="matriz-reorientacion" class="card mb-4 estrategia-container">
        <div class="card-header bg-warning">
            <h3 class="mb-0">Estrategia de Reorientación (Debilidades-Oportunidades)</h3>
        </div>
        <div class="card-body">
            <p>Las oportunidades ayudan a superar las debilidades.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            <div class="table-responsive">
                <table class="table table-bordered text-center matriz-table">
                    <thead>
                        <tr>
                            <th>Oportunidades vs Debilidades</th>
                            @for ($i = 1; $i <= 4; $i++)
                                <th>D{{ $i }}</th>
                            @endfor
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 4; $i++)
                        <tr>
                            <th>O{{ $i }}</th>
                            @for ($j = 1; $j <= 4; $j++)
                                @php $celda = "O{$i}D{$j}"; @endphp
                                <td>
                                    <select class="form-select" data-matriz="reorientacion" data-celda="{{ $celda }}">
                                        @for ($k = 0; $k <= 4; $k++)
                                            <option value="{{ $k }}" {{ (isset($matrizReorientacion) && $matrizReorientacion->$celda == $k) ? 'selected' : '' }}>{{ $k }}</option>
                                        @endfor
                                    </select>
                                </td>
                            @endfor
                            <td class="total-horizontal">0</td>
                        </tr>
                        @endfor
                        <tr>
                            <th>Total</th>
                            @for ($j = 1; $j <= 4; $j++)
                                <td class="total-vertical">0</td>
                            @endfor
                            <td id="total-reorientacion">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriz Supervivencia -->
    <div id="matriz-supervivencia" class="card mb-4 estrategia-container">
        <div class="card-header bg-danger text-white">
            <h3 class="mb-0">Estrategia de Supervivencia (Debilidades-Amenazas)</h3>
        </div>
        <div class="card-body">
            <p>Se reduce el efecto negativo de las debilidades y amenazas.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            <div class="table-responsive">
                <table class="table table-bordered text-center matriz-table">
                    <thead>
                        <tr>
                            <th>Amenazas vs Debilidades</th>
                            @for ($i = 1; $i <= 4; $i++)
                                <th>D{{ $i }}</th>
                            @endfor
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 4; $i++)
                        <tr>
                            <th>A{{ $i }}</th>
                            @for ($j = 1; $j <= 4; $j++)
                                @php $celda = "A{$i}D{$j}"; @endphp
                                <td>
                                    <select class="form-select" data-matriz="supervivencia" data-celda="{{ $celda }}">
                                        @for ($k = 0; $k <= 4; $k++)
                                            <option value="{{ $k }}" {{ (isset($matrizSupervivencia) && $matrizSupervivencia->$celda == $k) ? 'selected' : '' }}>{{ $k }}</option>
                                        @endfor
                                    </select>
                                </td>
                            @endfor
                            <td class="total-horizontal">0</td>
                        </tr>
                        @endfor
                        <tr>
                            <th>Total</th>
                            @for ($j = 1; $j <= 4; $j++)
                                <td class="total-vertical">0</td>
                            @endfor
                            <td id="total-supervivencia">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@vite('resources/js/estrategia.js')
