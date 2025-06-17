class PorterDiagnostic {
    constructor() {
        this.form = document.getElementById('porterForm');
        this.puntajeInput = document.getElementById('puntaje');
        this.conclusionTextarea = document.getElementById('conclusion');
        this.radioGroups = [];
        this.data = window.porterData || {};
        
        this.init();
    }

    init() {
        this.createRadioGroups();
        this.setupEventListeners();
        this.prefillForm();
        this.calculatePuntaje();
    }

    createRadioGroups() {
        for (let i = 1; i <= 17; i++) {
            const group = this.form.querySelectorAll(`input[name="pregunta${i}"]`);
            if (group.length > 0) {
                this.radioGroups.push(group);
            }
        }
    }

    setupEventListeners() {
        this.radioGroups.forEach(group => {
            group.forEach(radio => {
                radio.addEventListener('change', () => this.calculatePuntaje());
            });
        });
    }

    calculatePuntaje() {
        let totalPuntaje = 0;
        
        this.radioGroups.forEach(group => {
            const checkedRadio = Array.from(group).find(radio => radio.checked);
            if (checkedRadio) {
                totalPuntaje += parseInt(checkedRadio.value, 10);
            }
        });
        
        this.puntajeInput.value = totalPuntaje;
        this.updateConclusion(totalPuntaje);
    }

    updateConclusion(puntaje) {
        let conclusion = '';
        
        if (puntaje >= 17 && puntaje <= 29) {
            conclusion = "Estamos en un mercado altamente competitivo, en el que es muy difícil hacerse un hueco en el mercado.";
        } 
        else if (puntaje >= 30 && puntaje <= 44) {
            conclusion = "Estamos en un mercado de competitividad relativamente alta, pero con ciertas modificaciones en el producto y la política comercial de la empresa, podría encontrarse un nicho de mercado.";
        } 
        else if (puntaje >= 45 && puntaje <= 59) {
            conclusion = "La situación actual del mercado es favorable a la empresa.";
        } 
        else if (puntaje >= 60 && puntaje <= 85) {
            conclusion = "Estamos en una situación excelente para la empresa.";
        }
        
        this.conclusionTextarea.value = conclusion;
    }

    prefillForm() {
        // Prefill from autodiagnosticoPorter
        if (this.data.autodiagnosticoPorter) {
            this.prefillFromObject(this.data.autodiagnosticoPorter);
        }
        // Prefill from old input (validation errors)
        else if (this.data.oldInput) {
            this.prefillFromObject(this.data.oldInput);
        }

        // Prefill FODA sections
        this.prefillFODA();
    }

    prefillFromObject(data) {
        Object.entries(data).forEach(([key, value]) => {
            if (key.startsWith('pregunta') && value !== null) {
                const radios = this.form.querySelectorAll(`input[name="${key}"]`);
                radios.forEach(radio => {
                    if (radio.value == value) {
                        radio.checked = true;
                    }
                });
            }
        });
    }

    prefillFODA() {
        // Prefill oportunidades
        if (this.data.oportunidades) {
            for (let i = 1; i <= 2; i++) {
                const textarea = document.getElementById(`oportunidad${i}`);
                if (textarea && this.data.oportunidades[`oportunidad${i}`]) {
                    textarea.value = this.data.oportunidades[`oportunidad${i}`].trim();
                }
            }
        }

        // Prefill amenazas
        if (this.data.amenazas) {
            for (let i = 1; i <= 2; i++) {
                const textarea = document.getElementById(`amenaza${i}`);
                if (textarea && this.data.amenazas[`amenaza${i}`]) {
                    textarea.value = this.data.amenazas[`amenaza${i}`].trim();
                }
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new PorterDiagnostic();
});