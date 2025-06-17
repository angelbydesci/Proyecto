document.addEventListener('DOMContentLoaded', function () {
    const addProjectBtn = document.getElementById('add-project-btn');
    const addProjectForm = document.getElementById('add-project-form');
    const cancelAddProjectBtn = document.getElementById('cancel-add-project');
    const selectProjectLink = document.getElementById('select-project-link');

    if (addProjectBtn) {
        addProjectBtn.addEventListener('click', function () {
            if (addProjectForm) {
                addProjectForm.classList.toggle('active');
            }
        });
    }

    if (cancelAddProjectBtn) {
        cancelAddProjectBtn.addEventListener('click', function () {
            if (addProjectForm) {
                addProjectForm.classList.remove('active');
            }
        });
    }

    if (selectProjectLink) {
        selectProjectLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevenir la navegación por defecto del enlace
            const selectedProjectInput = document.querySelector('input[name="selected_project"]:checked');
            if (selectedProjectInput) {
                const projectId = selectedProjectInput.value;
                // Construir la URL dinámicamente.
                // La ruta 'dashboard2' ahora espera un parámetro de proyecto.
                window.location.href = `/dashboard2/${projectId}`;
            } else {
                alert('Por favor, seleccione un proyecto.');
            }
        });
    }
});
