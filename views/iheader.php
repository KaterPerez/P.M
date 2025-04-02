<div class="container">
    <nav class="navbar navbar-expand-lg">
        <img src="img/PM-removebg-preview.jpg" width="250px" height="100px">
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" id="ingmod" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?pg=1896">Precio</a></li>
            </ul>
        </div>
        
        <!-- Botón para abrir el modal de Registro -->
        <button type="button" class="btn btn-dark mx-2" data-bs-toggle="modal" data-bs-target="#registerModal">
            Registrar
        </button>

        <!-- Botón para abrir el modal de Inicio de Sesión -->
        <button type="button" class="btn btn-dark mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">
            Iniciar sesión
        </button>
    </nav> 
</div>  
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title w-100 text-center" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="models/validacion.php" method="POST">
                    <div class="mb-3">
                        <label for="usu" class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" class="form-control" name="usu" id="usu" placeholder="Correo Electrónico" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="con" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" name="con" id="con" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-dark w-100">Ingresar</button>
                        </div>
                        <div class="col-6">
                            <a href="index.php?pg=205" class="btn btn-outline-dark w-100 text-center">Olvidó su contraseña</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Registro -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title w-100 text-center" id="registerModalLabel">Registrarse</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
            <form id="registerForm">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombres</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <input type="text" class="form-control" name="apellidos" id="apellidos" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
            <input type="tel" class="form-control" name="telefono" id="telefono" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Selecciona tu perfil</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-user-graduate"></i></span>
            <select class="form-select" name="perfil" id="perfil" required>
                <option value="">Seleccione...</option>
                <option value="4">Estudiante</option>
                <option value="3">Profesor</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
    </div>
    <div class="mb-3 text-center">
        <div class="g-recaptcha" data-sitekey="6LeAIwcrAAAAAP4UZ5Ajm_bzmwlptCQfIkOfbNpA"></div>
    </div>
    <button type="submit" class="btn btn-dark w-100">Registrarse</button>
</form>

<!-- Mensaje de respuesta -->
<div id="registerMessage" class="mt-3 text-center"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Link a FontAwesome para los iconos -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        console.log("jQuery está funcionando");

        $("#registerForm").submit(function (event) {
            event.preventDefault();
            console.log("Botón de registro clickeado");

            $.ajax({
                url: "controllers/cres.php",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    if (response.status === "success") {
                        $("#registerMessage").html('<div class="alert alert-success">' + response.message + '</div>');
                        $("#registerForm")[0].reset();
                        setTimeout(() => { $("#registerModal").modal("hide"); }, 2000);
                    } else {
                        $("#registerMessage").html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error en AJAX:", xhr.responseText);
                    $("#registerMessage").html('<div class="alert alert-danger">Error en la solicitud AJAX.</div>');
                }
            });
        });
    })
    $(document).ready(function () {
    console.log("jQuery está funcionando");

    $("#registerForm").submit(function (event) {
        event.preventDefault();
        console.log("Botón de registro clickeado");

        // Obtener la respuesta del reCAPTCHA
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            $("#registerMessage").html('<div class="alert alert-danger">⚠️ Por favor, verifica el reCAPTCHA.</div>');
            return; // Detener el envío del formulario
        }

        // Enviar el formulario con AJAX
        $.ajax({
            url: "controllers/cres.php",
            type: "POST",
            data: $(this).serialize(), // Enviar los datos del formulario, incluyendo reCAPTCHA
            dataType: "json",
            success: function (response) {
                console.log("Respuesta del servidor:", response);

                if (response.status === "success") {
                    $("#registerMessage").html('<div class="alert alert-success">✅ ' + response.message + '</div>');
                    $("#registerForm")[0].reset(); // Resetear formulario
                    grecaptcha.reset(); // Resetear reCAPTCHA después del registro exitoso
                    setTimeout(() => { $("#registerModal").modal("hide"); }, 2000); // Cerrar modal después de 2 segundos
                } else {
                    $("#registerMessage").html('<div class="alert alert-danger">❌ ' + response.message + '</div>');
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en AJAX:", xhr.responseText);
                $("#registerMessage").html('<div class="alert alert-danger">❌ Error en la solicitud AJAX.</div>');
            }
        });
    });
});
</script>

<style>
    .btn-close-white {
        background-color: transparent;
        box-shadow: none;
        opacity: 1;
    }
    .modal .btn-close-white:hover {
        background-color: white !important; 
        color: black !important; 
        border: 1px solid black; 
    }
</style>
