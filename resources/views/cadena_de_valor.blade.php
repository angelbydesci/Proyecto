{{-- resources/views/cadena_de_valor.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container mt-4">
    <h2>6. ANÁLISIS INTERNO: LA CADENA DE VALOR</h2>

    <p>Todas las actividades de una empresa forman la cadena de valor.</p>
    <p>La Cadena de Valor es una herramienta que permite a la empresa identificar aquellas actividades o fases que pueden aportarle un mayor valor añadido al producto final. Intenta buscar fuentes de ventaja competitiva.</p>
    <p>La empresa está formada por una secuencia de actividades diseñadas para añadir valor al producto o servicio según las distintas fases, hasta que se llega al cliente final.</p>
    <p>Una cadena de valor genérica está constituida por tres elementos básicos:</p>

    {{-- Diagrama conceptual 1 (Elementos básicos) --}}
    <div class="my-4 p-3 border rounded bg-light">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="p-2 border bg-white mb-2">
                    <strong>Actividades primarias</strong>
                    <p class="mt-1">➔ Transformación de inputs y relación con el cliente</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-2 border bg-white mb-2">
                    <strong>Actividades de apoyo</strong>
                    <p class="mt-1">➔ Estructura de la empresa para poder desarrollar todo el proceso productivo</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-2 border bg-white mb-2">
                    <strong>Margen</strong>
                    <p class="mt-1">➔ Valor obtenido por la empresa en relación a los costes</p>
                </div>
            </div>
        </div>
    </div>

    <h4>Las Actividades Primarias son aquellas que tienen que ver con el producto/servicio, su producción, logística, comercialización, etc.</h4>
    <ul class="list-unstyled ms-3">
        <li>➔ Logística de entrada (recepción, almacenamiento, manipulación de materiales, inspección interna, devoluciones, inventarios,…)</li>
        <li>➔ Operaciones (proceso de fabricación, ensamblaje, mantenimiento de equipos, mecanización, embalaje…)</li>
        <li>➔ Logística de salida (gestión de pedidos, honorarios, almacenamiento de producto terminado, transporte…)</li>
        <li>➔ Marketing y ventas (comercialización, selección del canal de distribución, publicidad, promoción, política de precio…)</li>
        <li>➔ Servicios (reparaciones de productos, instalación, mantenimiento, servicios post - venta, reclamaciones, reajustes del producto…)</li>
    </ul>

    <h4 class="mt-4">Las Actividades de Soporte o apoyo a las actividades primarias son:</h4>
    <ul class="list-unstyled ms-3">
        <li>➔ Infraestructura empresarial (administración, finanzas, contabilidad, calidad, relaciones públicas, asesoría legal, gerencia…)</li>
        <li>➔ Gestión de los recursos humanos (selección, contratación, formación, incentivos…)</li>
        <li>➔ Desarrollo tecnológico (telecomunicaciones, automatización, desarrollo de procesos e ingeniería, diseño, saber hacer, procedimientos, I+D…)</li>
        <li>➔ Abastecimiento (compras de materias primas, consumibles, equipamientos, servicios…)</li>
    </ul>

    <p class="mt-4"><strong>El Margen,</strong> es la diferencia entre el valor total obtenido y los costes incurridos por la empresa para desempeñar las actividades generadoras de valor.</p>

    {{-- Diagrama de la Cadena de Valor de Porter --}}
    <div class="my-4 p-3 border rounded bg-light text-center">
        <p class="text-muted">[Espacio para imagen de la Cadena de Valor de Porter]</p>
        <div class="row mt-3">
            <div class="col-2 text-center" style="writing-mode: vertical-rl; transform: rotate(180deg);">
                <strong class="d-block border p-2 bg-secondary text-white">ACTIVIDADES DE APOYO</strong>
            </div>
            <div class="col-10">
                <div class="p-2 border bg-info text-white mb-1">INFRAESTRUCTURA DE LA EMPRESA</div>
                <div class="p-2 border bg-info text-white mb-1">GESTIÓN DE RECURSOS HUMANOS</div>
                <div class="p-2 border bg-info text-white mb-1">COMPRAS</div>
                <div class="p-2 border bg-info text-white mb-3">DESARROLLO DE TECNOLOGÍAS</div>
                
                <div class="row gx-1">
                    <div class="col"><div class="p-2 border bg-success text-white">Logística de entrada</div></div>
                    <div class="col"><div class="p-2 border bg-success text-white">Operaciones</div></div>
                    <div class="col"><div class="p-2 border bg-success text-white">Logística de salida</div></div>
                    <div class="col"><div class="p-2 border bg-success text-white">Marketing y ventas</div></div>
                    <div class="col"><div class="p-2 border bg-success text-white">Servicios</div></div>
                </div>
                <div class="mt-2">
                    <strong>ACTIVIDADES PRIMARIAS</strong>
                </div>
            </div>
            <div class="col-12 text-center">
                 <div class="p-2 border bg-warning text-dark mt-2 d-inline-block"><strong>MARGEN</strong></div>
            </div>
        </div>
    </div>

    <p>Cada eslabón de la cadena puede ser fuente de ventaja competitiva, ya sea porque se optimice (excelencia en la ejecución de una actividad) y/o mejore su coordinación con otra actividad.</p>

    <div class="mt-4 mb-4 p-3 bg-light rounded">
        <p>A continuación le proponemos un autodiagnóstico de la cadena de valor interna para conocer porcentualmente el potencial de mejora de la cadena de valor.</p>
    </div>

</div>
