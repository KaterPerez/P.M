<?php
require_once 'models/conexion.php';

// Verificar si se envió el formulario de recuperación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    restablecerContrasena($email);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 border rounded-4 shadow p-5">
            <form action="controllers/cmail.php" method="POST">
                <h2 class="text-center mb-4">Recuperar Contraseña</h2>
                <p class="text-center mb-4">
                    Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                </p>

                <input type="hidden" name="accion" value="recuperar">
                
                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="correo@ejemplo.com" required>
                </div>
                
                <!-- Botón Enviar -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .border {
        border-color: #000; /* Mantiene solo la línea de borde */
    }
    .bg-light {
        background-color: transparent !important; /* Quita el fondo blanco */
    }
</style>



    <script>
        // Redirigir si el token es válido
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('token')) {
            window.location.href = `cambiar_contrasena.php?token=${urlParams.get('token')}`;
        }
    </script>
</body>
</html>
