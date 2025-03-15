<?php 
class Mcrecur{
    private $codcur;
    private $nomcur;
    private $idusu;

    //GET Y SET TABLA CURSOS
    function getCodcur(){
        return $this->codcur;
    }
    function getNomcur(){
        return $this->nomcur;
    }
    function getIdusu(){
        return $this->idusu;
    }

    function setCodcur($codcur){
        $this->codcur = $codcur;
    }
    function setNomcur($nomcur){
        $this->nomcur = $nomcur;
    }
    function setIdusu ($idusu){
        $this->idusu = $idusu;
    }

    // Método para obtener un solo curso
    function getOne(){
        $res = NULL;
        $sql = "SELECT codcur, nomcur, idusu FROM curso WHERE codcur=:codcur";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codcur = $this->getCodcur();
        $result->bindParam(":codcur", $codcur);
        $result->execute(); 
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Método para obtener todos los cursos
    function getAll(){
        $res= NULL;
        $sql = "SELECT codcur, nomcur, idusu FROM curso";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Método para guardar un nuevo curso
    function savec(){
        $sql = "INSERT INTO curso(nomcur, codcur, idusu) VALUES (:nomcur, :codcur, :idusu)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codcur = $this->getCodcur();
        $result->bindParam(':codcur', $codcur);
        $nomcur = $this->getNomcur();      
        $result->bindParam(':nomcur', $nomcur);
        $idusu = $this->getIdusu();
        $result->bindParam(':idusu', $idusu);
        try {
            $result->execute();
            return $conexion->lastInsertId(); 
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Método para editar un curso
    function editc(){
        try {
            $sql = "UPDATE curso SET nomcur=:nomcur WHERE codcur=:codcur";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();    
            $result = $conexion->prepare($sql);
            $nomcur = $this->getNomcur();
            $result->bindParam(':nomcur', $nomcur);
            $codcur = $this->getCodcur();
            $result->bindParam(':codcur', $codcur);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    // Método para eliminar un curso
    function delc(){
        try {
            $sql = "DELETE FROM curso WHERE codcur=:codcur";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $codcur = $this->getCodcur();
            $result->bindParam(":codcur", $codcur);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

//     // Método para obtener los estudiantes (ajustado para devolver los resultados)
//     function estc(){
//         try {
//             $sql = "SELECT nomusu, codper,idusu,apeusu FROM usuario WHERE codper=4";
//             $modelo = new conexion();
//             $conexion = $modelo->get_conexion();
//             $result = $conexion->prepare($sql);
//             $result->execute();
//             return $result->fetchAll(PDO::FETCH_ASSOC); // Retornamos los datos para usar en la vista
//         } catch (Exception $e) {
//             ManejoError($e);
//         }
//     }
//         // Método para obtener estudiantes de un curso específico
//         function getEstudiantesPorCurso() {
//             $res = NULL;
//             $sql = "SELECT u.nomusu FROM usuario u INNER JOIN usuxcur cu ON u.idusu = cu.idusu WHERE cu.codcur = :codcur";
//             $modelo = new conexion();
//             $conexion = $modelo->get_conexion();
//             $result = $conexion->prepare($sql);
//             $codcur = $this->getCodcur();
//             $result->bindParam(":codcur", $codcur);
//             $result->execute();
//             $res = $result->fetchAll(PDO::FETCH_ASSOC);
//             return $res;
//         }
    
 }
?>
