<?php
require_once ('models/mpag.php');

$mpag = new Mpag();

$codpag = isset($_REQUEST['codpag']) ? $_REQUEST['codpag']:NULL;
$nompag = isset($_POST['nompag']) ? $_POST['nompag']:NULL;
$rutpag = isset($_POST['rutpag']) ? $_POST['rutpag']:NULL;
$mospag = isset($_REQUEST['mospag']) ? $_REQUEST['mospag']:NULL;

$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
$datOne = NULL;

$mpag->setCodpag($codpag);
if($opera=="save"){
    $mpag->setNompag($nompag);
    $mpag->setRutpag($rutpag);
    $mpag->setMospag($mospag);
    if(!$codpag) $mpag->save();else $mpag->edit();
}

if($codpag && $opera=="acti"){
    $mpag->setmospag($mospag);
    $mpag->editmospag();
}

if($opera=="eli" && $codpag) $mpag->del();
if($opera=="edi" && $codpag) $datOne = $mpag->getOne($codpag);

$datAll = $mpag->getAll();

?>