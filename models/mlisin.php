<?php
class Mlisin {
  private $nuicie;
  private $depubi;
  private $munubi;
  private $corie;
  private $telie;

  // Métodos Getter
  public function getNuicie() {
    return $this->nuicie;
  }

  public function getDepubi() {
    return $this->depubi;
  }

  public function getMunubi() {
    return $this->munubi;
  }

  public function getCorie() {
    return $this->corie;
  }

  public function getTelie() {
    return $this->telie;
  }

  // Métodos Setter
  public function setNuicie($nuicie) {
    $this->nuicie = $nuicie;
  }

  public function setDepubi($depubi) {
    $this->depubi = $depubi;
  }

  public function setMunubi($munubi) {
    $this->munubi = $munubi;
  }

  public function setCorie($corie) {
    $this->corie = $corie;
  }

  public function setTelie($telie) {
    $this->telie = $telie;
  }

  // Método para obtener todas las instituciones
  public function getAll() {
    $res = NULL;
    $sql = "SELECT * FROM ie";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->execute();
    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  // Método para obtener una institución
  public function getOne() {
    $res = NULL;
    $sql = "SELECT * FROM ie WHERE nuicie=:nuicie";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $nuicie = $this->getNuicie();
    $result->bindParam(":nuicie", $nuicie);
    $result->execute();
    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  // Método para guardar una institución
  public function save() {
    $sql = "INSERT INTO ie (nuicie, depubi, munubi, corie, telie) VALUES (:nuicie, :depubi, :munubi, :corie, :telie)";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $nuicie = $this->getNuicie();
    $result->bindParam(":nuicie", $nuicie);
    $depubi = $this->getDepubi();
    $result->bindParam(":depubi", $depubi);
    $munubi = $this->getMunubi();
    $result->bindParam(":munubi", $munubi);
    $corie = $this->getCorie();
    $result->bindParam(":corie", $corie);
    $telie = $this->getTelie();
    $result->bindParam(":telie", $telie);
    $result->execute();
  }

  // Método para editar una institución
  public function edit() {
    $sql = "UPDATE ie SET depubi=:depubi, munubi=:munubi, corie=:corie, telie=:telie WHERE nuicie=:nuicie";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $nuicie = $this->getNuicie();
    $result->bindParam(":nuicie", $nuicie);
    $depubi = $this->getDepubi();
    $result->bindParam(":depubi", $depubi);
    $munubi = $this->getMunubi();
    $result->bindParam(":munubi", $munubi);
    $corie = $this->getCorie();
    $result->bindParam(":corie", $corie);
    $telie = $this->getTelie();
    $result->bindParam(":telie", $telie);
    $result->execute();
  }

  // Método para eliminar una institución
  public function del() {
    $sql = "DELETE FROM ie WHERE nuicie=:nuicie";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $nuicie = $this->getNuicie();
    $result->bindParam(":nuicie", $nuicie);
    $result->execute();
  }
}
?>