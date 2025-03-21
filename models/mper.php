<?php
class Mper{
    private $idusu;
    private $numdoc;
    private $tipdoc;
    private $nomusu;
    private $apeusu;
    private $telusu;
    private $pasusu;
    private $dirusu;
    private $edausu;
    private $genusu;
    private $codper;
    private $corusu;
    private $codval;
    private $forper;
    private $imgusu;


   //Metodo GET
    function getIdusu(){
        return $this->idusu;
    }
    function getNumdoc(){
        return $this->numdoc;
    }
    function getTipdoc(){
        return $this->tipdoc;
    }
    function getNomusu(){
        return $this->nomusu;
    }
    function getApeusu(){
        return $this->apeusu;
    }
    function getTelusu(){
        return $this->telusu;
    }
    function getPasusu(){
        return $this->pasusu;
    }
    function getDirusu(){
        return $this->dirusu;
    }
    function getEdausu(){
        return $this->edausu;
    }
    function getGenusu(){
        return $this->genusu;
    }
    function getCodper(){
        return $this->codper;
    }
    function getCorusu(){
        return $this->corusu;
    }
    function getCodval(){
        return $this->codval;
    }
    function getImgusu(){
        return $this->imgusu;
    }
    //Metodo Set
    function setIdusu($idusu){
        $this->idusu = $idusu;
    }
    function setNumdoc($numdoc){
        $this->numdoc = $numdoc;
    }
    function setTipdoc($tipdoc){
        $this->tipdoc = $tipdoc;
    }
    function setNomusu($nomusu){
        $this->nomusu = $nomusu;
    }
    function setApeusu($apeusu){
        $this->apeusu = $apeusu;
    }
    function setTelusu($telusu){
        $this->telusu = $telusu;
    }
    function setPasusu($pasusu){
        $this->pasusu = $pasusu;
    }
    function setDirusu($dirusu){
        $this->dirusu=$dirusu;
    }
    function setEdausu($edausu){
        $this->edausu = $edausu;
    }
    function setGenusu($genusu){
        $this->genusu = $genusu;
    }
    function setCodper($codper){
        $this->codper = $codper;
    }
    function setCorusu($corusu){
        $this->corusu = $corusu;
    }
    function setCodval($codval){
        $this->codval = $codval;
    }
    function setImgusu($imgusu){
        $this->imgusu = $imgusu;
    }
    function getAll() {
        $sql = "SELECT * FROM usuario";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
  public function getOne($idusu) {
    $res = NULL;
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['idusu'])) {
        $idusu = $_SESSION['idusu'];
        $sql = "SELECT idusu, nomusu, apeusu, numdoc, tipdoc, telusu, pasusu, dirusu, 
                edausu, genusu, codper, corusu, codval, imgusu FROM usuario WHERE idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetch(PDO::FETCH_ASSOC); 
    }
    return $res;
}

      
    function save(){
        $sql="INSERT INTO usuario (numdoc, tipdoc, nomusu, apeusu, telusu, pasusu, dirusu, 
            edausu, genusu, codusu, imgusu) VALUES (:numdoc, :tipdoc, :nomusu, :apeusu, :telusu, :pasusu, :dirusu, 
            :edausu, :genusu, :codusu, :imgusu)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $numdoc=$this->getNumdoc();
        $result->bindParam(':numdoc',$numdoc);
        $tipdoc= $this->getTipdoc();
        $result->bindParam(':tipdoc',$tipdoc);
        $nomusu= $this->getNomusu();
        $result->bindParam(':nomusu',$nomusu);
        $apeusu=$this->getApeusu();
        $result->bindParam(':apeusu',$apeusu);
        $telusu=$this->getTelusu();
        $result->bindParam(':telusu',$telusu);
        $pasusu=$this->getPasusu();
        $result->bindParam(':pasusu',$pasusu);
        $dirusu=$this->getDirusu();
        $result->bindParam(':dirusu',$dirusu);
        $edausu=$this->getEdausu();
        $result->bindParam(':edausu',$edausu);
        $genusu=$this->getGenusu();
        $result->bindParam(':genusu',$genusu);
        $codper=$this->getCodper();
        $result->bindParam(':codper',$codper);
        $corusu=$this->getCorusu();
        $result->bindParam(':corusu',$corusu);
        $imgusu = $this->getImgusu();
		$result->bindParam(":imgusu", $imgusu);
        $result->execute(); 
    }   
    // function edit(){
     
    //     $sql="UPDATE usuina SET numdoc=:numdoc, tipdoc=:tipdoc, nomusu=:nomusu WHERE idusu=:idusu";
    //     $modelo = new conexion();
    //     $conexion = $modelo->get_conexion();    
    //     $result = $conexion->prepare($sql);
    //     $numdoc=$this->getNumdoc();
    //     $result->bindParam(':numdoc',$numdoc);
    //     $tipdoc= $this->getTipdoc();
    //     $result->bindParam(':tipdoc',$tipdoc);
    //     $nomusu= $this->getNomusu();
    //     $result->bindParam(':nomusu',$nomusu);
    //     $apeusu=$this->getApeusu();
    //     $result->bindParam(':apeusu',$apeusu);
    //     $telusu=$this->getTelusu();
    //     $result->bindParam(':telusu',$telusu);
    //     $pasusu=$this->getPasusu();
    //     $result->bindParam(':pasusu',$pasusu);
    //     $dirusu=$this->getDirusu();
    //     $result->bindParam(':dirusu',$dirusu);
    //     $edausu=$this->getEdausu();
    //     $result->bindParam(':edausu',$edausu);
    //     $genusu=$this->getGenusu();
    //     $result->bindParam(':genusu',$genusu);
    //     $codper=$this->getCodper();
    //     $result->bindParam(':codper',$codper);
    //     $result->execute(); 
    // }   
}
?>