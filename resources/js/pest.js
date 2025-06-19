class PestCssChart {
    constructor() {
        this.form = document.querySelector('.pest-form');
        this.data = window.pestData || {};
        this.chartContainer = document.getElementById('pestChartContainer');

        this.init();
    }

    init() {
        this.updateChartWithInitialData();
        this.setupEventListeners();
    }

    updateChartWithInitialData() {
        const pestData = this.data.pestData;

        // Prioriza los puntajes finales si existen en los datos de la BD.
        if (pestData && pestData.RFSociales !== undefined) {
            const scores = {
                social: pestData.RFSociales,
                ambiental: pestData.RFAmbientales,
                politico: pestData.RFPoliticos,
                economico: pestData.RFEconomicos,
                tecnologico: pestData.RFTecnologicos,
            };
            this.updateChartBars(scores);
        } else {
            // Si no hay datos guardados, calcula desde el formulario (probablemente todo a 0)
            this.updateChartFromForm();
        }
    }

    setupEventListeners() {
        if (!this.form) return;

        // Actualiza el gráfico cada vez que se cambia una opción del formulario.
        this.form.addEventListener('change', () => {
            this.updateChartFromForm();
        });
    }

    calculateScoresFromForm() {
        const scores = {
            social: { total: 0, count: 0 },
            ambiental: { total: 0, count: 0 },
            politico: { total: 0, count: 0 },
            economico: { total: 0, count: 0 },
            tecnologico: { total: 0, count: 0 },
        };

        // Itera sobre las 25 preguntas para calcular los puntajes.
        for (let i = 1; i <= 25; i++) {
            const fieldName = `pregunta${i}`;
            const checkedRadio = this.form.querySelector(`input[name="${fieldName}"]:checked`);
            
            if (checkedRadio) {
                const value = parseInt(checkedRadio.value, 10);
                if (!isNaN(value)) {
                    if (i >= 1 && i <= 5) { // Sociales
                        scores.social.total += value;
                        scores.social.count++;
                    } else if (i >= 21 && i <= 25) { // Ambientales
                        scores.ambiental.total += value;
                        scores.ambiental.count++;
                    } else if (i >= 6 && i <= 10) { // Políticos
                        scores.politico.total += value;
                        scores.politico.count++;
                    } else if (i >= 11 && i <= 15) { // Económicos
                        scores.economico.total += value;
                        scores.economico.count++;
                    } else if (i >= 16 && i <= 20) { // Tecnológicos
                        scores.tecnologico.total += value;
                        scores.tecnologico.count++;
                    }
                }
            }
        }

        // Calcula el porcentaje para cada factor. El puntaje máximo por pregunta es 4.
        return {
            social: scores.social.count > 0 ? (scores.social.total / (scores.social.count * 4)) * 100 : 0,
            ambiental: scores.ambiental.count > 0 ? (scores.ambiental.total / (scores.ambiental.count * 4)) * 100 : 0,
            politico: scores.politico.count > 0 ? (scores.politico.total / (scores.politico.count * 4)) * 100 : 0,
            economico: scores.economico.count > 0 ? (scores.economico.total / (scores.economico.count * 4)) * 100 : 0,
            tecnologico: scores.tecnologico.count > 0 ? (scores.tecnologico.total / (scores.tecnologico.count * 4)) * 100 : 0,
        };
    }

    updateChartFromForm() {
        const scores = this.calculateScoresFromForm();
        this.updateChartBars(scores);
    }

    updateChartBars(scores) {
        if (!this.chartContainer) return;

        for (const factor in scores) {
            const barElement = this.chartContainer.querySelector(`#bar-${factor}`);
            if (barElement) {
                // Asegura que el porcentaje esté entre 0 y 100.
                const percentage = Math.min(100, Math.max(0, scores[factor])); 
                barElement.style.height = `${percentage}%`;
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new PestCssChart();
});