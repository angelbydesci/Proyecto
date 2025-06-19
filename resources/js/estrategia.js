document.addEventListener('DOMContentLoaded', function () {
    const proyectoId = document.getElementById('proyecto_id').value;
    const guardarBtn = document.getElementById('guardar-estrategias-btn');

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

    // Event listener para el botón de guardar todo
    guardarBtn.addEventListener('click', async function () {
        const matricesData = {
            ofensiva: {},
            defensiva: {},
            reorientacion: {},
            supervivencia: {},
        };

        document.querySelectorAll('.estrategia-container select').forEach(select => {
            const matriz = select.dataset.matriz;
            const celda = select.dataset.celda;
            const valor = parseInt(select.value, 10);
            if (matricesData[matriz]) {
                matricesData[matriz][celda] = valor;
            }
        });

        this.disabled = true;
        this.textContent = 'Guardando...';

        try {
            const response = await fetch('/estrategia/guardar-todo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    proyecto_id: proyectoId,
                    matrices: matricesData
                })
            });

            const result = await response.json();

            if (response.ok && result.success) {
                alert('¡Estrategias guardadas con éxito!');
            } else {
                throw new Error(result.message || 'Error al guardar los datos.');
            }

        } catch (error) {
            console.error('Error en la petición AJAX:', error);
            alert('Error: ' + error.message);
        } finally {
            this.disabled = false;
            this.textContent = 'Guardar Todos los Cambios';
        }
    });

    // Calcular totales iniciales y añadir listeners para recalcular en cada cambio
    const estrategiaContainers = document.querySelectorAll('.estrategia-container');
    estrategiaContainers.forEach(container => {
        // Calcular totales al cargar la página
        calcularTotales(container);

        // Añadir listeners para cambios
        container.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', () => {
                const matrizContainer = select.closest('.estrategia-container');
                calcularTotales(matrizContainer);
            });
        });
    });
});
