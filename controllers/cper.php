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

$fotper = isset($_FILES['fotper']) ? $_FILES['fotper'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
// Procesar archivo de imagen
if ($fotper) {
    $ruta_fotper = opti($fotper, 'fotper', 'fotos', date('YmdHis'));
} else {
    $ruta_fotper = NULL; // No se recibió archivo
}

if ($ope == "save") {
    $mper->setNumdoc($numdoc);
    $mper->setTipdoc($tipdoc);
    $mper->setNomusu($nomusu);
    $mper->setApeusu($apeusu);
    $mper->setTelusu($telusu);
    $mper->setPasusu($pasusu);
    $mper->setDirusu($dirusu);
    $mper->setEdausu($edausu);
    $mper->setGenusu($genusu);
    $mper->setFotper($ruta_fotper);

    if (!$idusu) {
        $mper->save(); // Guardar nuevo registro
    } else {
        $mper->edit(); // Editar registro existente
    }
}

// Obtener datos del usuario
if ($idusu) {
    $dtOne = $mper->getOne($idusu); // Devuelve la información del usuario
} else {
    $dtOne = NULL; // Si no hay usuario, inicializa $dtOne como NULL
}
?>