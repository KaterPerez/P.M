<?php
class Mregtd{
    //Tabla usuario
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

    //GET Y SET TABLA USUARIO
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
    function getCorusu(){
        return $this->corusu;
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
    function getCodval(){
        return $this->codval;
    }

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
    function setCorusu($corusu){
        $this->corusu = $corusu;
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
        $this->codval = $codper;
    }
    function setCodval($codval){
        $this->codval = $codval;
    }
    function getAll(){
        $sql = "SELECT idusu, numdoc, tipdoc, nomusu, apeusu, corusu, telusu, pasusu, dirusu,
        edausu, genusu, codper, codval FROM usuario";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res= $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getOne(){
        $res = NULL;
        $sql = "SELECT idusu, nomusu, apeusu, numdoc, tipdoc, telusu, pasusu, dirusu, 
                edausu, genusu, codper, corusu, codval FROM usuario WHERE idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);    
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu", $idusu);       
        $result->execute(); 
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function save(){
        $sql="INSERT INTO usuario (numdoc, tipdoc, nomusu, apeusu, telusu, pasusu, dirusu, 
        edausu, genusu, codper, corusu) VALUES (:numdoc, :tipdoc, :nomusu, :apeusu, :telusu, :pasusu, :dirusu, 
        :edausu, :genusu, :codper, :corusu)";
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
        $pasusu = password_hash($this->getPasusu(), PASSWORD_BCRYPT);
        $result->bindParam(':pasusu', $pasusu); 
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
        $result->execute(); 
    }   
    function edit(){
        $sql="UPDATE usuario SET numdoc=:numdoc, tipdoc=:tipdoc, nomusu=:nomusu,
        apeusu=:apeusu, corusu=:corusu, telusu=:telusu, pasusu=:pasusu,
        dirusu=:dirusu, edausu=:edausu, genusu=:genusu WHERE idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $numdoc = $this->getNumdoc();
        $result->bindParam(":numdoc",$numdoc);
        $tipdoc = $this->getTipdoc();
        $result->bindParam(":tipdoc",$tipdoc);
        $nomusu = $this->getNomusu();
        $result->bindParam(":nomusu",$nomusu);
        $apeusu = $this->getApeusu();
        $result->bindParam(":apeusu",$apeusu);
        $corusu = $this->getCorusu();
        $result->bindParam(":corusu",$corusu);
        $telusu = $this->getTelusu();
        $result->bindParam(":telusu",$telusu);
        $pasusu = $this->getPasusu();
        $result->bindParam(":pasusu",$pasusu);
        $dirusu = $this->getDirusu();
        $result->bindParam(":dirusu",$dirusu);
        $edausu = $this->getEdausu();
        $result->bindParam(":edausu",$edausu);
        $genusu = $this->getGenusu();
        $result->bindParam(":genusu",$genusu);
        $idusu = $this->getIdusu(); 
        $result->bindParam(":idusu",$idusu);
        $result->execute();
    }
    function del(){
        $sql="DELETE FROM usuario WHERE  idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu", $idusu);
        $result->execute();
        
    }
}
?>