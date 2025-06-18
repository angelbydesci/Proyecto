document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.estrategia-container input[type="number"]');
    const proyecto_id = document.getElementById('proyecto_id').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function calcularTotales(matrizContainer) {
        const totalsVerticales = matrizContainer.querySelectorAll('.total-vertical');
        const inputs = matrizContainer.querySelectorAll('input[type="number"]');
        let sumatoriaTotal = 0;

        for (let j = 0; j < 4; j++) {
            let sumaVertical = 0;
            for (let i = 0; i < 4; i++) {
                const input = inputs[i * 4 + j];
                sumaVertical += parseInt(input.value, 10) || 0;
            }
            totalsVerticales[j].textContent = sumaVertical;
            sumatoriaTotal += sumaVertical;
        }
        
        const totalMatriz = matrizContainer.querySelector('[id^="total-"]');
        totalMatriz.textContent = sumatoriaTotal;

        // Actualizar tabla de síntesis
        const matrizId = matrizContainer.id.split('-')[1]; // ofensiva, defensiva, etc.
        let filaSintesis;
        if (matrizId === 'ofensiva') filaSintesis = document.querySelector('.sintesis-resultados tbody tr:nth-child(1)');
        if (matrizId === 'defensiva') filaSintesis = document.querySelector('.sintesis-resultados tbody tr:nth-child(2)');
        if (matrizId === 'supervivencia') filaSintesis = document.querySelector('.sintesis-resultados tbody tr:nth-child(3)');
        if (matrizId === 'reorientacion') filaSintesis = document.querySelector('.sintesis-resultados tbody tr:nth-child(4)');
        
        if(filaSintesis) {
            filaSintesis.querySelector('td:nth-child(3)').textContent = sumatoriaTotal;
        }
    }

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            let value = parseInt(this.value, 10);

            if (isNaN(value) || value < 0) {
                this.value = 0;
            } else if (value > 4) {
                this.value = 4;
            }
            value = parseInt(this.value, 10);

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
