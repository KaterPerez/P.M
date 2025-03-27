<?php
include('models/mfas.php');

$nomfas = isset($_POST['nomfas']) ? $_POST['nomfas'] : NULL;
$codfas = isset($_REQUEST['codfas']) ? $_REQUEST['codfas'] : NULL;
$codpro = isset($_POST['codpro']) ? $_POST['codpro'] : NULL;
$inifas = isset($_POST['inifas']) ? $_POST['inifas'] : NULL;
$finfas = isset($_POST['finfas']) ? $_POST['finfas'] : NULL;
$idgru = isset($_POST['idgru']) ? $_POST['idgru'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;


$mfas = new Mfas();

$mfas->setCodfas($codfas);

if ($ope == "save") {
    $mfas->setNomfas($nomfas);
    $mfas->setCodpro($codpro);
    $mfas->setInifas($inifas);
    $mfas->setFinfas($finfas);
    if ($codfas)
        $mfas->edit();
    else
        $mfas->save();

}

if($ope=="del" && $codfas) $mfas->del();
if($ope=="edi" && $codfas){
    $datOne = $mfas->getOne();
}else{
    $datOne=NULL;
}

$fases = $mfas->getAll();  // Obtener todas las fases con los grupos vinculados
$cdpro = $mfas->getCpro(); 
$datAll = $mfas->getAll(); // Recupera todos los datos necesarios
?>
