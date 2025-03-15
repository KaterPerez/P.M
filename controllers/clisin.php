<?php
include(__DIR__ . "/../models/mlisin.php");
include(__DIR__ . "/../models/mubi.php");

$idins = isset($_REQUEST['idins']) ? $_REQUEST['idins'] : NULL;
$nuicie = isset($_POST['nuicie']) ? $_POST['nuicie'] : NULL;
$depubi = isset($_POST['depubi']) ? $_POST['depubi'] : NULL;
$munubi = isset($_POST['munubi']) ? $_POST['munubi'] : NULL;
$corie = isset($_POST['corie']) ? $_POST['corie'] : NULL;
$telie = isset($_POST['telie']) ? $_POST['telie'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$mins = new Mlisin();

if ($ope == "save") {
  $mins->setNuicie($nuicie);
  $mins->setDepubi($depubi);
  $mins->setMunubi($munubi);
  $mins->setCorie($corie);
  $mins->setTelie($telie);
  if($idins) $mins->edit();
  else $mins->save();
}

$m = 2;
if ($ope == "del" && $idins) $mins->del();
if ($ope == "edi" && $idins) {
  $dtOne = $mins->getOne();
  $m = 1;
} else { 
  $dtOne = NULL;
}

$mubi = new Mubicacion();
$dep = $mubi->getDep(0);
$dat = $mins->getAll();
$dtMuni = isset($depubi) ? $mubi->getMun($depubi) : [];

if ($ope == 'getMunicipios' && $depubi) {
  $municipios = $mubi->getMun($depubi);
  
  $options = '<select class="form-control form-select" id="munubi" name="munubi">';
  $options .= '<option value="0">Selecciona Municipio</option>';
  
  if (is_array($municipios)) {
    foreach ($municipios as $municipio) {
      $options .= '<option value="' . $municipio['codubi'] . '">' . $municipio['nomubi'] . '</option>';
    }
  }
  
  $options .= '</select>';
  
  echo $options;
  exit;
}
?>