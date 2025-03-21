<?php
class Mregtd{
    //Tabla usuario
    private $idusu;
    private $numdoc;
    private $tipdoc;
    private $nomusu;
    private $apeusu;
    private $actusu;
    private $corusu;
    private $telusu;
    private $pasusu;
    private $dirusu;
    private $edausu;
    private $genusu;
    private $codper;
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
    function getActusu(){
        return $this->actusu;
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
    function setActusu($actusu){
        $this->actusu = $actusu;
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
        $this->codper = $codper;
    }
    function setCodval($codval){
        $this->codval = $codval;
    }
    function getAll(){
        $sql = "SELECT idusu, numdoc, tipdoc, nomusu, apeusu, actusu, corusu, telusu, pasusu, dirusu,
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
        $sql = "SELECT idusu, numdoc, tipdoc, nomusu, apeusu, actusu, corusu, telusu, pasusu, dirusu,
        edausu, genusu, codper, codval FROM usuario WHERE idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);    
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu", $idusu);       
        $result->execute(); 
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function save() {
        $sql = "INSERT INTO usuario (numdoc, tipdoc, nomusu, apeusu, actusu, corusu, telusu, pasusu, dirusu, edausu, genusu, codper) 
                VALUES (:numdoc, :tipdoc, :nomusu, :apeusu, :actusu, :corusu, :telusu, :pasusu, :dirusu, :edausu, :genusu, :codper)";
        
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        
        $numdoc = $this->getNumdoc();
        $result->bindParam(':numdoc', $numdoc);
        $tipdoc = $this->getTipdoc();
        $result->bindParam(':tipdoc', $tipdoc);
        $nomusu = $this->getNomusu();
        $result->bindParam(':nomusu', $nomusu);
        $apeusu = $this->getApeusu();
        $result->bindParam(':apeusu', $apeusu);
        $actusu = $this->getActusu();
        $result->bindParam(':actusu', $actusu);
        $corusu = $this->getCorusu();
        $result->bindParam(':corusu', $corusu);
        $telusu = $this->getTelusu();
        $result->bindParam(':telusu', $telusu);
        $pasusu = sha1(md5($this->getPasusu())); // Encriptar contraseña
        $result->bindParam(':pasusu', $pasusu);
        $dirusu = $this->getDirusu();
        $result->bindParam(':dirusu', $dirusu);
        $edausu = $this->getEdausu();
        $result->bindParam(':edausu', $edausu);
        $genusu = $this->getGenusu();
        $result->bindParam(':genusu', $genusu);
        $codper = $this->getCodper();
        $result->bindParam(':codper', $codper);

        try {
            // Intentar ejecutar la consulta
            if ($result->execute()) {
                // Mensaje de éxito
                echo "<script>
                        alert('Datos guardados exitosamente');
                      </script>";
            }
        } catch (PDOException $e) {
            // Manejo de errores si ocurre una excepción
            $errorMessage = addslashes($e->getMessage()); // Evitar caracteres problemáticos
            // Si el error es de tipo duplicado de datos
            if ($e->getCode() == 23000) {
                echo "<script>
                        alert('Estos datos ya están registrados');
                      </script>";
            } else {
                // Mensaje de error genérico
                echo "<script>
                        alert('Error: $errorMessage');
                      </script>";
            }
        }
    }

    // Otros métodos (edit, del, etc.) pueden manejarse de manera similar

    function edit() {
        $sql = "UPDATE usuario SET numdoc=:numdoc, tipdoc=:tipdoc, nomusu=:nomusu, apeusu=:apeusu, corusu=:corusu, 
                telusu=:telusu, pasusu=:pasusu, dirusu=:dirusu, edausu=:edausu, genusu=:genusu, actusu=:actusu, codper=:codper WHERE idusu=:idusu";
        
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        
        $numdoc = $this->getNumdoc();
        $result->bindParam(':numdoc', $numdoc);
        $tipdoc = $this->getTipdoc();
        $result->bindParam(':tipdoc', $tipdoc);
        $nomusu = $this->getNomusu();
        $result->bindParam(':nomusu', $nomusu);
        $apeusu = $this->getApeusu();
        $result->bindParam(':apeusu', $apeusu);
        $actusu = $this->getActusu();
        $result->bindParam(':actusu', $actusu);
        $corusu = $this->getCorusu();
        $result->bindParam(':corusu', $corusu);
        $telusu = $this->getTelusu();
        $result->bindParam(':telusu', $telusu);
        $pasusu = sha1(md5($this->getPasusu())); // Encriptar contraseña
        $result->bindParam(':pasusu', $pasusu);
        $dirusu = $this->getDirusu();
        $result->bindParam(':dirusu', $dirusu);
        $edausu = $this->getEdausu();
        $result->bindParam(':edausu', $edausu);
        $genusu = $this->getGenusu();
        $result->bindParam(':genusu', $genusu);
        $codper = $this->getCodper();
        $result->bindParam(':codper', $codper);
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu", $idusu);

        try {
            if ($result->execute()) {
                // Mensaje de éxito
                echo "<script>
                        alert('Datos actualizados exitosamente');
                      </script>";
            }
        } catch (PDOException $e) {
            $errorMessage = addslashes($e->getMessage()); // Evitar caracteres problemáticos
            echo "<script>
                    alert('Error al actualizar los datos: $errorMessage');
                  </script>";
        }
    }

    function del() {
        $sql = "DELETE FROM usuario WHERE idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu", $idusu);

        try {
            if ($result->execute()) {
                // Mensaje de éxito
                echo "<script>
                        alert('Datos eliminados exitosamente');
                      </script>";
            }
        } catch (PDOException $e) {
            // Mensaje de error para fallos
            $errorMessage = addslashes($e->getMessage()); // Evitar caracteres problemáticos
            echo "<script>
                    alert('Error al eliminar los datos: $errorMessage');
                  </script>";
        }
    }

    function ediActusu(){
        $sql = "UPDATE usuario SET actusu=:actusu WHERE idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu",$idusu);
        $actusu = $this->getActusu();
        $result->bindParam(":actusu",$actusu);
        $result->execute(); 
    }
    function editCodper() {
        $sql = "UPDATE usuario SET codper=:codper WHERE idusu=:idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idusu = $this->getIdusu();
        $codper = $this->getCodper();
        $result->bindParam(":idusu", $idusu);
        $result->bindParam(":codper", $codper);
        $result->execute();
    }
    
}
?>