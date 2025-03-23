<?php
include_once(__DIR__ . '/../models/mper.php');
include_once(__DIR__ . '/../controllers/optimg.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Instancia de la clase
$mper = new Mper();

// Variables de sesión y solicitud
$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL;
$numdoc = isset($_POST['numdoc']) ? $_POST['numdoc'] : NULL;
$tipdoc = isset($_POST['tipdoc']) ? $_POST['tipdoc'] : NULL;
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$apeusu = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL;
$telusu = isset($_POST['telusu']) ? $_POST['telusu'] : NULL;
$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu'] : NULL;
$dirusu = isset($_POST['dirusu']) ? $_POST['dirusu'] : NULL;
$edausu = isset($_POST['edausu']) ? $_POST['edausu'] : NULL;
$genusu = isset($_POST['genusu']) ? $_POST['genusu'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$fotper = isset($_FILES['fotper']) ? $_FILES['fotper'] : NULL;

// Procesar archivo de imagen
if ($fotper) {
    $ruta_fotper = opti($fotper, 'fotper', 'fotos', date('YmdHis'));
} else {
    $ruta_fotper = NULL; // No se recibió archivo
}

// Guardar o Editar
if ($ope == "save") {
    // Siempre se procesan todos los datos recibidos
    $mper->setIdusu($idusu);
    $mper->setNumdoc($numdoc);
    $mper->setTipdoc($tipdoc);
    $mper->setNomusu($nomusu);
    $mper->setApeusu($apeusu);
    $mper->setTelusu($telusu);
    $mper->setPasusu($pasusu);
    $mper->setDirusu($dirusu);
    $mper->setEdausu($edausu);
    $mper->setGenusu($genusu);

    // Solo actualiza fotper si existe una imagen procesada
    if ($ruta_fotper) {
        $mper->setFotper($ruta_fotper);
    }

    try {
        if ($idusu) {
            $mper->edit(); // Edita el usuario si ya existe
        } else {
            $mper->save(); // Crea un nuevo usuario si no existe
        }
    } catch (Exception $e) {
        error_log("Error al guardar los datos: " . $e->getMessage());
    }
}

// Obtener datos del usuario
if ($idusu) {
    $dtOne = $mper->getOne($idusu);
} else {
    $dtOne = NULL;
}
?>