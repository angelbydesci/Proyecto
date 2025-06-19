document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('.estrategia-container select');
    const proyecto_id = document.getElementById('proyecto_id').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function calcularTotales(matrizContainer) {
        const totalsHorizontales = matrizContainer.querySelectorAll('.total-horizontal');
        const totalsVerticales = matrizContainer.querySelectorAll('.total-vertical');
        const selects = matrizContainer.querySelectorAll('tbody select');
        let sumatoriaTotal = 0;

        // Calcular totales horizontales
        for (let i = 0; i < 4; i++) {
            let sumaHorizontal = 0;
            for (let j = 0; j < 4; j++) {
                const select = selects[i * 4 + j];
                if (select) {
                    sumaHorizontal += parseInt(select.value, 10) || 0;
                }
            }
            if (totalsHorizontales[i]) {
                totalsHorizontales[i].textContent = sumaHorizontal;
            }
        }

        // Calcular totales verticales
        for (let j = 0; j < 4; j++) {
            let sumaVertical = 0;
            for (let i = 0; i < 4; i++) {
                const select = selects[i * 4 + j];
                if (select) {
                    sumaVertical += parseInt(select.value, 10) || 0;
                }
            }
            if (totalsVerticales[j]) {
                totalsVerticales[j].textContent = sumaVertical;
            }
        }
        
        sumatoriaTotal = Array.from(selects).reduce((acc, select) => acc + (parseInt(select.value, 10) || 0), 0);

        const totalMatriz = matrizContainer.querySelector('[id^="total-"]');
        if (totalMatriz) {
            totalMatriz.textContent = sumatoriaTotal;
        }

        // Actualizar tabla de síntesis
        const matrizId = matrizContainer.id.replace('matriz-', '');
        const sintesisCell = document.getElementById(`sintesis-${matrizId}`);
        if (sintesisCell) {
            sintesisCell.textContent = sumatoriaTotal;
        }
    }

    selects.forEach(select => {
        select.addEventListener('change', function() {
            let value = parseInt(this.value, 10) || 0;

            const matriz = this.dataset.matriz;
            const celda = this.dataset.celda;

            fetch('/estrategia/storeOrUpdate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    proyecto_id: proyecto_id,
                    matriz: matriz,
                    celda: celda,
                    valor: value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const matrizContainer = this.closest('.estrategia-container');
                    calcularTotales(matrizContainer);
                } else {
                    console.error('Error al guardar:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Calcular totales iniciales al cargar la página
    document.querySelectorAll('.estrategia-container').forEach(container => {
        calcularTotales(container);
    });
});
