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
    function getIdusu() { return $this->idusu; }
    function getNumdoc() { return $this->numdoc; }
    function getTipdoc() { return $this->tipdoc; }
    function getNomusu() { return $this->nomusu; }
    function getApeusu() { return $this->apeusu; }
    function getTelusu() { return $this->telusu; }
    function getPasusu() { return $this->pasusu; }
    function getDirusu() { return $this->dirusu; }
    function getEdausu() { return $this->edausu; }
    function getGenusu() { return $this->genusu; }
    function getCodper() { return $this->codper; }
    function getCorusu() { return $this->corusu; }
    function getCodval() { return $this->codval; }
    function getFotper() { return $this->fotper; }

    // Métodos SET
    function setIdusu($idusu) { $this->idusu = $idusu; }
    function setNumdoc($numdoc) { $this->numdoc = $numdoc; }
    function setTipdoc($tipdoc) { $this->tipdoc = $tipdoc; }
    function setNomusu($nomusu) { $this->nomusu = $nomusu; }
    function setApeusu($apeusu) { $this->apeusu = $apeusu; }
    function setTelusu($telusu) { $this->telusu = $telusu; }
    function setPasusu($pasusu) { $this->pasusu = $pasusu; }
    function setDirusu($dirusu) { $this->dirusu = $dirusu; }
    function setEdausu($edausu) { $this->edausu = $edausu; }
    function setGenusu($genusu) { $this->genusu = $genusu; }
    function setCodper($codper) { $this->codper = $codper; }
    function setCorusu($corusu) { $this->corusu = $corusu; }
    function setCodval($codval) { $this->codval = $codval; }
    function setFotper($fotper) { $this->fotper = $fotper; }

    // Método para obtener todos los registros
    function getAll() {
        $sql = "SELECT * FROM usuario";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);

        try {
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener usuarios: " . $e->getMessage();
        }
        return $res ?? [];
    }

    // Método para obtener un usuario por ID
    public function getOne($idusu) {
        $sql = "SELECT idusu, nomusu, apeusu, numdoc, tipdoc, telusu, pasusu, dirusu,
                edausu, genusu, codper, corusu, codval, fotper 
                FROM usuario WHERE idusu = :idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);

        try {
            $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
            $result->execute();
            $res = $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener usuario: " . $e->getMessage();
        }
        return $res ?? null;
    }

    // Método para guardar un nuevo usuario
    function save() {
        $sql = "INSERT INTO usuario (numdoc, tipdoc, nomusu, apeusu, telusu, pasusu, dirusu, 
                edausu, genusu, codper, fotper) 
                VALUES (:numdoc, :tipdoc, :nomusu, :apeusu, :telusu, :pasusu, :dirusu, 
                :edausu, :genusu, :codper, :fotper)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);

        try {
            $result->bindParam(':numdoc', $this->getNumdoc());
            $result->bindParam(':tipdoc', $this->getTipdoc());
            $result->bindParam(':nomusu', $this->getNomusu());
            $result->bindParam(':apeusu', $this->getApeusu());
            $result->bindParam(':telusu', $this->getTelusu());
            $result->bindParam(':pasusu', $this->getPasusu());
            $result->bindParam(':dirusu', $this->getDirusu());
            $result->bindParam(':edausu', $this->getEdausu());
            $result->bindParam(':genusu', $this->getGenusu());
            $result->bindParam(':codper', $this->getCodper());
            $result->bindParam(':fotper', $this->getFotper());
            $result->execute();
        } catch (PDOException $e) {
            echo "Error al guardar: " . $e->getMessage();
        }
    }
    // function edit(){
     
    //     $sql="UPDATE usuina SET numdoc=:numdoc, tipdoc=:tipdoc, nomusu=:nomusu WHERE idusu=:idusu";
    //     $modelo = new conexion();
    //     $conexion = $modelo->get_conexion();    
    //     $result = $conexion->prepare($sql);
    //     $numdoc=$this->getNumdoc();
    //     $result->bindParam(':numdoc',$numdoc);
    //     $tipdoc= $this->getTipdoc();
    //     $result->bindParam(':tipdoc',$tipdoc);
    //     $nomusu= $this->getNomusu();
    //     $result->bindParam(':nomusu',$nomusu);
    //     $apeusu=$this->getApeusu();
    //     $result->bindParam(':apeusu',$apeusu);
    //     $telusu=$this->getTelusu();
    //     $result->bindParam(':telusu',$telusu);
    //     $pasusu=$this->getPasusu();
    //     $result->bindParam(':pasusu',$pasusu);
    //     $dirusu=$this->getDirusu();
    //     $result->bindParam(':dirusu',$dirusu);
    //     $edausu=$this->getEdausu();
    //     $result->bindParam(':edausu',$edausu);
    //     $genusu=$this->getGenusu();
    //     $result->bindParam(':genusu',$genusu);
    //     $codper=$this->getCodper();
    //     $result->bindParam(':codper',$codper);
    //     $result->execute(); 
    // }   
}
?>