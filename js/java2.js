function toggleFormulario() {
    let form = document.querySelector(".toggleForm"); // Encuentra el formulario
    let icon = document.querySelector(".toggleFormButton i"); // Encuentra el ícono del botón

    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block"; // 🔥 Muestra el formulario
        icon.classList.remove("fa-plus");
        icon.classList.add("fa-minus");
    } else {
        form.style.display = "none"; // ❌ Oculta el formulario
        icon.classList.remove("fa-minus");
        icon.classList.add("fa-plus");
    }
}
