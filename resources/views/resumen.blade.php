@extends('layouts.app')

@section('content')
@vite(['resources/css/resumen.css', 'resources/css/dafo-estrategia.css'])
<div class="container-fluid p-4" id="resumen-container">
    <h4 class="resumen-title text-center mb-4">RESUMEN EJECUTIVO DEL PLAN ESTRATÉGICO</h4>

    <table class="table table-bordered info-table mb-4">
        <tbody>
            <tr>
                <td class="info-label">Nombre de la empresa / proyecto:</td>
                <td class="info-value">{{ $proyecto->nombre_proyecto }}</td>
            </tr>
            <tr>
                <td class="info-label">Fecha de elaboración:</td>
                <td class="info-value">{{ $proyecto->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="info-label">Emprendedores / promotores:</td>
                <td class="info-value">{{ optional($proyecto->user)->name }}</td>
            </tr>
        </tbody>
    </table>

    <div class="resumen-section">
        <div class="resumen-header">MISIÓN</div>
        <div class="resumen-content">{{ $proyecto->mision }}</div>
    </div>

    <div class="resumen-section">
        <div class="resumen-header">VISIÓN</div>
        <div class="resumen-content">{{ $proyecto->vision }}</div>
    </div>

    <div class="resumen-section">
        <div class="resumen-header">VALORES</div>
        <div class="resumen-content valores-list">
            @foreach($proyecto->valores as $valor)
                <div class="valor-item">{{ $valor->valor }}</div>
            @endforeach
        </div>
    </div>

    <div class="resumen-section">
        <div class="resumen-header">UNIDADES ESTRATÉGICAS</div>
        <div class="resumen-content">{{ $proyecto->unidades_estrategicas }}</div>
    </div>

    <div class="resumen-section">
        <div class="resumen-header">OBJETIVOS ESTRATÉGICOS</div>
        <div class="resumen-content p-0">
            <table class="table table-bordered objetivos-table mb-0">
                <thead>
                    <tr>
                        <th>MISIÓN</th>
                        <th>OBJETIVOS GENERALES O ESTRATÉGICOS</th>
                        <th>OBJETIVOS ESPECÍFICOS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyecto->objetivosPrincipales as $objPrincipal)
                        <tr>
                            @if($loop->first)
                                <td rowspan="{{ $proyecto->objetivosPrincipales->count() }}" class="mision-cell">{{ $proyecto->mision }}</td>
                            @endif
                            <td class="obj-general">{{ $objPrincipal->objetivo }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach($objPrincipal->objetivosEspecificos as $objEspecifico)
                                        <li>{{ $objEspecifico->objetivo }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Análisis DAFO -->
    <div class="dafo-container my-5">
        <div class="dafo-title">ANÁLISIS DAFO</div>
        <table class="table dafo-table-new mb-0">
            <tbody>
                <tr>
                    <th class="dafo-debilidades">DEBILIDADES</th>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @if($proyecto->debilidad)
                                <li>{{ $proyecto->debilidad->debilidad1 }}</li>
                                <li>{{ $proyecto->debilidad->debilidad2 }}</li>
                                <li>{{ $proyecto->debilidad->debilidad3 }}</li>
                                <li>{{ $proyecto->debilidad->debilidad4 }}</li>
                            @endif
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th class="dafo-amenazas">AMENAZAS</th>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @if($proyecto->amenaza)
                                <li>{{ $proyecto->amenaza->amenaza1 }}</li>
                                <li>{{ $proyecto->amenaza->amenaza2 }}</li>
                                <li>{{ $proyecto->amenaza->amenaza3 }}</li>
                                <li>{{ $proyecto->amenaza->amenaza4 }}</li>
                            @endif
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th class="dafo-fortalezas">FORTALEZAS</th>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @if($proyecto->fortaleza)
                                <li>{{ $proyecto->fortaleza->fortaleza1 }}</li>
                                <li>{{ $proyecto->fortaleza->fortaleza2 }}</li>
                                <li>{{ $proyecto->fortaleza->fortaleza3 }}</li>
                                <li>{{ $proyecto->fortaleza->fortaleza4 }}</li>
                            @endif
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th class="dafo-oportunidades">OPORTUNIDADES</th>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @if($proyecto->oportunidad)
                                <li>{{ $proyecto->oportunidad->oportunidad1 }}</li>
                                <li>{{ $proyecto->oportunidad->oportunidad2 }}</li>
                                <li>{{ $proyecto->oportunidad->oportunidad3 }}</li>
                                <li>{{ $proyecto->oportunidad->oportunidad4 }}</li>
                            @endif
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Identificación de Estrategia -->
    <div class="identificacion-container my-5">
        <div class="d-flex align-items-center mb-2">
            <div class="identificacion-title">IDENTIFICACIÓN DE ESTRATEGIA</div>
            <div class="identificacion-subtitle ms-3">Escriba en el siguiente recuadro la estrategia identificada en la Matriz DAFO</div>
        </div>
        <div class="identificacion-box">
            <textarea class="form-control" rows="4"></textarea>
        </div>
    </div>

    <!-- Acciones Competitivas -->
    <div class="acciones-container my-5">
        <div class="acciones-title mb-2">ACCIONES COMPETITIVAS</div>
        @if($proyecto->correcion)
            @php
                $correciones = [
                    $proyecto->correcion->CDebilidades1, $proyecto->correcion->CDebilidades2, $proyecto->correcion->CDebilidades3, $proyecto->correcion->CDebilidades4,
                    $proyecto->correcion->CAmenazas1, $proyecto->correcion->CAmenazas2, $proyecto->correcion->CAmenazas3, $proyecto->correcion->CAmenazas4,
                    $proyecto->correcion->CFortalezas1, $proyecto->correcion->CFortalezas2, $proyecto->correcion->CFortalezas3, $proyecto->correcion->CFortalezas4,
                    $proyecto->correcion->COportunidades1, $proyecto->correcion->COportunidades2, $proyecto->correcion->COportunidades3, $proyecto->correcion->COportunidades4,
                ];
            @endphp
            <table class="table table-bordered acciones-table">
                <tbody>
                    @for ($i = 0; $i < 16; $i++)
                    <tr>
                        <th>{{ $i + 1 }}</th>
                        <td><input type="text" class="form-control" value="{{ $correciones[$i] ?? '' }}" readonly></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        @endif
    </div>

    <!-- Conclusión -->
    <div class="conclusion-container my-5">
        <div class="conclusion-title mb-2">CONCLUSIÓN</div>
        <textarea class="form-control" rows="6" placeholder="Escriba aquí la conclusión final del plan estratégico..."></textarea>
    </div>

    <div class="text-center my-5 no-print">
        <button id="btn-guardar-pdf" class="btn btn-success btn-lg">Guardar como PDF</button>
    </div>

</div>

{{-- Incluir la librería html2pdf.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

@vite('resources/js/resumen.js')
@endsection
