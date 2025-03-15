<?php
require_once ('models/mdom.php');

$mdom = new Mdom();

$coddom = isset($_REQUEST['coddom']) ? $_REQUEST['coddom']:NULL;
$nomdom = isset($_POST['nomdom']) ? $_POST['nomdom']:NULL;

$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
$datOne = NULL;

$mdom->setCoddom($coddom);
if($opera=="save"){
    $mdom->setNomdom($nomdom);
    if(!$coddom) $mdom->save();else $mdom->edit();
}


if($opera=="eli" && $coddom) $mdom->del();
if($opera=="edi" && $coddom) $datOne = $mdom->getOne($coddom);

$datAll = $mdom->getAll();
?>