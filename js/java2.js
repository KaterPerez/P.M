function toggleFormulario() {
    var form = document.querySelector(".toggleForm");
    var icon = document.querySelector(".toggleFormButton i");

    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block"; // Mostrar formulario
        icon.classList.remove("fa-plus");
        icon.classList.add("fa-minus");
    } else {
        form.style.display = "none"; // Ocultar formulario
        icon.classList.remove("fa-minus");
        icon.classList.add("fa-plus");
    }
}

// Si el usuario está editando (URL tiene 'opera=edi'), mostrar el formulario automáticamente
document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector(".toggleForm");
    var icon = document.querySelector(".toggleFormButton i");

    if (form) {
        // Obtener parámetros de la URL
        var urlParams = new URLSearchParams(window.location.search);
        var isEditing = urlParams.get("ope") === "edi";

        if (isEditing) {
            form.style.display = "block";
            icon.classList.remove("fa-plus");
            icon.classList.add("fa-minus");
        } else {
            form.style.display = "none"; // Ocultar si no está en modo edición
            icon.classList.remove("fa-minus");
            icon.classList.add("fa-plus");
        }
    }
});

