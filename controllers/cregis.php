<?php
// Incluir modelos necesarios
include("models/mregis.php");
require_once('models/mval.php');
require_once('models/mdom.php');

// Validar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Crear instancias de los modelos
$mval = new Mval();
$mdom = new Mdom();

// Obtener datos del usuario y solicitud
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

// Determinar si el formulario debe mostrarse
$mostrarFormulario = ($codper !== 3); // Ocultar si el perfil es 3

// Instanciar el modelo principal
$mregtd = new Mregtd();
$mregtd->setIdusu($idusu);

// Operaciones según la solicitud (ope)
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
    $mregtd->setActusu($actusu); // Asignar el valor de actusu

    if ($idusu) {
        $mregtd->edit(); // Actualizar registro existente
    } else {
        $mregtd->save(); // Crear un nuevo registro
    }
}

if ($idusu && $ope == "actusu") {
    $mregtd->setIdusu($idusu); // Asegurarse de que se define el ID
    $mregtd->setActusu($actusu); // Configurar actusu
    $mregtd->ediActusu(); // Llamar al método correcto
}

if ($idusu && $ope == "codper") {
    $mregtd->setCodper($codper);
    $mregtd->editCodper();
}

if ($ope == "eli" && $idusu) $mregtd->del();
if ($ope == "edi" && $idusu) $datOne = $mregtd->getOne($idusu);

// Obtener todos los datos y filtrar por perfiles relevantes (3 y 4)
$datAll = $mregtd->getAll();
$datAll = array_filter($datAll, function($dta) {
    return in_array($dta['codper'], [3, 4]);
});

// Obtener valores adicionales
$datVal = $mval->getAll();
$datDom = $mdom->getAll();
?>
