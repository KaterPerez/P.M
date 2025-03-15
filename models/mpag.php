<?php
class Mpag{
    private $codpag;
    private $nompag;
    private $rutpag;
    private $mospag;
    private $ordpag;

    // METODOS GET
    public function getCodpag(){
        return $this->codpag;
    }
    public function getNompag(){
        return $this->nompag;
    }
    public function getRutpag(){
        return $this->rutpag;
    }
    public function getMospag(){
        return $this->mospag;
    }
    // METODOS SET
    public function setCodpag($codpag){
        $this->codpag=$codpag;
    }
    public function setNompag($nompag){
        $this->nompag=$nompag;
    }
    public function setRutpag($rutpag){
        $this->rutpag=$rutpag;
    }
    public function setMospag($mospag){
        $this->mospag=$mospag;
    }
    function getAll(){
        $sql="SELECT p.codpag, p.nompag, p.rutpag, p.mospag FROM pagina AS p";
        $modelo=new conexion();
        $conexion=$modelo->get_conexion();
        $result=$conexion->prepare($sql);
        $result->execute();
        $res=$result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
        
    }
    function getOne(){
        $sql = "SELECT p.codpag, p.nompag, p.rutpag, p.mospag FROM pagina AS p WHERE p.codpag=:codpag";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codpag = $this->getCodpag();
        $result->bindParam(":codpag",$codpag);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
      
        
    }   
    function save(){
        $sql="INSERT INTO pagina(nompag, rutpag, mospag) VALUES (:nompag, :rutpag, :mospag)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $nompag = $this->getNompag();
        $result->bindParam(":nompag",$nompag);
        $rutpag = $this->getRutpag();
        $result->bindParam(":rutpag",$rutpag);
        $mospag = $this->getMospag();
        $result->bindParam(":mospag",$mospag);
        $result->execute();
    }   
    function edit(){
     
        $sql="UPDATE pagina SET nompag=:nompag, rutpag=:rutpag, mospag=:mospag WHERE codpag=:codpag";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $codpag = $this->getCodpag();
        $result->bindParam(":codpag", $codpag);
        $nompag = $this->getNompag();
        $result->bindParam(":nompag",$nompag);
        $rutpag = $this->getRutpag();
        $result->bindParam(":rutpag",$rutpag);
        $mospag = $this->getMospag();
        $result->bindParam(":mospag",$mospag);
        $result->execute();
    
    }
    function editMospag(){
      
        $sql = "UPDATE pagina SET mospag=:mospag WHERE codpag=:codpag";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codpag = $this->getCodpag();
        $result->bindParam(":codpag",$codpag);
        $mospag = $this->getMospag();
        $result->bindParam(":mospag",$mospag);
        $result->execute();
        
    }
    function del(){
        $sql="DELETE FROM pagina WHERE  codpag=:codpag";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $codpag = $this->getCodpag();
        $result->bindParam(":codpag", $codpag);
        $result->execute();
        
    }
    
}
?>