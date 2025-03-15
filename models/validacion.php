<?php
session_start();  // Asegúrate de que esto esté al principio de tu archivo

include("../models/conexion.php");

$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$con = isset($_POST['con']) ? $_POST['con'] : NULL;

if ($usu && $con) {
    validar($usu, $con);
} else {
    header("Location: ../index.php?pg=300&error=ok");
    exit; // Detener la ejecución si los datos no están presentes
}

function validar($usu, $con) {
    $res = verdat($usu, $con);

    if ($res) {
        $_SESSION["idusu"] = $res[0]["idusu"];
        $_SESSION["nomusu"] = $res[0]["nomusu"];
        $_SESSION["codper"] = isset($res[0]["codper"]) ? $res[0]["codper"] : null;
        $_SESSION["aut"] = "jY238Jn&5Hhass.??44aa@@fg(80";

        if (is_numeric($_SESSION['codper']) && $_SESSION['codper'] > 0) {
            header('Location: ../home.php');
            exit(); // Detener la ejecución después de la redirección
        }
    } else {
        header("Location: ../index.php?pg=300&error=ok");
        exit; // Detener la ejecución si la validación falla
    }
}

function verdat($usu, $con) {
    $pas = sha1(md5($con));
    $sql = "SELECT u.idusu, u.pasusu, u.nomusu, u.apeusu, u.corusu, u.actusu, u.codper, f.pagini FROM usuario AS u 
            INNER JOIN perfil AS f ON u.codper=f.codper WHERE u.actusu = 1 AND u.corusu=:usu AND u.pasusu=:con";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(':usu', $usu);
    $result->bindParam(':con', $pas);
    $result->execute();
    return $result->fetchAll(PDO::FETCH_ASSOC);
}
?>
