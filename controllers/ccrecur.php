<?php
include("models/mcrecur.php");

$idcur = isset($_REQUEST['idcur']) ? $_REQUEST['idcur'] : NULL;  
$codcur = isset($_POST['codcur']) ? $_POST['codcur'] : NULL;
$nomcur = isset($_POST['nomcur']) ? $_POST['nomcur'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mcrecur = new Mcrecur();
$mcrecur->setIdcur($idcur); 

if ($ope == "save") {
    $mcrecur->setIdcur($idcur); 
    $mcrecur->setCodcur($codcur); 
    $mcrecur->setNomcur($nomcur);
    $mcrecur->setIdusu($idusu);
    if(!$idcur) $mcrecur->save();else $mcrecur->edit();

}
if($ope=="eli" && $idcur) $mcrecur->del();
if($ope=="edi" && $idcur) $datOne = $mcrecur->getOne($idcur);

$datAll = $mcrecur->getAll();
?>