$(document).ready(function() {
  $(".toggleFormButton").click(function() {
      var form = $(this).closest(".container").find(".toggleForm"); // Buscar el formulario dentro del contenedor
      form.slideToggle(); // Alternar visibilidad del formulario

      var icon = $(this).find("i"); // Buscar ícono dentro del botón
      if (icon.hasClass("fa-plus")) {
          icon.removeClass("fa-plus").addClass("fa-minus"); // Cambia de '+' a '-'
      } else {
          icon.removeClass("fa-minus").addClass("fa-plus"); // Cambia de '-' a '+'
      }
  });

  // Verifica si el formulario tiene datos cargados y asegúrate de que esté visible
  $(".toggleForm").each(function() {
      if ($(this).find("input[name='nomdom']").val() !== "") {
          $(this).show(); // Muestra el formulario si tiene datos
          $(this).closest(".container").find(".toggleFormButton i")
              .removeClass("fa-plus").addClass("fa-minus"); // Cambia el ícono
      }
  });
});
