<?php
include('models/mcrgrupo.php');

$nompro = isset($_POST['nompro']) ? $_POST['nompro'] : NULL;
$codpro = isset($_REQUEST['codpro']) ? $_REQUEST['codpro'] : NULL;
$idgru = isset($_POST['idgru']) ? $_POST['idgru'] : NULL;
$tempro = isset($_POST['tempro']) ? $_POST['tempro'] : NULL;
$despro = isset($_POST['despro']) ? $_POST['despro'] : NULL;
$inipro = isset($_POST['inipro']) ? $_POST['inipro'] : NULL;
$finpro = isset($_POST['finpro']) ? $_POST['finpro'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;


$mcrgrupo = new Mcrgrupo();
$mcrgrupo->setCodpro($codpro);

if ($ope == "save") {
    $mcrgrupo->setNompro($nompro);
    $mcrgrupo->setIdgru($idgru);
    $mcrgrupo->setTempro($tempro);
    $mcrgrupo->setDespro($despro);
    $mcrgrupo->setInipro($inipro);
    $mcrgrupo->setFinpro($finpro);

    if ($codpro)
        $mcrgrupo->edit();
    else
        $mcrgrupo->save();

}

if($ope=="del" && $codpro) $mcrgrupo->del();
if($ope=="edi" && $codpro){
    $datOne = $mcrgrupo->getOne();
}else{
    $datOne=NULL;
}
if (isset($_GET['download']) && isset($_GET['codpro'])) {
    $codpro = $_GET['codpro'];
    $mcrgrupo = new Mcrgrupo();
    $archivos = $mcrgrupo->getArchivosByProyecto($codpro);

    if (!empty($archivos)) {
        $zip = new ZipArchive();
        $zipFileName = "proyecto_$codpro.zip";

        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            foreach ($archivos as $archivo) {
                if (file_exists("uploads/" . $archivo['archivo'])) {
                    $zip->addFile("uploads/" . $archivo['archivo'], $archivo['archivo']);
                }
            }
            $zip->close();

            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
            header('Content-Length: ' . filesize($zipFileName));

            readfile($zipFileName);
            unlink($zipFileName);
            exit;
        }
    }
}

$cdgru = $mcrgrupo->getCgru();
$datAll = $mcrgrupo->getAll(); // Recupera todos los datos necesarios
?>
