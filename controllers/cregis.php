<?php
    include("models/mregis.php");
    // $nuicie = isset($_REQUEST['nuicie']) ? $_REQUEST['nuicie'] : NULL;
    // $pasie = isset($_POST['pasie']) ? $_POST['pasie'] : NULL;
    // $nomie = isset($_POST['nomie']) ? $_POST['nomie'] : NULL;
    // $dirie = isset($_POST['dirie']) ? $_POST['dirie'] : NULL;
    // $telie = isset($_POST['telie']) ? $_POST['telie'] : NULL;
    // $corie = isset($_POST['corie']) ? $_POST['corie'] : NULL;
    $idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu'] : NULL;
    $numdoc = isset($_POST['numdoc']) ? $_POST['numdoc'] : NULL;
    $tipdoc = isset($_POST['tipdoc']) ? $_POST['tipdoc'] : NULL;
    $nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
    $apeusu = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL;
    $corusu = isset($_POST['corusu']) ? $_POST['corusu'] : NULL;
    $telusu = isset($_POST['telusu']) ? $_POST['telusu'] : NULL;
    $pasusu = isset($_POST['pasusu']) ? $_POST['pasusu'] : NULL;
    $dirusu = isset($_POST['dirusu']) ? $_POST['dirusu'] : NULL;
    $edausu = isset($_POST['edausu']) ? $_POST['edausu'] : NULL;
    $genusu = isset($_POST['genusu']) ? $_POST['genusu'] : NULL;
    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
    $datOne = NULL;

    $mregtd=new Mregtd();
    //$mregtd->setNuicie($nuicie);
    $mregtd->setIdusu($idusu);
    if($ope=="save"){
        $mregtd->setNumdoc($numdoc);
            $mregtd->setTipdoc($tipdoc);
            $mregtd->setNomusu($nomusu);
            $mregtd->setApeusu($apeusu);
            $mregtd->setCorusu($corusu);
            $mregtd->setTelusu($telusu);
            $mregtd->setPasusu($pasusu);
            $mregtd->setDirusu($dirusu);
            $mregtd->setEdausu( $edausu);
            $mregtd->setGenusu( $genusu);
            if(!$idusu) $mregtd->save();else $mregtd->edit();
    }
   
    
    if($ope=="eli" && $idusu) $mregtd->del();
    if($ope=="edi" && $idusu) $datOne = $mregtd->getOne($idusu);
    $datAll = $mregtd->getAll();
    

?>
