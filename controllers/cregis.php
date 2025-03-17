<?php
    include("models/mregis.php");
    require_once ('models/mval.php');
    require_once ('models/mdom.php');

    $mval = new Mval();
    $mdom = new Mdom();
   
    $idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu'] : NULL;
    $numdoc = isset($_POST['numdoc']) ? $_POST['numdoc'] : NULL;
    $tipdoc = isset($_POST['tipdoc']) ? $_POST['tipdoc'] : NULL;
    $nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
    $apeusu = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL;
    $telusu = isset($_POST['telusu']) ? $_POST['telusu'] : NULL;
    $pasusu = isset($_POST['pasusu']) ? $_POST['pasusu'] : NULL;
    $dirusu = isset($_POST['dirusu']) ? $_POST['dirusu'] : NULL;
    $edausu = isset($_POST['edausu']) ? $_POST['edausu'] : NULL;
    $genusu = isset($_POST['genusu']) ? $_POST['genusu'] : NULL;
    $corusu = isset($_POST['corusu']) ? $_POST['corusu'] : NULL;
    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $datOne = NULL;

    $mregtd=new Mregtd();
    //$mregtd->setNuicie($nuicie);
    $mregtd->setIdusu($idusu);
    if ($ope == "save"){
        $mregtd->setIdusu($idusu);  
        $mregtd->setNumdoc($numdoc);        
        $mregtd->setTipdoc($tipdoc);        
        $mregtd->setNomusu($nomusu);
        $mregtd->setApeusu($apeusu);
        $mregtd->setTelusu($telusu);
        $mregtd->setPasusu($pasusu);
        $mregtd->setDirusu($dirusu);
        $mregtd->setEdausu($edausu);
        $mregtd->setGenusu($genusu);
        $mregtd->setCorusu($corusu);

            if ($idusu){
                $mregtd->edit();
            } else {
                $mregtd->save();
            }
    }
    if($idusu && $ope=="codper"){
        $mregtd->setCodper($codper);
        $mregtd->editCodper();
    }
    
    
    if($ope=="eli" && $idusu) $mregtd->del();
    if($ope=="edi" && $idusu) $datOne = $mregtd->getOne($idusu);
    $datAll = $mregtd->getAll();
    $datAll = array_filter($datAll, function($dta) {
        return in_array($dta['codper'], [3, 4]);
    });
    $datVal = $mval->getAll();
    $datDom = $mdom-> getAll();

?>
