<?php
class Mrcon{

    private $corie; 
    private $nuicie;     
    private $corusu;
    private $fecsol;
    private $keyolv;
    private $idusu;

    function getCorie(){
        return $this->corie;
    }
    function getNuicie(){
        return $this->nuicie;
    }
    function getCorusu(){
        return $this->corusu;
    }
    function getFecsol(){
        return $this->fecsol;
    }
    function getKeyolv(){
        return $this->keyolv;
    }   
    function getIdusu(){
        return $this->idusu;
    }

    function setCorie($corie){
        $this->corie=$corie;
    }
    function setNuicie($nuicie){
        $this->nuicie=$nuicie;
    }
    function setCorusu($corusu){
        $this->corusu=$corusu;
    }
    function setFecsol($fecsol){
        $this->fecsol=$fecsol;
    }
    function setKeyolv($keyolv){
        $this->keyolv=$keyolv;
    }
    function setIdusu($idusu){
        $this->idusu=$idusu;
    }

    public function getOneCor(){
        $res=NULL;
        $sql="select";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $corusu = $this->getCorusu();
        $result -> Bimparam(":corusu",$corusu);
        $result -> execute();
        $res = $result -> fetch(PDO::FETCH_ASSOC);
    }
    public function upsUsu(){
        $res=NULL;
        $sql="Update";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $fecsol = $this->getFecsol();
        $result->bindParam(":fecsol",$fecsol);
        
    }
}
?>