<?php
class Mgrue {
    
    private $idgru;      
    private $nomgru;
    private $idusu;  
    
    function getIdgru(){
        return $this->idgru;
    }
    function getNomgru(){
        return $this->nomgru;
    }    
    function getIdusu() {
        return $this->idusu;
    }
    function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    function setIdgru($idgru){
        $this->idgru = $idgru;
    }
    function setNomgru($nomgru){
        $this->nomgru = $nomgru;
    } 
    
    function getOne() {
        $res = NULL;
        $sql = "SELECT idgru, nomgru, idusu FROM grupo WHERE idgru = :idgru";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idgru = $this->getIdgru();
        $result->bindParam(":idgru", $idgru);
        $result->execute(); 
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function getAll() {
        $res = NULL;
        $sql = "SELECT idgru, nomgru, idusu FROM grupo";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function save() {
        $sql = "INSERT INTO grupo (idgru, nomgru, idusu) VALUES (:idgru, :nomgru, :idusu)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idgru = $this->getIdgru();
        $result->bindParam(':idgru', $idgru);
        $nomgru = $this->getNomgru();      
        $result->bindParam(':nomgru', $nomgru);
        $idusu = $this->getIdusu();
        $result->bindParam(':idusu', $idusu);
        $result->execute();      
    }
    function edit() {
        $sql = "UPDATE grupo SET nomgru = :nomgru WHERE idgru = :idgru";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $idgru = $this->getIdgru();
        $result->bindParam(':idgru', $idgru);
        $nomgru = $this->getNomgru();
        $result->bindParam(':nomgru', $nomgru);
        $result->execute();
    }
    function del() {
        $sql = "DELETE FROM grupo WHERE idgru = :idgru";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idgru = $this->getIdgru();
        $result->bindParam(":idgru", $idgru);
        $result->execute();
    }
    public function getAvailableStudentsWithCodper($idgru, $codper) {
        $sql = "SELECT u.idusu, u.numdoc, u.nomusu, u.apeusu, u.corusu 
                FROM usuario AS u 
                WHERE u.codper = :codper 
                AND u.idusu NOT IN (
                    SELECT uc.idusu FROM usuxgru AS uc WHERE uc.idgru = :idgru
                )";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idgru", $idgru, PDO::PARAM_INT);
        $result->bindParam(":codper", $codper, PDO::PARAM_INT); // Agregar este parámetro
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estudiantes asignados a un curso
    public function getAssignedStudents($idgru) {
        $sql = "SELECT u.idusu, u.numdoc, u.nomusu, u.apeusu, u.corusu 
                FROM usuario AS u 
                INNER JOIN usuxgru AS uc ON u.idusu = uc.idusu 
                WHERE uc.idgru = :idgru";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idgru", $idgru, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Asignar un estudiante a un curso
    public function assignStudentsToCourse($idgru, $idusu) {
        $sql = "INSERT INTO usuxgru (idgru, idusu) VALUES (:idgru, :idusu)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idgru", $idgru, PDO::PARAM_INT); // Se usa $idgru en vez de $idcur
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
    }

    // Quitar un estudiante de un curso
    public function removeStudentFromCourse($idgru, $idusu) {
        $sql = "DELETE FROM usuxgru WHERE idgru = :idgru AND idusu = :idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idgru", $idgru, PDO::PARAM_INT); // Corregir variable
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
    }
    public function getStudentCourse($idusu) {
        $sql = "SELECT g.nomcur 
                FROM curso g
                INNER JOIN usuxcur ug ON g.idcur = ug.idcur
                WHERE ug.idusu = :idusu
                LIMIT 1"; // Tomamos un solo resultado si está en varios grupos
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
?>
