<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz BCG Interactiva - Laravel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f7fa;
            color: #333;
        }
        h1, h2, h3, h4 {
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .container-fluid { /* Cambiado para ocupar más ancho */
            padding-left: 30px;
            padding-right: 30px;
        }
        .main-row { /* Para organizar controles y gráfico */
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        .controls-section {
            flex: 1;
            min-width: 400px; /* Aumentado */
            max-width: 600px; /* Añadido para mejor control */
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            align-self: flex-start; /* Para alinear arriba */
        }
        .chart-section {
            flex: 2;
            min-width: 550px; /* Reducido para mejor ajuste */
            display: flex;
            flex-direction: column; /* Para alinear elementos verticalmente */
            gap: 20px; /* Espacio entre gráfico y tabla */
        }
        .product-form {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: relative;
            border-left: 4px solid #3498db;
        }
        .competitor-form {
            margin-top: 15px;
            padding: 15px;
            background: #eef2f7;
            border-radius: 6px;
            position: relative;
            border-left: 3px solid #7f8c8d;
            margin-bottom: 10px; /* Espacio inferior */
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap; /* Para mejor responsividad */
            align-items: center;
            gap: 10px; /* Espacio entre label e input */
        }
        label {
            display: inline-block;
            min-width: 130px; /* Aumentado */
            font-weight: 600;
            color: #34495e;
            margin-bottom: 5px; /* Espacio si el input va debajo */
        }
        input, select {
            padding: 9px 13px; /* Aumentado padding */
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            flex: 1;
            min-width: 180px; /* Para que no sean muy pequeños */
        }
        input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
        }
        button {
            padding: 10px 18px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-size: 14px; /* Consistencia */
        }
        button:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }
        .btn-add { background: #2ecc71; }
        .btn-add:hover { background: #27ae60; }
        .btn-danger { background: #e74c3c; }
        .btn-danger:hover { background: #c0392b; }
        .btn-secondary { background: #95a5a6; }
        .btn-secondary:hover { background: #7f8c8d; }

        .delete-btn {
            padding: 6px 12px; /* Ajustado */
            font-size: 13px; /* Ajustado */
            margin-left: 10px;
        }
        .delete-product-btn {
            position: absolute;
            top: 15px; /* Ajustado */
            right: 15px; /* Ajustado */
        }
        .delete-competitor-btn {
            position: absolute;
            top: 10px; /* Ajustado */
            right: 10px; /* Ajustado */
            padding: 4px 8px; /* Ajustado */
            font-size: 11px; /* Ajustado */
        }
        .bcg-chart {
            width: 100%;
            height: 450px; /* Reducido */
            position: relative;
            border: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            overflow: hidden; /* Para que las etiquetas no se salgan */
        }
        .quadrant {
            position: absolute;
            width: 50%;
            height: 50%;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px; /* Reducido */
            color: rgba(0,0,0,0.15); /* Más sutil */
            text-transform: uppercase; /* Estilo */
        }
        .quadrant-star { top: 0; right: 0; background: rgba(46, 204, 113, 0.08); }
        .quadrant-question { top: 0; left: 0; background: rgba(52, 152, 219, 0.08); }
        .quadrant-cashcow { bottom: 0; right: 0; background: rgba(241, 196, 15, 0.08); }
        .quadrant-dog { bottom: 0; left: 0; background: rgba(231, 76, 60, 0.08); }

        .axis { position: absolute; background: #bdc3c7; z-index: 1; }
        .axis-x { width: 100%; height: 2px; top: 50%; left: 0; transform: translateY(-1px); }
        .axis-y { width: 2px; height: 100%; left: 50%; top: 0; transform: translateX(-1px); }

        .axis-label {
            position: absolute;
            font-size: 12px; /* Reducido */
            font-weight: bold;
            color: #7f8c8d;
            background: white;
            padding: 2px 5px;
            border-radius: 3px;
        }
        .x-axis-label-container { /* Para PRM */
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            text-align: center;
        }
        .y-axis-label-container { /* Para TCM */
            position: absolute;
            top: 0;
            right: 5px; /* Ajustado */
            height: 100%;
            display: flex;
            align-items: center;
        }
        .y-axis-label-container span { transform: rotate(-90deg); white-space: nowrap; }

        .axis-marker { position: absolute; font-size: 10px; color: #7f8c8d; }
        .prm-marker-high { top: 50%; left: 5px; transform: translateY(-50%); } /* PRM > 1 (Izquierda) */
        .prm-marker-low { top: 50%; right: 5px; transform: translateY(-50%); } /* PRM < 1 (Derecha) */
        .tcm-marker-high { bottom: 5px; left: 50%; transform: translateX(-50%); } /* TCM > 10% (Arriba) */
        .tcm-marker-low { top: 5px; left: 50%; transform: translateX(-50%); } /* TCM < 10% (Abajo) */


        .product-bubble {
            position: absolute;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 11px; /* Ajustado */
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            z-index: 2;
            text-align: center;
            padding: 5px; /* Para que el texto no se pegue al borde */
            line-height: 1.2; /* Mejorar legibilidad */
        }
        .product-bubble:hover {
            transform: scale(1.15); /* Aumentado */
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }
        .metrics-table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .metrics-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
            border-radius: 8px;
            overflow: hidden; /* Para bordes redondeados */
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .metrics-table th, .metrics-table td {
            border: 1px solid #ecf0f1;
            padding: 10px 12px; /* Ajustado */
            text-align: center;
            font-size: 13px; /* Ajustado */
        }
        .metrics-table th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
        }
        .metrics-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .metrics-table tr:hover {
            background-color: #f1f7fd;
        }
        .growth-table-container {
            margin-top: 10px;
            overflow-x: auto; /* Para tablas anchas */
        }
        .growth-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
            border-radius: 6px;
            overflow: hidden;
        }
        .growth-table th, .growth-table td {
            border: 1px solid #ecf0f1;
            padding: 8px;
            text-align: center;
            font-size: 12px;
            min-width: 80px; /* Ancho mínimo para celdas de período */
        }
        .growth-table th {
            background-color: #2c3e50;
            color: white;
            font-weight: 500;
        }
        .growth-table td { background-color: #f8f9fa; }
        .growth-table input {
            width: 100%; /* Ocupar toda la celda */
            max-width: 70px; /* Evitar que sea muy ancho */
            padding: 5px;
            text-align: center;
            box-sizing: border-box; /* Para que padding no afecte el ancho */
        }
        .period-controls {
            margin-bottom: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .period-controls label {
            min-width: auto; /* Ajustar label */
            margin-bottom: 0;
        }
        #saveAllButton {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #1abc9c;
        }
        #saveAllButton:hover {
            background-color: #16a085;
        }
        .info-text {
            font-size: 0.9em;
            color: #7f8c8d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h1>Matriz BCG Interactiva</h1>
        
        <form id="bcgForm" method="POST" action="{{ route('autodiagnostico.bcg.save', ['proyecto' => $proyecto]) }}"> {{-- Ajusta la ruta según tu configuración y pasa el proyecto --}}
            @csrf
            <div class="main-row">
                <div class="controls-section">
                    <h2>Controles de Productos</h2>
                    
                    {{-- Controles de período globales eliminados --}}
                    {{-- <div class="period-controls">
                        <button type="button" class="btn-secondary" id="addPeriodButton" onclick="addPeriod()">+ Añadir Nuevo Período</button>
                        <button type="button" class="btn-secondary" id="removePeriodButton" onclick="removePeriod()">- Quitar Último Período</button>
                    </div>
                    <p class="info-text">Máximo 5 períodos. El primer período es 2023-2024.</p> --}}

                    <div id="productsContainer">
                        {{-- Los formularios de productos se agregarán aquí dinámicamente --}}
                    </div>
                    
                    <button type="button" class="btn-add" onclick="addProduct()" style="width: 100%; margin-top: 20px;">+ Añadir Nuevo Producto</button>
                    <button type="submit" id="saveAllButton">Guardar Todos los Cambios</button>
                </div>
                
                <div class="chart-section">
                    <div class="bcg-chart" id="bcgChart">
                        <div class="axis axis-x"></div>
                        <div class="axis axis-y"></div>
                        <div class="quadrant quadrant-question"><span class="quadrant-label">INTERROGANTE</span></div>
                        <div class="quadrant quadrant-star"><span class="quadrant-label">ESTRELLA</span></div>
                        <div class="quadrant quadrant-dog"><span class="quadrant-label">PERRO</span></div>
                        <div class="quadrant quadrant-cashcow"><span class="quadrant-label">VACA</span></div>

                        <div class="x-axis-label-container">
                            <span class="axis-label">Participación Relativa de Mercado (PRM) &rarr;</span>
                        </div>
                        <div class="y-axis-label-container">
                            <span class="axis-label">&uarr; Tasa de Crecimiento del Mercado (TCM)</span>
                        </div>
                        <span class="axis-marker prm-marker-high">Alto (PRM &ge; 1)</span>
                        <span class="axis-marker prm-marker-low">Bajo (PRM &lt; 1)</span>
                        <span class="axis-marker tcm-marker-high">Alta (TCM &ge; 10%)</span>
                        <span class="axis-marker tcm-marker-low">Baja (TCM &lt; 10%)</span>
                    </div>

                    <div class="metrics-table-container">
                        <h3>Tabla de Métricas</h3>
                        <table class="metrics-table" id="metricsTable">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Ventas</th>
                                    <th>% S/Vtas Totales</th>
                                    <th>TCM (%)</th>
                                    <th>PRM</th>
                                    <th>Cuadrante BCG</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Las filas de métricas se agregarán aquí dinámicamente --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        let productCounter = 0;
        // let currentPeriods = [{ yearLabel: "2023-2024", startYear: 2023 }]; // Eliminado: ahora por producto
        let productPeriods = {}; // Almacena los períodos para cada producto: productPeriods[productId] = [{yearLabel, startYear}, ...]

        document.addEventListener('DOMContentLoaded', () => {
            // updatePeriodControls(); // Eliminado: controles globales ya no existen
            loadExistingProducts(); 
        });

        // Funciones eliminadas: updatePeriodControls, addPeriod, removePeriod, rerenderGrowthTables
        // ya que la lógica de períodos ahora es por producto.

        function parseStartYear(yearLabel) {
            // Asume formato "YYYY-YYYY" o solo "YYYY"
            const parts = yearLabel.split('-');
            return parseInt(parts[0]);
        }

        function updateProductPeriodControls(productId) {
            const periods = productPeriods[productId] || [];
            const addButton = document.querySelector(`#product_form_${productId} .add-product-period-btn`);
            const removeButton = document.querySelector(`#product_form_${productId} .remove-product-period-btn`);
            const infoText = document.querySelector(`#product_form_${productId} .product-period-info`);

            if (addButton) addButton.disabled = periods.length >= 5;
            if (removeButton) removeButton.disabled = periods.length <= 0; // Permitir quitar hasta 0 períodos
            if (infoText) {
                let message = `${periods.length} período(s). `;
                if (periods.length >= 5) message += "Máximo 5 alcanzado.";
                else if (periods.length === 0) message += "Mínimo 0 alcanzado.";
                else message += "Máx 5, Mín 0.";
                infoText.textContent = message;
            }
        }

        function addProductPeriod(productId) {
            const periods = productPeriods[productId];
            if (periods.length >= 5) return;

            let newStartYear;
            if (periods.length === 0) {
                newStartYear = new Date().getFullYear() - 1; 
            } else {
                const oldestPeriod = periods.reduce((oldest, current) => current.startYear < oldest.startYear ? current : oldest, periods[0]);
                newStartYear = oldestPeriod.startYear - 1;
            }
            const newYearLabel = `${newStartYear}-${newStartYear + 1}`;
            const newPeriodObject = { yearLabel: newYearLabel, startYear: newStartYear };
            
            if (!periods.find(p => p.yearLabel === newYearLabel)) {
                periods.push(newPeriodObject);
                periods.sort((a, b) => a.startYear - b.startYear);

                const growthContainer = document.getElementById(`growth_table_container_${productId}`);
                if (!growthContainer) return;

                let table = growthContainer.querySelector('.growth-table');
                if (!table || periods.length === 1) { // Si la tabla no existe o es el primer período
                    renderProductGrowthTable(productId); // Dejar que renderProductGrowthTable maneje la creación/recreación inicial
                } else {
                    // La tabla existe y tiene más de un período, añadir celdas directamente
                    const headerRow = table.querySelector('thead tr');
                    const bodyRow = table.querySelector('tbody tr');

                    if (!headerRow || !bodyRow) { // Estructura inesperada, reconstruir por seguridad
                        renderProductGrowthTable(productId);
                        updateProductPeriodControls(productId);
                        updateAllCalculations();
                        return;
                    }

                    const newTh = document.createElement('th');
                    newTh.setAttribute('data-period-label', newYearLabel);
                    newTh.textContent = `${newYearLabel} (%)`;

                    const newTd = document.createElement('td');
                    newTd.setAttribute('data-period-label', newYearLabel);
                    newTd.innerHTML = `<input type="number" name="products[${productId}][historical_growth][${newYearLabel}]" class="growth-input" step="0.1" placeholder="%" oninput="updateAllCalculations()" value="">`;
                    
                    let inserted = false;
                    const existingThs = Array.from(headerRow.children);
                    for (let i = 0; i < existingThs.length; i++) {
                        const existingLabel = existingThs[i].getAttribute('data-period-label');
                        if (existingLabel) { // Asegurarse que el th tiene el atributo
                            const existingStartYear = parseStartYear(existingLabel);
                            if (newStartYear < existingStartYear) {
                                headerRow.insertBefore(newTh, existingThs[i]);
                                bodyRow.insertBefore(newTd, bodyRow.children[i]);
                                inserted = true;
                                break;
                            }
                        }
                    }
                    if (!inserted) {
                        headerRow.appendChild(newTh);
                        bodyRow.appendChild(newTd);
                    }
                }
                updateProductPeriodControls(productId);
                updateAllCalculations();
            }
        }

        function removeProductPeriod(productId) {
            const periods = productPeriods[productId];
            if (periods.length === 0) return;

            periods.sort((a, b) => a.startYear - b.startYear); 
            const removedPeriod = periods.shift(); // Quita el más antiguo de la lista de datos
            
            if (!removedPeriod) return; // No debería pasar si periods.length > 0
            const periodLabelToRemove = removedPeriod.yearLabel;

            const growthContainer = document.getElementById(`growth_table_container_${productId}`);
            if (!growthContainer) return;

            const table = growthContainer.querySelector('.growth-table');
            if (table) {
                const thToRemove = table.querySelector(`thead tr th[data-period-label="${periodLabelToRemove}"]`);
                if (thToRemove) thToRemove.remove();

                const tdToRemove = table.querySelector(`tbody tr td[data-period-label="${periodLabelToRemove}"]`);
                if (tdToRemove) tdToRemove.remove();

                if (periods.length === 0) { 
                    growthContainer.innerHTML = '<p>No hay períodos de crecimiento definidos para este producto.</p>';
                } else {
                    // Verificar si las filas de encabezado o cuerpo están vacías y eliminar la tabla si es necesario
                    const headerRow = table.querySelector('thead tr');
                    const bodyRow = table.querySelector('tbody tr');
                    if ((headerRow && headerRow.children.length === 0) || (bodyRow && bodyRow.children.length === 0)) {
                        growthContainer.innerHTML = '<p>No hay períodos de crecimiento definidos para este producto.</p>';
                    }
                }
            }
            
            updateProductPeriodControls(productId);
            updateAllCalculations();
        }
        
        function renderProductGrowthTable(productId, initialTCMs = null) {
            const growthContainer = document.getElementById(`growth_table_container_${productId}`);
            if (!growthContainer) return;

            const currentInputValues = {};
            growthContainer.querySelectorAll('.growth-input').forEach(input => {
                const nameAttr = input.name;
                const match = nameAttr.match(/\\[historical_growth\\]\\[(.*?)\\]/);
                if (match && match[1]) {
                    const periodLabel = match[1];
                    // Cambio clave: Registrar siempre el valor del input, sea cual sea (incluso cadena vacía).
                    currentInputValues[periodLabel] = input.value;
                }
            });

            if (initialTCMs && initialTCMs.length > 0) {
                initialTCMs.forEach(tcm => {
                    if (tcm && typeof tcm.anio_crecimiento !== 'undefined' && typeof tcm.tasa_crecimiento !== 'undefined') {
                        // Los datos de la BD (initialTCMs) tienen prioridad si se proporcionan al cargar
                        currentInputValues[tcm.anio_crecimiento] = tcm.tasa_crecimiento;
                    }
                });
            }
            
            const periodsForTable = productPeriods[productId] || [];
            let tableHTML = '';

            if (periodsForTable.length > 0) {
                tableHTML = '<table class="growth-table"><thead><tr>';
                periodsForTable.forEach(period => {
                    tableHTML += `<th data-period-label="${period.yearLabel}">${period.yearLabel} (%)</th>`;
                });
                tableHTML += '</tr></thead><tbody><tr>';
                periodsForTable.forEach(period => {
                    const value = currentInputValues[period.yearLabel] !== undefined ? currentInputValues[period.yearLabel] : ''; 
                    tableHTML += `<td data-period-label="${period.yearLabel}"><input type="number" name="products[${productId}][historical_growth][${period.yearLabel}]" class="growth-input" step="0.1" placeholder="%" oninput="updateAllCalculations()" value="${value}"></td>`;
                });
                tableHTML += '</tr></tbody></table>';
            } else {
                tableHTML = '<p>No hay períodos de crecimiento definidos para este producto.</p>';
            }
            
            growthContainer.innerHTML = tableHTML;
        }


        // generateGrowthTableHTML ya no se usa directamente, su lógica está en renderProductGrowthTable
        // function generateGrowthTableHTML(productId, existingValues = {}) { ... }

        function addProduct() {
            productCounter++;
            const productId = `product_${productCounter}`;

            // Inicializar períodos para este nuevo producto
            const defaultStartYear = new Date().getFullYear() - 1; // Año anterior
            productPeriods[productId] = [{ yearLabel: `${defaultStartYear}-${defaultStartYear + 1}`, startYear: defaultStartYear }];

            const newProductForm = document.createElement('div');
            newProductForm.className = 'product-form';
            newProductForm.id = `product_form_${productId}`; // Añadir ID al formulario del producto
            newProductForm.dataset.productId = productId;
            newProductForm.innerHTML = `
                <button type="button" class="btn-danger delete-btn delete-product-btn" onclick="removeProduct(this)">Eliminar Producto</button>
                <h4>Producto ${productCounter}</h4>
                <input type="hidden" name="products[${productId}][id_temp]" value="${productId}">
                <div class="form-group">
                    <label for="product_name_${productId}">Nombre:</label>
                    <input type="text" id="product_name_${productId}" name="products[${productId}][name]" placeholder="Nombre del Producto" required oninput="updateAllCalculations()">
                </div>
                <div class="form-group">
                    <label for="sales_${productId}">Ventas Anuales:</label>
                    <input type="number" id="sales_${productId}" name="products[${productId}][sales]" placeholder="Ej: 1200" step="0.01" required oninput="updateAllCalculations()">
                </div>
                
                <h5>Crecimiento Histórico del Mercado (%)</h5>
                <div class="product-period-controls">
                    <button type="button" class="btn-secondary add-product-period-btn" onclick="addProductPeriod('${productId}')">+ Período</button>
                    <button type="button" class="btn-secondary remove-product-period-btn" onclick="removeProductPeriod('${productId}')">- Período</button>
                    <span class="info-text product-period-info"></span>
                </div>
                <div class="growth-table-container" id="growth_table_container_${productId}">
                    {{-- La tabla de crecimiento se renderizará aquí por renderProductGrowthTable --}}
                </div>

                <h5>Competidores</h5>
                <div class="competitors-container" id="competitors_container_${productId}">
                    <!-- Competidores se agregarán aquí -->
                </div>
                <button type="button" class="btn-add" onclick="addCompetitor('${productId}')" style="margin-top: 10px;">+ Añadir Competidor</button>
            `;
            
            document.getElementById('productsContainer').appendChild(newProductForm);
            renderProductGrowthTable(productId); // Renderizar tabla inicial para el nuevo producto
            updateProductPeriodControls(productId); // Actualizar controles para el nuevo producto
            updateAllCalculations();
        }

        function removeProduct(button) {
            const productForm = button.closest('.product-form');
            const productId = productForm.dataset.productId;
            delete productPeriods[productId]; // Limpiar los períodos de este producto
            productForm.remove();
            updateAllCalculations();
        }

        function addCompetitor(productId) {
            const competitorsContainer = document.getElementById(`competitors_container_${productId}`);
            const competitorIndex = competitorsContainer.children.length;
            const competitorId = `${productId}_competitor_${competitorIndex}`;

            const newCompetitorDiv = document.createElement('div');
            newCompetitorDiv.className = 'competitor-form';
            newCompetitorDiv.innerHTML = `
                <button type="button" class="btn-danger delete-btn delete-competitor-btn" onclick="removeCompetitor(this)">X</button>
                <input type="hidden" name="products[${productId}][competitors][${competitorId}][id_temp]" value="${competitorId}">
                <div class="form-group">
                    <label for="competitor_name_${competitorId}">Nombre Competidor:</label>
                    <input type="text" id="competitor_name_${competitorId}" name="products[${productId}][competitors][${competitorId}][name]" placeholder="Nombre" required oninput="updateAllCalculations()">
                </div>
                <div class="form-group">
                    <label for="competitor_sales_${competitorId}">Ventas Competidor:</label>
                    <input type="number" id="competitor_sales_${competitorId}" name="products[${productId}][competitors][${competitorId}][sales]" placeholder="Ej: 1000" step="0.01" required oninput="updateAllCalculations()">
                </div>
            `;
            competitorsContainer.appendChild(newCompetitorDiv);
            updateAllCalculations();
        }

        function removeCompetitor(button) {
            button.closest('.competitor-form').remove(); // Corrected: remove only the competitor form
            updateAllCalculations();
        }

        function addExistingCompetitorToProductUI(productIdDom, competidorData, competitorIndex, competitorsContainer) {
            // competidorData es { nombre_competidor: "Comp A", ventas_anuales_competidor: 500, id_competidor: X }
            const competitorIdDom = `${productIdDom}_competitor_${competitorIndex}`; // ID para el DOM

            const newCompetitorDiv = document.createElement('div');
            newCompetitorDiv.className = 'competitor-form';
            newCompetitorDiv.innerHTML = `
                <button type="button" class="btn-danger delete-btn delete-competitor-btn" onclick="removeCompetitor(this)">X</button>
                <input type="hidden" name="products[${productIdDom}][competitors][${competitorIdDom}][id_temp]" value="${competitorIdDom}">
                <input type="hidden" name="products[${productIdDom}][competitors][${competitorIdDom}][id_db]" value="${competidorData.id_competidor || ''}">
                <div class="form-group">
                    <label for="competitor_name_${competitorIdDom}">Nombre Competidor:</label>
                    <input type="text" id="competitor_name_${competitorIdDom}" name="products[${productIdDom}][competitors][${competitorIdDom}][name]" placeholder="Nombre" required oninput="updateAllCalculations()" value="${competidorData.nombre_competidor || ''}">
                </div>
                <div class="form-group">
                    <label for="competitor_sales_${competitorIdDom}">Ventas Competidor:</label>
                    <input type="number" id="competitor_sales_${competitorIdDom}" name="products[${productIdDom}][competitors][${competitorIdDom}][sales]" placeholder="Ej: 1000" step="0.01" required oninput="updateAllCalculations()" value="${competidorData.ventas_anuales_competidor || 0}">
                </div>
            `;
            competitorsContainer.appendChild(newCompetitorDiv);
        }

        function loadExistingProducts() {
            console.log('Iniciando loadExistingProducts...');
            const productosExistentes = @json($productosExistentes ?? []);
            console.log("Paso 1: Datos recibidos del backend (productosExistentes):", JSON.parse(JSON.stringify(productosExistentes)));

            const productsContainer = document.getElementById('productsContainer');
            productsContainer.innerHTML = ''; 

            if (!productosExistentes || productosExistentes.length === 0) {
                console.log("Paso 2: No hay productos existentes para cargar o el array está vacío. Añadiendo un producto nuevo por defecto.");
                addProduct(); 
                return;
            }

            try {
                console.log("Paso 2: Procesando productos existentes...");
                productosExistentes.forEach((producto, index) => {
                    if (!producto) {
                        console.warn(`Paso 3.${index + 1}: Producto en el índice ${index} es null o undefined. Saltando.`);
                        return; 
                    }

                    console.log(`Paso 3.${index + 1}: Procesando producto:`, JSON.parse(JSON.stringify(producto)));
                    productCounter++; 
                    const productIdDom = `product_${productCounter}`;

                    // Inicializar y popular productPeriods para este producto
                    productPeriods[productIdDom] = [];
                    if (producto.tcms && producto.tcms.length > 0) {
                        producto.tcms.forEach(tcm => {
                            if (tcm && typeof tcm.anio_crecimiento !== 'undefined') { // Verificar que tcm y anio_crecimiento existen
                                productPeriods[productIdDom].push({
                                    yearLabel: tcm.anio_crecimiento, // Asegurar que yearLabel se incluye
                                    startYear: parseStartYear(tcm.anio_crecimiento)
                                });
                            }
                        });
                        productPeriods[productIdDom].sort((a, b) => a.startYear - b.startYear);
                    } else {
                        // Si no hay TCMs, añadir un período por defecto para que la tabla no esté totalmente vacía
                         const defaultStartYear = new Date().getFullYear() - 1;
                         productPeriods[productIdDom].push({ yearLabel: `${defaultStartYear}-${defaultStartYear + 1}`, startYear: defaultStartYear });
                    }


                    const newProductForm = document.createElement('div');
                    newProductForm.className = 'product-form';
                    newProductForm.id = `product_form_${productIdDom}`; // Añadir ID
                    newProductForm.dataset.productId = productIdDom;
                    
                    const productNameForTitle = producto.nombre_producto ? producto.nombre_producto : `Producto ${productCounter}`;

                    newProductForm.innerHTML = `
                        <button type="button" class="btn-danger delete-btn delete-product-btn" onclick="removeProduct(this)">Eliminar Producto</button>
                        <h4>${productNameForTitle} (Cargado)</h4>
                        <input type="hidden" name="products[${productIdDom}][id_temp]" value="${productIdDom}">
                        <input type="hidden" name="products[${productIdDom}][id_db]" value="${producto.id_producto || ''}">
                        <div class="form-group">
                            <label for="product_name_${productIdDom}">Nombre:</label>
                            <input type="text" id="product_name_${productIdDom}" name="products[${productIdDom}][name]" placeholder="Nombre del Producto" required oninput="updateAllCalculations()" value="${producto.nombre_producto || ''}">
                        </div>
                        <div class="form-group">
                            <label for="sales_${productIdDom}">Ventas Anuales:</label>
                            <input type="number" id="sales_${productIdDom}" name="products[${productIdDom}][sales]" placeholder="Ej: 1200" step="0.01" required oninput="updateAllCalculations()" value="${producto.ventas_anuales_producto || 0}">
                        </div>
                        
                        <h5>Crecimiento Histórico del Mercado (%)</h5>
                        <div class="product-period-controls">
                            <button type="button" class="btn-secondary add-product-period-btn" onclick="addProductPeriod('${productIdDom}')">+ Período</button>
                            <button type="button" class="btn-secondary remove-product-period-btn" onclick="removeProductPeriod('${productIdDom}')">- Período</button>
                            <span class="info-text product-period-info"></span>
                        </div>
                        <div class="growth-table-container" id="growth_table_container_${productIdDom}">
                            {{-- La tabla se renderizará aquí '''
                        </div>

                        <h5>Competidores</h5>
                        <div class="competitors-container" id="competitors_container_${productIdDom}">
                            <!-- Competidores existentes se agregarán aquí -->
                        </div>
                        <button type="button" class="btn-add" onclick="addCompetitor('${productIdDom}')" style="margin-top: 10px;">+ Añadir Competidor</button>
                    `;
                    
                    productsContainer.appendChild(newProductForm);
                    console.log(`Paso 4.${index + 1}: Formulario para producto ${productIdDom} añadido al DOM.`);

                    // Renderizar la tabla de crecimiento con los datos cargados
                    renderProductGrowthTable(productIdDom, producto.tcms);
                    updateProductPeriodControls(productIdDom);


                    const competitorsContainer = newProductForm.querySelector(`#competitors_container_${productIdDom}`);
                    if (producto.competidores && producto.competidores.length > 0) {
                        console.log(`Paso 5.${index + 1}: Cargando ${producto.competidores.length} competidores para ${productIdDom}.`);
                        producto.competidores.forEach((competidor, compIndex) => {
                            console.log(`Paso 5.${index + 1}.${compIndex + 1}: Añadiendo competidor:`, JSON.parse(JSON.stringify(competidor)));
                            addExistingCompetitorToProductUI(productIdDom, competidor, compIndex, competitorsContainer);
                        });
                    } else {
                        console.log(`Paso 5.${index + 1}: No hay competidores para ${productIdDom}.`);
                    }
                });

                console.log("Paso 6: Todos los productos procesados. Llamando a updateAllCalculations.");
                updateAllCalculations();
            } catch (error) { // Capturar errores
                console.error("Error en loadExistingProducts:", error);
                // Opcionalmente, mostrar un mensaje al usuario en la página
                productsContainer.innerHTML = '<p style=\"color: red;\">Error al cargar los productos. Revise la consola para más detalles.</p>';
            }
        }

        function collectData() {
            const productsData = [];
            const productForms = document.querySelectorAll('.product-form');
            
            productForms.forEach(form => {
                const productId = form.dataset.productId;
                const nameInput = form.querySelector(`input[name="products[${productId}][name]"]`);
                const salesInput = form.querySelector(`input[name="products[${productId}][sales]"]`);

                if (!nameInput || !salesInput || !nameInput.value) return; // Skip if essential data is missing

                const name = nameInput.value;
                const sales = parseFloat(salesInput.value) || 0;
                
                const historicalGrowth = [];
                form.querySelectorAll('.growth-input').forEach(input => {
                    const value = parseFloat(input.value);
                    if (!isNaN(value)) {
                        historicalGrowth.push(value);
                    }
                });

                const competitors = [];
                const competitorElements = form.querySelectorAll('.competitor-form');

                competitorElements.forEach(compForm => {
                    const compNameInput = compForm.querySelector(`input[name^="products[${productId}][competitors]"][name$="[name]"]`);
                    const compSalesInput = compForm.querySelector(`input[name^="products[${productId}][competitors]"][name$="[sales]"]`);
                    if (compNameInput && compSalesInput && compNameInput.value) {
                         competitors.push({
                            name: compNameInput.value,
                            sales: parseFloat(compSalesInput.value) || 0
                        });
                    }
                });

                productsData.push({ id: productId, name, sales, historicalGrowth, competitors });
            });
            return productsData;
        }

        function calculateTCM(historicalGrowth) {
            if (!historicalGrowth || historicalGrowth.length === 0) return 0;
            const sum = historicalGrowth.reduce((acc, val) => acc + val, 0);
            return sum / historicalGrowth.length;
        }

        function calculatePRM(productSales, competitors) {
            // console.log(`Calculating PRM for productSales: ${productSales}, competitors:`, JSON.parse(JSON.stringify(competitors)));

            if (!competitors || competitors.length === 0) {
                // console.log("No competitors listed, PRM = 1");
                // If no competitors are listed, standard interpretation can vary.
                // Returning 1 implies the product's sales are benchmarked against an implicit competitor of equal size,
                // or it holds a "neutral" relative position.
                return 1; 
            }
            
            // Extract sales figures, ensuring they are numbers. parseFloat || 0 in collectData helps.
            const competitorSalesValues = competitors.map(c => c.sales).filter(s => typeof s === 'number' && !isNaN(s));
            // console.log("Competitor sales values:", competitorSalesValues);

            let maxCompetitorSales = 0;
            if (competitorSalesValues.length > 0) {
                // Find the maximum sales among competitors.
                // Include 0 in Math.max in case all competitor sales are negative (highly unlikely for sales data).
                // If all actual sales are 0 or negative, maxCompetitorSales will be 0.
                maxCompetitorSales = Math.max(...competitorSalesValues, 0);
            }
            // console.log("Max competitor sales (>=0):", maxCompetitorSales);
            
            if (maxCompetitorSales === 0) {
                // This means no competitor has sales > 0 (or all listed competitors have 0 sales).
                // If the product itself has sales, its relative market share is infinitely large compared to these competitors.
                // If the product also has no sales, PRM could be 1 (no relative market share difference).
                // console.log("Max competitor sales is 0. ProductSales:", productSales);
                return productSales > 0 ? Infinity : 1; 
            }
            
            const prmValue = productSales / maxCompetitorSales;
            // console.log("Calculated PRM value:", prmValue);
            return prmValue;
        }

        function getBCGQuadrant(tcm, prm) {
            const tcmThreshold = 10; // Porcentaje
            const prmThreshold = 1;   // Ratio

            if (tcm >= tcmThreshold && prm >= prmThreshold) return 'Estrella';
            if (tcm >= tcmThreshold && prm < prmThreshold) return 'Interrogante';
            if (tcm < tcmThreshold && prm >= prmThreshold) return 'Vaca Lechera';
            return 'Perro';
        }

        function updateAllCalculations() {
            const products = collectData();
            const metricsTableBody = document.getElementById('metricsTable').querySelector('tbody');
            const bcgChart = document.getElementById('bcgChart');
            
            // Limpiar tabla y gráfico anteriores
            metricsTableBody.innerHTML = '';
            bcgChart.querySelectorAll('.product-bubble').forEach(bubble => bubble.remove());

            const totalSalesAllProducts = products.reduce((sum, p) => sum + p.sales, 0);

            products.forEach(product => {
                if (!product.name) return; // No procesar productos sin nombre

                const tcm = calculateTCM(product.historicalGrowth);
                const prm = calculatePRM(product.sales, product.competitors);
                const salesPercentage = totalSalesAllProducts > 0 ? (product.sales / totalSalesAllProducts) * 100 : 0;
                const quadrant = getBCGQuadrant(tcm, prm);

                // Actualizar tabla de métricas
                const row = metricsTableBody.insertRow();
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td>${product.sales.toFixed(2)}</td>
                    <td>${salesPercentage.toFixed(2)}%</td>
                    <td>${tcm.toFixed(2)}%</td>
                    <td>${prm.toFixed(2)}</td>
                    <td>${quadrant}</td>
                `;

                // Actualizar gráfico BCG
                const bubble = document.createElement('div');
                bubble.className = 'product-bubble';
                bubble.textContent = product.name.substring(0,3).toUpperCase(); // Abreviatura
                bubble.title = `${product.name}
TCM: ${tcm.toFixed(1)}%
PRM: ${prm.toFixed(1)}`;

                // Posicionamiento: PRM en eje X (invertido), TCM en eje Y (invertido)
                // PRM: Alto (>=1) a la derecha, Bajo (<1) a la izquierda
                // TCM: Alta (>=10) arriba, Baja (<10) abajo
                // El origen (0,0) del gráfico es top-left.
                // Eje X (PRM): 0% a 100% del ancho. 50% es PRM = 1.
                // Eje Y (TCM): 0% a 100% de la altura. 50% es TCM = 10%.

                // Mapeo de PRM a X:
                // PRM Alto (>=1) debe ir a la derecha (x > 50%)
                // PRM Bajo (<1) debe ir a la izquierda (x < 50%)
                let xPosPercent = 50; // Centro por defecto
                const prmVisualRange = 3; // Usaremos un rango para escalar el PRM, ej., de 0 a prmVisualRange+1.
                                          // prm = 1 es el centro. Si prm=4, es prmVisualRange unidades desde el centro.

                if (prm >= 1) { // Derecha del centro (Estrella, Vaca Lechera)
                    // Escalar (prm - 1) para que ocupe el 45% del espacio derecho.
                    // Ejemplo: si prmVisualRange es 3 (PRM de 1 a 4), entonces (prm-1) va de 0 a 3.
                    // Normalizamos dividiendo por prmVisualRange.
                    let offsetFactor = (prm - 1) / prmVisualRange;
                    xPosPercent = 50 + Math.min(offsetFactor * 45, 45);
                } else { // Izquierda del centro (Interrogante, Perro)
                    // prm está entre [0, 1)
                    // (1 - prm) va de (0, 1]. Si prm=0, (1-prm)=1. Si prm se acerca a 1, (1-pram) se acerca a 0.
                    // Normalizamos (no es estrictamente necesario si el rango es 1).
                    let offsetFactor = (1 - prm) / 1;
                    xPosPercent = 50 - Math.min(offsetFactor * 45, 45);
                }
                xPosPercent = Math.max(5, Math.min(95, xPosPercent)); // Clamping


                // Mapeo de TCM a Y: tcm > 20% (max) -> 0%, tcm=10% -> 50%, tcm=0% -> 100%
                let yPosPercent = 50; // Centro por defecto
                const tcmMax = 20; // Considerar un TCM máximo visual de 20%
                if (tcm >= 10) { // Arriba del centro (Estrella, Interrogante)
                     yPosPercent = 50 - Math.min( ( (tcm - 10) / (tcmMax - 10) ) * 45, 45);
                } else { // Abajo del centro (Vaca, Perro)
                     yPosPercent = 50 + Math.min( ( (10 - tcm) / 10 ) * 45, 45);
                }
                yPosPercent = Math.max(5, Math.min(95, yPosPercent)); // Clamping

                // Tamaño de la burbuja proporcional a las ventas (porcentaje sobre el total)
                const minBubbleSize = 20; // px
                const maxBubbleSize = 80; // px
                let bubbleSize = minBubbleSize + (salesPercentage / 100) * (maxBubbleSize - minBubbleSize);
                bubbleSize = Math.max(minBubbleSize, Math.min(maxBubbleSize, bubbleSize*2)); // Ajuste para mejor visibilidad

                bubble.style.width = `${bubbleSize}px`;
                bubble.style.height = `${bubbleSize}px`;
                bubble.style.left = `calc(${xPosPercent}% - ${bubbleSize / 2}px)`;
                bubble.style.top = `calc(${yPosPercent}% - ${bubbleSize / 2}px)`;
                
                // Color basado en cuadrante
                if (quadrant === 'Estrella') bubble.style.backgroundColor = '#2ecc71'; // Verde
                else if (quadrant === 'Interrogante') bubble.style.backgroundColor = '#3498db'; // Azul
                else if (quadrant === 'Vaca Lechera') bubble.style.backgroundColor = '#f1c40f'; // Amarillo
                else bubble.style.backgroundColor = '#e74c3c'; // Rojo

                bcgChart.appendChild(bubble);
            });
        }

        // Inicializar con un producto vacío si se desea, o dejar que el usuario añada el primero.
        // addProduct(); // Opcional: añadir un producto al cargar la página
        updateAllCalculations(); // Para asegurar que la tabla de métricas y el gráfico estén limpios al inicio si no hay productos.

    </script>
</body>
</html>

