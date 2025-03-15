<?php
include('models/mcrgrupo.php');

$mcrgrupo = new Mcrgrupo();
$mcrgrupo->setIdnomp($_SESSION['idnomp']);
$dat = $mcrgrupo->getMen();

function validar($idtproy){
    $mcrgrupo = new Mcrgrupo();
    $mcrgrupo->setIdtproy($idtproy);
    $mcrgrupo->setIdnomp($_SESSION['idnomp']);
    $dat = $mcrgrupo->getVal();
    return $dat;
}
?>