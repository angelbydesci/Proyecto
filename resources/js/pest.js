class PestAnalysis {
    constructor() {
        this.form = document.querySelector('.pest-form');
        this.chart = null;
        this.data = window.pestData || {};
        
        this.init();
    }

    init() {
        this.prefillForm();
        this.initChart();
        this.setupEventListeners();
    }

    prefillForm() {
        if (!this.form) return;

        if (this.data.pestData) {
            this.prefillFromObject(this.data.pestData);
        }
        else if (this.data.oldInput) {
            this.prefillFromObject(this.data.oldInput);
        }
    }

    prefillFromObject(data) {
        for (let i = 1; i <= 25; i++) {
            const fieldName = `pregunta${i}`;
            if (data[fieldName] !== undefined) {
                const radios = this.form.querySelectorAll(`input[name="${fieldName}"]`);
                radios.forEach(radio => {
                    if (radio.value == data[fieldName]) {
                        radio.checked = true;
                    }
                });
            }
        }
    }

    initChart() {
        const ctx = document.getElementById('pestChart');
        if (!ctx) {
            console.error('No se encontró el elemento canvas para el gráfico');
            return;
        }

        // Verificar si Chart está disponible
        if (typeof Chart === 'undefined') {
            console.error('Chart.js no está cargado correctamente');
            return;
        }

        // Datos iniciales neutrales (50%)
        const initialData = {
            labels: ['Sociales', 'Ambientales', 'Políticos', 'Económicos', 'Tecnológicos'],
            datasets: [{
                label: 'Impacto (%)',
                data: [50, 50, 50, 50, 50],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: initialData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Porcentaje de Impacto'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Factores PEST'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y.toFixed(1) + '%';
                            }
                        }
                    }
                }
            }
        };

        this.chart = new Chart(ctx, config);
        
        // Actualizar con datos reales si existen
        this.updateChartWithRealData();
    }

    updateChartWithRealData() {
        if (!this.chart || !this.data.pestData) return;

        // Obtener puntajes de cada categoría
        const scores = {
            sociales: parseInt(this.data.pestData.RFSociales) || 0,
            ambientales: parseInt(this.data.pestData.RFAmbientales) || 0,
            politicos: parseInt(this.data.pestData.RFPoliticos) || 0,
            economicos: parseInt(this.data.pestData.RFEconomicos) || 0,
            tecnologicos: parseInt(this.data.pestData.RFTecnologicos) || 0
        };

        console.log('Puntajes obtenidos:', scores);

        // Calcular porcentajes (asumiendo máximo de 20 puntos por categoría)
        // 5 preguntas × máximo 4 puntos cada una = 20 puntos máximo
        const maxScorePerCategory = 20;
        const percentages = [
            (scores.sociales / maxScorePerCategory) * 100,
            (scores.ambientales / maxScorePerCategory) * 100,
            (scores.politicos / maxScorePerCategory) * 100,
            (scores.economicos / maxScorePerCategory) * 100,
            (scores.tecnologicos / maxScorePerCategory) * 100
        ];

        console.log('Porcentajes calculados:', percentages);

        // Actualizar gráfico
        this.chart.data.datasets[0].data = percentages;
        this.chart.update();
    }

    setupEventListeners() {
        // Validación de radios (opcional)
    }
}

// Asegurarse de que Chart.js esté cargado antes de inicializar
function checkChartJsAndInitialize() {
    if (typeof Chart !== 'undefined') {
        new PestAnalysis();
    } else {
        setTimeout(checkChartJsAndInitialize, 100);
    }
}

document.addEventListener('DOMContentLoaded', checkChartJsAndInitialize);