<?php
include_once(__DIR__ . "/conexion.php"); // Asegúrate de que la ruta sea correcta.

class Mper {
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
    private $fotper;

    // Métodos GET
    function getIdusu() { 
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
    function getFotper(){ 
        return $this->fotper;
     }

    // Métodos SET
    function setIdusu($idusu) {
         $this->idusu = $idusu; 
    }
    function setNumdoc($numdoc) {
         $this->numdoc = $numdoc; 
    }
    function setTipdoc($tipdoc) {
         $this->tipdoc = $tipdoc; 
    }
    function setNomusu($nomusu) {
         $this->nomusu = $nomusu; 
    }
    function setApeusu($apeusu) {
         $this->apeusu = $apeusu; 
    }
    function setTelusu($telusu) {
         $this->telusu = $telusu; 
    }
    function setPasusu($pasusu) {
         $this->pasusu = $pasusu; 
    }
    function setDirusu($dirusu) {
         $this->dirusu = $dirusu; 
    }
    function setEdausu($edausu) {
         $this->edausu = $edausu; 
    }
    function setGenusu($genusu) {
         $this->genusu = $genusu; 
    }
    function setCodper($codper) {
         $this->codper = $codper; 
    }
    function setCorusu($corusu) {
         $this->corusu = $corusu; 
    }
    function setCodval($codval) {
         $this->codval = $codval; 
    }
    function setFotper($fotper) {
         $this->fotper = $fotper; 
    }

    // Método para obtener todos los registros
    function getAll() {
        $sql = "SELECT * FROM usuario";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Método para obtener un usuario por ID
    public function getOne($idusu) {
        $sql = "SELECT idusu, nomusu, apeusu, numdoc, tipdoc, telusu, pasusu, dirusu,
                edausu, genusu, codper, corusu, codval, fotper 
                FROM usuario WHERE idusu = :idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    // Método para guardar un nuevo usuario
    public function save() {
        $sql = "INSERT INTO usuario (fotper) 
                VALUES (:fotper)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $fotper = $this->getFotper();
        $result->bindParam(':fotper', $fotper);
        $result->execute();
    }

    public function edit() {
        $sql = "UPDATE usuario SET  fotper = :fotper WHERE idusu = :idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $fotper = $this->getFotper();
        $result->bindParam(':fotper', $fotper);
        $idusu = $this->getIdusu();
        $result->bindParam(':idusu', $idusu);   
            try {
                $result->execute();
            } catch (PDOException $e) {
                error_log("Error al actualizar: " . $e->getMessage());
                throw new Exception("Error al actualizar: " . $e->getMessage());
            }
        }
}
?>