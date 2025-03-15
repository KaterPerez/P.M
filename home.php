<?php
    include("models/seguridad.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $nomusu = isset($_SESSION["nomusu"]) ? $_SESSION["nomusu"]:NULL;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="js/jlisin.js">
    <link rel="shortcut icon" href="img/Captura_de_pantalla_2024-11-19_142729-removebg-preview.png">
    <script type="text/javascript" src="js/java2.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>
    <?php
        include("models/conexion.php");
	    $pg= isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL; 
    ?>
    <header>
        <?php include("views/hheader.php") ?>
    </header>
    <div class="homeall">
    <section> 
        <?php include("views/menu.php");?>
    </section >

    <div class="fj">
    <?php
        if (function_exists('cod')) {
            $rut = cod($pg);
            if ($rut && isset($rut[0]['rutpag']) && !empty($rut[0]['rutpag'])) {
                // Incluir la ruta si existe y no está vacía
                include($rut[0]['rutpag']);
            } else {
                // Mensaje de error si no hay permisos o la ruta está vacía
                echo "<br><br><br><br><br><br><br>
                    <h3 style='color: white;'>No tiene permisos para ingresar a este sitio.</h3>
                    <p style='color: white;'>Parámetro pg: $pg</p>
                    <p style='color: white;'>ID de perfil: " . $_SESSION['codper'] . "</p>
                    <br><br><br><br><br><br><br>";
            }
        } else {
            echo "<br><br><br><br><br><br><br><h3>La función cod() no está definida.</h3><br><br><br><br><br><br><br>";
        }
        ?>
    </div>
    </div>
</body>
</html>