
<div class="container py-4">
    <h1 class="text-center mb-4">Matriz de Estrategias FODA</h1>

    <!-- Síntesis de Resultados -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">SÍNTESIS DE RESULTADOS</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Estrategia</th>
                        <th>Tipo</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Estrategia Ofensiva</td>
                        <td>(F-O)</td>
                        <td id="sintesis-ofensiva">{{ $matrizOfensiva->sumatoria ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>Estrategia Defensiva</td>
                        <td>(F-A)</td>
                        <td id="sintesis-defensiva">{{ $matrizDefensiva->sumatoria ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>Estrategia de Supervivencia</td>
                        <td>(D-A)</td>
                        <td id="sintesis-supervivencia">{{ $matrizSupervivencia->sumatoria ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>Estrategia de Reorientación</td>
                        <td>(D-O)</td>
                        <td id="sintesis-reorientacion">{{ $matrizReorientacion->sumatoria ?? 0 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" id="proyecto_id" value="{{ $proyecto->id }}">

    <!-- Matriz Ofensiva -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Estrategia Ofensiva (Fortalezas-Oportunidades)</h3>
        </div>
        <div class="card-body">
            <p>Las fortalezas se usan para tomar ventaja en cada una las oportunidades.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            
            <div class="table-responsive">
                <table class="table table-bordered matriz-table">
                    <thead>
                        <tr>
                            <th class="bg-light">Fortalezas \ Oportunidades</th>
                            @if($oportunidades)
                                <th>O1: {{ $oportunidades->oportunidad1 ?? 'N/A' }}</th>
                                <th>O2: {{ $oportunidades->oportunidad2 ?? 'N/A' }}</th>
                                <th>O3: {{ $oportunidades->oportunidad3 ?? 'N/A' }}</th>
                                <th>O4: {{ $oportunidades->oportunidad4 ?? 'N/A' }}</th>
                            @endif
                            <th class="bg-light">Total Fila</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($fortalezas)
                            @for($i = 1; $i <= 4; $i++)
                                <tr>
                                    <th class="bg-light">F{{$i}}: {{ $fortalezas->{'fortaleza'.$i} ?? 'N/A' }}</th>
                                    @for($j = 1; $j <= 4; $j++)
                                        @php $celda = 'O'.$j.'F'.$i; @endphp
                                        <td>
                                            <select class="form-control estrategia-select" data-matriz="ofensiva" data-celda="{{ $celda }}">
                                                @for($k = 0; $k <= 4; $k++)
                                                    <option value="{{ $k }}" {{ isset($matrizOfensiva->$celda) && $matrizOfensiva->$celda == $k ? 'selected' : '' }}>{{ $k }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    @endfor
                                    <td class="total-cell total-horizontal">0</td>
                                </tr>
                            @endfor
                        @endif
                        <tr>
                            <th class="bg-light">Total Columna</th>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell" id="total-ofensiva">{{ $matrizOfensiva->sumatoria ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriz Defensiva -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">Estrategia Defensiva (Fortalezas-Amenazas)</h3>
        </div>
        <div class="card-body">
            <p>Las fortalezas evaden el efecto negativo de las amenazas.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            
            <div class="table-responsive">
                <table class="table table-bordered matriz-table">
                    <thead>
                        <tr>
                            <th class="bg-light">Fortalezas \ Amenazas</th>
                            @if($amenazas)
                                <th>A1: {{ $amenazas->amenaza1 ?? 'N/A' }}</th>
                                <th>A2: {{ $amenazas->amenaza2 ?? 'N/A' }}</th>
                                <th>A3: {{ $amenazas->amenaza3 ?? 'N/A' }}</th>
                                <th>A4: {{ $amenazas->amenaza4 ?? 'N/A' }}</th>
                            @endif
                            <th class="bg-light">Total Fila</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($fortalezas)
                            @for($i = 1; $i <= 4; $i++)
                                <tr>
                                    <th class="bg-light">F{{$i}}: {{ $fortalezas->{'fortaleza'.$i} ?? 'N/A' }}</th>
                                    @for($j = 1; $j <= 4; $j++)
                                        @php $celda = 'A'.$j.'F'.$i; @endphp
                                        <td>
                                            <select class="form-control estrategia-select" data-matriz="defensiva" data-celda="{{ $celda }}">
                                                @for($k = 0; $k <= 4; $k++)
                                                    <option value="{{ $k }}" {{ isset($matrizDefensiva->$celda) && $matrizDefensiva->$celda == $k ? 'selected' : '' }}>{{ $k }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    @endfor
                                    <td class="total-cell total-horizontal">0</td>
                                </tr>
                            @endfor
                        @endif
                        <tr>
                            <th class="bg-light">Total Columna</th>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell" id="total-defensiva">{{ $matrizDefensiva->sumatoria ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriz Reorientación -->
    <div class="card mb-4">
        <div class="card-header bg-warning">
            <h3 class="mb-0">Estrategia de Reorientación (Debilidades-Oportunidades)</h3>
        </div>
        <div class="card-body">
            <p>Superamos las debilidades tomando ventaja de las oportunidades.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            
            <div class="table-responsive">
                <table class="table table-bordered matriz-table">
                    <thead>
                        <tr>
                            <th class="bg-light">Debilidades \ Oportunidades</th>
                            @if($oportunidades)
                                <th>O1: {{ $oportunidades->oportunidad1 ?? 'N/A' }}</th>
                                <th>O2: {{ $oportunidades->oportunidad2 ?? 'N/A' }}</th>
                                <th>O3: {{ $oportunidades->oportunidad3 ?? 'N/A' }}</th>
                                <th>O4: {{ $oportunidades->oportunidad4 ?? 'N/A' }}</th>
                            @endif
                            <th class="bg-light">Total Fila</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($debilidades)
                            @for($i = 1; $i <= 4; $i++)
                                <tr>
                                    <th class="bg-light">D{{$i}}: {{ $debilidades->{'debilidad'.$i} ?? 'N/A' }}</th>
                                    @for($j = 1; $j <= 4; $j++)
                                        @php $celda = 'O'.$j.'D'.$i; @endphp
                                        <td>
                                            <select class="form-control estrategia-select" data-matriz="reorientacion" data-celda="{{ $celda }}">
                                                @for($k = 0; $k <= 4; $k++)
                                                    <option value="{{ $k }}" {{ isset($matrizReorientacion->$celda) && $matrizReorientacion->$celda == $k ? 'selected' : '' }}>{{ $k }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    @endfor
                                    <td class="total-cell total-horizontal">0</td>
                                </tr>
                            @endfor
                        @endif
                        <tr>
                            <th class="bg-light">Total Columna</th>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell" id="total-reorientacion">{{ $matrizReorientacion->sumatoria ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriz Supervivencia -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h3 class="mb-0">Estrategia de Supervivencia (Debilidades-Amenazas)</h3>
        </div>
        <div class="card-body">
            <p>Las debilidades intensifican notablemente el efecto negativo de las amenazas.</p>
            <p><strong>Escala:</strong> 0=En total desacuerdo, 1= No está de acuerdo, 2= Esta de acuerdo, 3= Bastante de acuerdo, 4=En total acuerdo</p>
            
            <div class="table-responsive">
                <table class="table table-bordered matriz-table">
                    <thead>
                        <tr>
                            <th class="bg-light">Debilidades \ Amenazas</th>
                            @if($amenazas)
                                <th>A1: {{ $amenazas->amenaza1 ?? 'N/A' }}</th>
                                <th>A2: {{ $amenazas->amenaza2 ?? 'N/A' }}</th>
                                <th>A3: {{ $amenazas->amenaza3 ?? 'N/A' }}</th>
                                <th>A4: {{ $amenazas->amenaza4 ?? 'N/A' }}</th>
                            @endif
                            <th class="bg-light">Total Fila</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($debilidades)
                            @for($i = 1; $i <= 4; $i++)
                                <tr>
                                    <th class="bg-light">D{{$i}}: {{ $debilidades->{'debilidad'.$i} ?? 'N/A' }}</th>
                                    @for($j = 1; $j <= 4; $j++)
                                        @php $celda = 'A'.$j.'D'.$i; @endphp
                                        <td>
                                            <select class="form-control estrategia-select" data-matriz="supervivencia" data-celda="{{ $celda }}">
                                                @for($k = 0; $k <= 4; $k++)
                                                    <option value="{{ $k }}" {{ isset($matrizSupervivencia->$celda) && $matrizSupervivencia->$celda == $k ? 'selected' : '' }}>{{ $k }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    @endfor
                                    <td class="total-cell total-horizontal">0</td>
                                </tr>
                            @endfor
                        @endif
                        <tr>
                            <th class="bg-light">Total Columna</th>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell total-vertical">0</td>
                            <td class="total-cell" id="total-supervivencia">{{ $matrizSupervivencia->sumatoria ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calcular todos los totales al cargar la página
    calcularTotales('ofensiva');
    calcularTotales('defensiva');
    calcularTotales('reorientacion');
    calcularTotales('supervivencia');
    
    // Event listeners para los selects
    document.querySelectorAll('.estrategia-select').forEach(select => {
        select.addEventListener('change', function() {
            const matriz = this.dataset.matriz;
            const celda = this.dataset.celda;
            const valor = this.value;
            const proyectoId = document.getElementById('proyecto_id').value;
            
            // Enviar datos al servidor
            fetch('{{ route("estrategia.storeOrUpdate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    proyecto_id: proyectoId,
                    matriz: matriz,
                    celda: celda,
                    valor: valor
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    calcularTotales(matriz);
                    actualizarSintesis();
                } else {
                    console.error('Error al guardar:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
    
    function calcularTotales(matriz) {
        const tabla = document.getElementById(`matriz-${matriz}`)?.querySelector('.matriz-table');
        if(!tabla) return;
        
        let totalGeneral = 0;
        
        // Calcular totales por fila
        tabla.querySelectorAll('tbody tr').forEach((fila, i) => {
            if (i < 4) { // Solo las filas de datos (no los totales)
                let totalFila = 0;
                fila.querySelectorAll('select').forEach(select => {
                    totalFila += parseInt(select.value) || 0;
                });
                const totalCell = fila.querySelector('.total-horizontal');
                if(totalCell) totalCell.textContent = totalFila;
            }
        });
        
        // Calcular totales por columna
        const columnTotals = [0, 0, 0, 0];
        tabla.querySelectorAll('tbody tr:not(:last-child)').forEach(fila => {
            fila.querySelectorAll('select').forEach((select, j) => {
                columnTotals[j] += parseInt(select.value) || 0;
            });
        });
        
        // Actualizar totales por columna
        tabla.querySelectorAll('.total-vertical').forEach((celda, i) => {
            celda.textContent = columnTotals[i] || 0;
            totalGeneral += columnTotals[i] || 0;
        });
        
        // Actualizar total general
        const totalGeneralCell = tabla.querySelector('td[id^="total-"]');
        if(totalGeneralCell) totalGeneralCell.textContent = totalGeneral;
    }
    
    function actualizarSintesis() {
        document.getElementById('sintesis-ofensiva').textContent = 
            document.getElementById('total-ofensiva').textContent;
        document.getElementById('sintesis-defensiva').textContent = 
            document.getElementById('total-defensiva').textContent;
        document.getElementById('sintesis-reorientacion').textContent = 
            document.getElementById('total-reorientacion').textContent;
        document.getElementById('sintesis-supervivencia').textContent = 
            document.getElementById('total-supervivencia').textContent;
    }
});
</script>
