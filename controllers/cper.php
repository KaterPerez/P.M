<?php
include_once(__DIR__ . '/../models/mper.php');
include_once(__DIR__ . '/../controllers/optimg.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
$fotper = isset($_POST['fotper']) ? $_POST['fotper'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$fots = isset($_FILES['fots']['name']) ? $_FILES['fots']['name'] : NULL;

if ($fots) {
    if ($fotper && file_exists($fotper)) unlink($fotper); // Elimina la foto anterior si existe
    $fotper = opti($_FILES['fots'], 'fotper', 'fotos', date('YmdHis')); // Optimiza y guarda la nueva foto
}
// Instancia de la clase
$mper = new Mper();
$mper->setIdusu($idusu);
try {
    // Guardar o Editar
    if ($ope == "save") {
        $mper->setTipdoc($numdoc);
        $mper->setTipdoc($tipdoc);
        $mper->setNomusu($nomusu);
        $mper->setApeusu($apeusu);
        $mper->setTelusu($telusu);
        $mper->setPasusu($pasusu);
        $mper->setDirusu($dirusu);
        $mper->setEdausu($edausu);
        $mper->setGenusu($genusu);
        $mper->setFotper($fotper);

        if ($idusu) {
            $mper->edit(); // Edita usuario existente
        } else {
            $mper->save(); // Guarda nuevo usuario
        }
    }
} catch (Exception $e) {
    echo "Error al procesar la solicitud: " . $e->getMessage();
    exit();
}

// Obtener datos del usuario
if ($idusu) {
    $dtOne = $mper->getOne($idusu);
} else {
    $dtOne = NULL;
}

$dat = $mper->getAll();


?>