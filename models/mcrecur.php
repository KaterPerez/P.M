<?php 
class Mcrecur {

    private $idcur;
    private $codcur;
    private $nomcur;
    private $idusu;

    // GET y SET para la tabla CURSOS
    function getIdcur() {
        return $this->idcur;
    }
    function getCodcur() {
        return $this->codcur;
    }
    function getNomcur() {
        return $this->nomcur;
    }
    function getIdusu() {
        return $this->idusu;
    }
    function setIdcur($idcur) {
        $this->idcur = $idcur;
    }
    function setCodcur($codcur) {
        $this->codcur = $codcur;
    }
    function setNomcur($nomcur) {
        $this->nomcur = $nomcur;
    }
    function setIdusu($idusu) {
        $this->idusu = $idusu;
    }

    // Método para obtener un solo curso
    function getOne() {
        $res = NULL;
        $sql = "SELECT idcur, codcur, nomcur, idusu FROM curso WHERE idcur = :idcur";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idcur = $this->getIdcur();
        $result->bindParam(":idcur", $idcur);
        $result->execute(); 
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Método para obtener todos los cursos
    function getAll() {
        $res = NULL;
        $sql = "SELECT idcur, codcur, nomcur, idusu FROM curso";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Método para guardar un nuevo curso
    function save() {
        $sql = "INSERT INTO curso (idcur, codcur, nomcur, idusu) VALUES (:idcur, :codcur, :nomcur, :idusu)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idcur = $this->getIdcur();
        $result->bindParam(':idcur', $idcur);
        $codcur = $this->getCodcur();
        $result->bindParam(':codcur', $codcur);
        $nomcur = $this->getNomcur();      
        $result->bindParam(':nomcur', $nomcur);
        $idusu = $this->getIdusu();
        $result->bindParam(':idusu', $idusu);
        $result->execute();      
    }

    // Método para editar un curso
    function edit() {
        $sql = "UPDATE curso SET nomcur = :nomcur, codcur = :codcur WHERE idcur = :idcur";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();    
        $result = $conexion->prepare($sql);
        $idcur = $this->getIdcur();
        $result->bindParam(':idcur', $idcur);
        $nomcur = $this->getNomcur();
        $result->bindParam(':nomcur', $nomcur);
        $codcur = $this->getCodcur();
        $result->bindParam(':codcur', $codcur);
        $result->execute();
    }

    // Método para eliminar un curso
    function del() {
        $sql = "DELETE FROM curso WHERE idcur = :idcur";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idcur = $this->getIdcur();
        $result->bindParam(":idcur", $idcur);
        $result->execute();
    }

    // Obtener estudiantes no asignados con codper = 4
    public function getAvailableStudentsWithCodper($idcur, $codper) {
        $sql = "SELECT u.idusu, u.numdoc, u.nomusu, u.apeusu, u.corusu 
                FROM usuario AS u 
                WHERE u.codper = :codper 
                AND u.idusu NOT IN (
                    SELECT uc.idusu FROM usuxcur AS uc WHERE uc.idcur = :idcur
                )";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":codper", $codper, PDO::PARAM_INT);
        $result->bindParam(":idcur", $idcur, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estudiantes asignados a un curso
    public function getAssignedStudents($idcur) {
        $sql = "SELECT u.idusu, u.numdoc, u.nomusu, u.apeusu, u.corusu 
                FROM usuario AS u 
                INNER JOIN usuxcur AS uc ON u.idusu = uc.idusu 
                WHERE uc.idcur = :idcur";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idcur", $idcur, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Asignar un estudiante a un curso
    public function assignStudentsToCourse($idcur, $idusu) {
        $sql = "INSERT INTO usuxcur (idcur, idusu) VALUES (:idcur, :idusu)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idcur", $idcur, PDO::PARAM_INT);
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
    }

    // Quitar un estudiante de un curso
    public function removeStudentFromCourse($idcur, $idusu) {
        $sql = "DELETE FROM usuxcur WHERE idcur = :idcur AND idusu = :idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idcur", $idcur, PDO::PARAM_INT);
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
    }
}
?>
