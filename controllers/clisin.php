<?php
include('models/mlisin.php');

$codie = isset($_REQUEST['codie']) ? $_REQUEST['codie'] : NULL;
$nomie = isset($_POST['nomie']) ? $_POST['nomie'] : NULL;
$tipie = isset($_POST['tipie']) ? $_POST['tipie'] : NULL;
$dirie = isset($_POST['dirie']) ? $_POST['dirie'] : NULL;
$nuicie = isset($_POST['nuicie']) ? $_POST['nuicie'] : NULL;
$corie = isset($_POST['corie']) ? $_POST['corie'] : NULL;
$codubi = isset($_REQUEST['codubi']) ? $_REQUEST['codubi'] : NULL;
$telie = isset($_POST['telie']) ? $_POST['telie'] : NULL;
$actie = isset($_POST['actie']) ? $_POST['actie'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;


$mlisin = new Mlisin();
$mlisin->setCodie($codie);

if ($ope == "save") {
    $mlisin->setNomie($nomie);
    $mlisin->setTipie($tipie);
    $mlisin->setDirie($dirie);
    $mlisin->setNuicie($nuicie);
    $mlisin->setCorie($corie);
    $mlisin->setCodubi($codubi);
    $mlisin->setTelie($telie);
    $mlisin->setActie($actie);
    if ($codie)
        $mlisin->edit();
    else
        $mlisin->save();

}

if($ope=="del" && $codie) $mlisin->del();
if($ope=="edi" && $codie){
    $datOne = $mlisin->getOne();
}else{
    $datOne=NULL;
}

if ($codie && $ope == "actie") {
    // Obtener el estado actual del ie
    $ie = $mlisin->getOne();
    if ($ie) {
        // Cambiar entre 1 (activo) y 2 (inactivo)
        $nuevoEstado = $ie[0]['actie'] == 1 ? 2 : 1;

        $mlisin->setCodie($codie);
        $mlisin->setActie($nuevoEstado); // Asignar el nuevo estado
        $mlisin->ediActie(); // Guardar el cambio en la base de datos
    }
}

$datAll = $mlisin->getAll(); // Recupera todos los datos necesarios
?>
