<?php
class Mdom{
  private $coddom;
  private $nomdom;

  //Metodos get

  function getCoddom(){
    return $this->coddom;
  }  
  function getNomdom(){
    return $this->nomdom;
  }
 //Metodos set
  function setCoddom($coddom){
    $this->coddom=$coddom;
  }
  function setNomdom($nomdom){
    $this->nomdom=$nomdom;
  }

  function getAll(){
    $res = NULL;
    $sql = "SELECT coddom,nomdom FROM dominio";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->execute();
    $res= $result->fetchall(PDO::FETCH_ASSOC);
    return $res;
  }
  function getOne(){
    $res = NULL;
    $sql = "SELECT coddom,nomdom FROM dominio WHERE coddom = :coddom";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);    
    $coddom = $this->getCoddom();
    $result->bindParam(":coddom", $coddom);       
    $result->execute(); 
    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }
  function save(){
    $sql="INSERT INTO dominio(nomdom) VALUES (:nomdom)";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();    
    $result = $conexion->prepare($sql);
    $nomdom = $this->getNomdom();
    $result->bindParam(":nomdom",$nomdom);
    $result->execute();
  }
  function edit(){
    $sql="UPDATE dominio SET nomdom=:nomdom WHERE coddom=:coddom";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();    
    $result = $conexion->prepare($sql);
    $nomdom = $this->getNomdom();
    $result->bindParam(":nomdom", $nomdom);
    $coddom = $this->getCoddom();
    $result->bindParam(":coddom", $coddom);
    $result->execute();
  }
  function del() {
    $sql = "DELETE FROM dominio WHERE coddom = :coddom";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();

    try {
        $result = $conexion->prepare($sql);
        $coddom = $this->getCoddom();
        $result->bindParam(":coddom", $coddom);

        if ($result->execute()) {
            // Mensaje de éxito
            echo "<script>alert('El registro con código $coddom fue eliminado exitosamente.');</script>";
        }
    } catch (PDOException $e) {
        // Mensaje de error para excepciones
        $errorMessage = addslashes($e->getMessage()); // Evitar caracteres problemáticos
        echo "<script>alert('No se puede eliminar este dato porque está relacionado con registros en la tabla \"valor\". Por favor, elimine primero esos registros y vuelva a intentarlo.');</script>";
    }
}

}
?>