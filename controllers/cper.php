<?php
include_once(__DIR__ . '/../models/mper.php'); 
include("controllers/optimg.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mper = new Mper();
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
$imgusu = isset($_POST['imgusu']) ? $_POST['imgusu'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$fotper = isset($_FILES['fotper']) ? $_FILES['fotper']:NULL;

if ($fotper){
	if(file_exists($imgusu)) unlink($imgusu);
	$fotper = opti($_FILES['fotper'], 'fotper','fotos',date('YmdHis'));
}

$mper = new Mper();

if ($ope == "save"){
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
    $mper->setFotper($fotper);
    $mper->setImgusu($imgusu);

        if ($idusu){
            $mper->edit();
        } else {
            $mper->save();
        }
}


if ($idusu) {
    $dtOne = $mper->getOne($idusu); // Asegúrate de que el método `getOne` acepta el ID del usuario como parámetro
} else {
    $dtOne = NULL;
}
?>
