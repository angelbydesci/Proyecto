document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reflexionForm');
    
    // Se elimina toda la lógica de cálculo de JavaScript.
    // El guardado de la posición de los botones se maneja a través del envío del formulario estándar
    // y la recarga de la página con los valores desde el backend.

    // Ejemplo de cómo podrías añadir listeners a los radios si fuera necesario para alguna otra funcionalidad futura,
    // pero para el simple guardado y recarga, no es estrictamente necesario aquí.
    if (form) {
        const radios = form.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Podrías hacer algo aquí si necesitas reaccionar a los cambios antes de enviar,
                // pero para el caso actual, el submit del formulario es suficiente.
                // console.log('Radio button changed:', this.name, this.value);
            });
        });
    }
});
