<?php
    include ('models/mfas.php'); 

    //Tabla proyecto
    $codpro = isset($_REQUEST['codpro']) ? $_REQUEST['codpro']:NULL;
    $nompro = isset($_POST['nompro']) ? $_POST['nompro']:NULL;
    $tempro = isset($_POST['tempro']) ? $_POST['tempro']:NULL;
    $inipro = isset($_POST['inipro']) ? $_POST['inipro']:NULL;
    $finpro = isset($_POST['finpro']) ? $_POST['finpro']:NULL;
    $idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu']:NULL;
    $codgru = isset($_REQUEST['codgru']) ? $_REQUEST['codgru']:NULL;
    $codval = isset($_REQUEST['codval']) ? $_REQUEST['codval']:NULL;
    //Tabla Fase
    $codfas = isset($_REQUEST['codfas']) ? $_REQUEST['codfas']:NULL;
    $nomfas = isset($_POST['nomfas']) ? $_POST['nomfas']:NULL;
    $inifas = isset($_POST['inifas']) ? $_POST['inifas']:NULL;
    $finfas = isset($_POST['finfas']) ? $_POST['finfas']:NULL;
    //Tabla actividad
    $codact = isset($_REQUEST['codact']) ? $_REQUEST['codact']:NULL;
    $iniact = isset($_POST['iniact']) ? $_POST['iniact']:NULL;
    $finact = isset($_POST['finact']) ? $_POST['finact']:NULL;
    // Tabla grupo
    $nomgru = isset($_POST['nomgru']) ? $_POST['nomgru']:NULL;
    //Tabla Dominio
    $coddom = isset($_REQUEST['coddom']) ? $_REQUEST['coddom']:NULL;
    $nomdom = isset($_POST['nomdom']) ? $_POST['nomdom']:NULL;
    //Tabla valor
    $nomval = isset($_POST['nomval']) ? $_POST['nomval']:NULL;
    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $datOne=NULL;

    $mfas=new Mfas();
    if($ope=="savep"){
        $mfas->setCodpro($codpro);
        $mfas->setNompro($nompro);
        $mfas->setTempro($tempro);
        $mfas->setInipro($inipro);
        $mfas->setFinpro($finpro);
        $mfas->setIdusu($idusu);
        $mfas->setCodgru($codgru);
        $mfas->setCodval($codval);
        if($codpro) $mfas->editp();
        else $mfas->savep();
    }
    if($ope=="savef"){
        $mfas->setNomfas($nomfas);
        $mfas->setInifas($inifas);
        $mfas->setFinfas($finfas);
        if($codfas) $mfas->editf();
        else $mfas->savef();
    } 
    if($ope=="savea"){
        $mfas->setcodact($codact);
        $mfas->setIniact($iniact);
        $mfas->setFinact($finact);
        if($codact) $mfas->edita();
        else $mfas->savea();
    }  
    if($ope=="saveg"){
        $mfas->setNomgru($nomgru);
        if($codgru) $mfas->editg();
        else $mfas->saveg();
    }
    
if($codfas) $mfas->delf();
if($codgru) $mfas->delg();
if($codpro) $mfas->delp();
if($codact) $mfas->dela();

$datAll = $mfas->getAll();
$datCur = $mfas->curgrup();
$datEst = $mfas->estcurg();
$datTem = $mfas->tempro();
$datOne = $mfas->getOne();
?>