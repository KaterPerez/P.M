<?php
require_once ('models/mval.php');
require_once ('models/mdom.php');

$mval = new Mval();
$mdom = new Mdom();

$codval =isset($_REQUEST['codval']) ? $_REQUEST['codval']:NULL;
$nomval=isset($_POST['nomval']) ? $_POST['nomval']:NULL;
$coddom=isset($_POST['coddom']) ? $_POST['coddom']:NULL;

$opera =isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
$datOne = NULL;

$mval->setCodval($codval);
if($opera=="save"){
    $mval->setCoddom($coddom);
    $mval->setNomval($nomval);
    if(!$codval) $mval->save();else $mval->edit();
}

if($opera=="eli" && $codval) $mval->del();
if($opera=="edi" && $codval) $datOne = $mval->getOne();

//MOSTRAR TODOS LOS datos
$datAll = $mval->getAll();
$datDom = $mdom-> getALL();
?>