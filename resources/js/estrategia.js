document.addEventListener('DOMContentLoaded', function () {
    const proyectoId = document.getElementById('proyecto_id').value;

    // Función para calcular y actualizar los totales de una matriz
    function calcularTotales(matrizContainer) {
        const table = matrizContainer.querySelector('.matriz-table');
        if (!table) return;

        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr:not(:last-child)');
        const totalCols = table.querySelector('thead th:not(:first-child):not(:last-child)').parentNode.children.length - 2;

        let granTotal = 0;

        // Calcular totales horizontales (filas)
        rows.forEach(row => {
            let totalHorizontal = 0;
            const selects = row.querySelectorAll('select');
            selects.forEach(select => {
                totalHorizontal += parseInt(select.value, 10);
            });
            row.querySelector('.total-horizontal').textContent = totalHorizontal;
            granTotal += totalHorizontal;
        });

        // Calcular totales verticales (columnas)
        const totalVerticalCells = tbody.querySelector('tr:last-child').querySelectorAll('.total-vertical');
        for (let j = 0; j < totalCols; j++) {
            let totalVertical = 0;
            rows.forEach(row => {
                const select = row.querySelectorAll('select')[j];
                if (select) {
                    totalVertical += parseInt(select.value, 10);
                }
            });
            totalVerticalCells[j].textContent = totalVertical;
        }

        // Actualizar el gran total de la matriz
        const matrizId = matrizContainer.id.split('-')[1]; // ofensiva, defensiva, etc.
        const totalGeneralCell = document.getElementById(`total-${matrizId}`);
        if (totalGeneralCell) {
            totalGeneralCell.textContent = granTotal;
        }

        // Actualizar la tabla de síntesis
        const sintesisCell = document.getElementById(`sintesis-${matrizId}`);
        if (sintesisCell) {
            sintesisCell.textContent = granTotal;
        }
    }

    // Función para guardar el valor de una celda en la BD
    async function guardarCelda(matriz, celda, valor) {
        try {
            const response = await fetch('/estrategia/guardar', {
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
            });

            if (!response.ok) {
                throw new Error('Error al guardar los datos.');
            }

            const data = await response.json();
            // console.log(data.message);

        } catch (error) {
            console.error('Error en la petición AJAX:', error);
        }
    }

    // Añadir event listeners a todos los selects y calcular totales iniciales
    const estrategiaContainers = document.querySelectorAll('.estrategia-container');
    estrategiaContainers.forEach(container => {
        // Calcular totales al cargar la página
        calcularTotales(container);

        // Añadir listeners para cambios
        container.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', (event) => {
                const selectCambiado = event.target;
                const matriz = selectCambiado.dataset.matriz;
                const celda = selectCambiado.dataset.celda;
                const valor = selectCambiado.value;

                // Guardar el cambio en la base de datos
                guardarCelda(matriz, celda, valor);

                // Recalcular los totales para la matriz afectada
                const matrizContainer = selectCambiado.closest('.estrategia-container');
                calcularTotales(matrizContainer);
            });
        });
    });
});
