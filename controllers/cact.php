<?php
include('models/mact.php');

$codact = isset($_REQUEST['codact']) ? $_REQUEST['codact'] : NULL;
$nomact = isset($_POST['nomact']) ? $_POST['nomact'] : NULL;
$desact = isset($_POST['desact']) ? $_POST['desact'] : NULL;
$codfas = isset($_POST['codfas']) ? $_POST['codfas'] : NULL;
$iniact = isset($_POST['iniact']) ? $_POST['iniact'] : NULL;
$finact = isset($_POST['finact']) ? $_POST['finact'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$mact = new Mact();

$mact->setCodact($codact);

if ($ope == "save") {
    $mact->setNomact($nomact);
    $mact->setDesact($desact);
    $mact->setCodfas($codfas);
    $mact->setIniact($iniact);
    $mact->setFinact($finact);
    if ($codact)
        $mact->edit();
    else
        $mact->save();

}

if ($ope == "del" && $codact)
    $mact->del();
if ($ope == "edi" && $codact) {
    $datOne = $mact->getOne();
} else {
    $datOne = NULL;
}

$fases = $mact->getAll();  // Obtener todas las fases con los grupos vinculados
$cdpro = $mact->getCpro();
$datAll = $mact->getAll(); // Recupera todos los datos necesarios
?>
