<?php
include("models/mregis.php");
require_once('models/mval.php');
require_once('models/mdom.php');

// Validar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$mval = new Mval();
$mdom = new Mdom();

$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu'] : NULL;
$numdoc = isset($_POST['numdoc']) ? $_POST['numdoc'] : NULL;
$tipdoc = isset($_POST['tipdoc']) ? $_POST['tipdoc'] : NULL;
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$apeusu = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL;
$telusu = isset($_POST['telusu']) ? $_POST['telusu'] : NULL;
$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu'] : NULL;
$dirusu = isset($_POST['dirusu']) ? $_POST['dirusu'] : NULL;
$edausu = isset($_POST['edausu']) ? $_POST['edausu'] : NULL;
$genusu = isset($_POST['genusu']) ? $_POST['genusu'] : NULL;
$corusu = isset($_POST['corusu']) ? $_POST['corusu'] : NULL;
$actusu = isset($_POST['actusu']) ? $_POST['actusu'] : NULL; // Obtener actusu desde el formulario
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

// Obtener el perfil del usuario desde la sesión
$codper = isset($_SESSION['codper']) ? (int)$_SESSION['codper'] : NULL; // Asegurarse de que sea un entero

$mregtd = new Mregtd();
$mregtd->setIdusu($idusu);

if ($ope == "save") {
    $mregtd->setIdusu($idusu);
    $mregtd->setNumdoc($numdoc);        
    $mregtd->setTipdoc($tipdoc);        
    $mregtd->setNomusu($nomusu);
    $mregtd->setApeusu($apeusu);
    $mregtd->setTelusu($telusu);
    $mregtd->setPasusu($pasusu);
    $mregtd->setDirusu($dirusu);
    $mregtd->setEdausu($edausu);
    $mregtd->setGenusu($genusu);
    $mregtd->setCorusu($corusu);
    $mregtd->setActusu($actusu);

    // Captura y asignación de codper
    $codper = isset($_POST['codper']) ? $_POST['codper'] : null;
    $mregtd->setCodper($codper);

    if ($idusu) {
        // Actualizar registro existente
        $mregtd->edit();
    } else {
        // Crear un nuevo registro
        $mregtd->save();
    }
}

if ($ope == "edi" && $idusu) {
    // Recuperar los datos del registro específico
    $datOne = $mregtd->getOne();
    if ($datOne) {
        // Asegurarse de que los datos estén disponibles para la vista
        $numdoc = $datOne[0]['numdoc'];
        $tipdoc = $datOne[0]['tipdoc'];
        $nomusu = $datOne[0]['nomusu'];
        $apeusu = $datOne[0]['apeusu'];
        $telusu = $datOne[0]['telusu'];
        $pasusu = $datOne[0]['pasusu'];
        $dirusu = $datOne[0]['dirusu'];
        $edausu = $datOne[0]['edausu'];
        $genusu = $datOne[0]['genusu'];
        $corusu = $datOne[0]['corusu'];
        $actusu = $datOne[0]['actusu'];
        $codper = $datOne[0]['codper'];
    }
}
if ($idusu && $ope == "codper") {
    $mregtd->setIdusu($idusu);
    $mregtd->setCodper($codper);
    $mregtd->editCodper();
}
if ($idusu && $ope == "actusu") {
    $mregtd->setIdusu($idusu);
    $mregtd->setActusu($actusu);
    $mregtd->ediActusu();
}

if ($ope == "eli" && $idusu) {
    $mregtd->del();
}

// Obtener todos los datos y filtrar por perfiles relevantes (3 y 4)
$datAll = $mregtd->getAll();
$datAll = array_filter($datAll, function ($dta) {
    return in_array($dta['codper'], [3, 4]);
});

?>
