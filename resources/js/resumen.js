document.addEventListener('DOMContentLoaded', function () {
    const btnGuardarPdf = document.getElementById('btn-guardar-pdf');
    if (btnGuardarPdf) {
        btnGuardarPdf.addEventListener('click', function () {
            // Ocultar el botón para que no aparezca en el PDF
            btnGuardarPdf.style.display = 'none';

            const element = document.getElementById('resumen-container');
            const nombreProyecto = element.querySelector('.info-value').textContent.trim() || 'resumen-proyecto';
            
            const opt = {
                margin:       0.5,
                filename:     `${nombreProyecto.replace(/ /g, '_')}.pdf`,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] } // Evita cortes en medio de elementos
            };

            // Usar la promesa para volver a mostrar el botón después de guardar
            html2pdf().set(opt).from(element).save().then(() => {
                // Volver a mostrar el botón
                btnGuardarPdf.style.display = 'block';
            });
        });
    }
});
