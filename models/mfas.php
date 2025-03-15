<?php
class Mfas{
    //Tabla proyecto
    private $codpro;
    private $nompro;
    private $tempro;
    private $inipro;
    private $finpro;
    private $idusu;
    private $codgru;
    private $codval;
    //Tabla Fase
    private $codfas;
    private $nomfas;
    private $inifas;
    private $finfas;
    //Tabla actividad
    private $codact;
    private $iniact;
    private $finact;
    // Tabla grupo
    private $nomgru;
    //Tabla Dominio
    private $coddom;
    private $nomdom;
    //Tabla valor
    private $nomval;
    //Tabla curso
    private $nomcur;

    //Metodos GET y SET proyecto
    function getCodpro(){
        return $this->codpro;
    }
    function getNompro(){
        return $this->nompro;
    }
    function getTempro(){
        return $this->tempro;
    }
    function getInipro(){
        return $this->inipro;
    }
    function getFinpro(){
        return $this->finpro;
    }
    function getIdusu(){
        return $this->idusu;
    }
    function getCodgru(){
        return $this->codgru;
    }
    function getCodval(){
        return $this->codval;
    }

    function setCodpro($codpro){
        $this->codpro=$codpro;
    }
    function setNompro($nompro){
        $this->nompro=$nompro;
    }
    function setTempro($tempro){
        $this->tempro=$tempro;
    }
    function setInipro($inipro){
        $this->inipro=$inipro;
    }
    function setFinpro($finpro){
        $this->finpro=$finpro;
    }
    function setIdusu($idusu){
        $this->idusu=$idusu;
    }
    function setCodgru($codgru){
        $this->codgru=$codgru;
    }
    function setCodval($codval){
        $this->codval=$codval;
    }

    //Metodos GET y SET fase
    function getCodfas(){
        return $this->codfas;
    }
    function getNomfas(){
        return $this->nomfas;
    }
    function getInifas(){
        return $this->inifas;
    }
    function getFinfas(){
        return $this->finfas;
    }

    function setCodfas($codfas){
        $this->codfas=$codfas;
    }
    function setNomfas($nomfas){
        $this->nomfas=$nomfas;
    }
    function setInifas($inifas){
        $this->inifas=$inifas;
    }
    function setFinfas($finfas){
        $this->finfas=$finfas;
    }

    //Metodos GET y SET actividad
    function getCodact(){
        return $this->codact;
    }
    function getIniact(){
        return $this->iniact;
    }
    function getFinact(){
        return $this->finact;
    }
    
    function setCodact($codact){
        $this->codact=$codact;
    }
    function setIniact($iniact){
        $this->iniact=$iniact;
    }
    function setFinact($finact){
        $this->finact=$finact;
    }

    // Metodos GET y SET grupo
    function getNomgru(){
        return $this->nomgru;
    }

    function setNomgru($nomgru){
        $this->nomgru=$nomgru;
    }

    //Metodo GET y SET dominio
    function getCoddom(){
        return $this->coddom;
    }
    function getNomdom(){
        return $this->nomdom;
    }

    function setCoddom($coddom){
        $this->coddom=$coddom;
    }
    function setNomdom($nomdom){
        $this->nomdom=$nomdom;
    }
    //Metodo GET y SEt valor
    function getNomval(){
        return $this->nomval;
    }

    function setNomval($nomval){
        $this->nomval=$nomval;
    }
    //Metodo GET y SET curso
    function getNomcur(){
        return $this->nomcur;
    }

    function setNomcur($nomcur){
        $this->nomcur=$nomcur;
    }
    


    function getAll(){
        $res = NULL;
        $sql = "SELECT p.codpro, p.nompro, p.tempro, p.inipro, p.finpro, p.idusu, p.codgru, p.codval, f.codfas, f.nomfas, f.inifas, f.finfas, a.codact, a.iniact, a.finact, g.nomgru FROM grupo AS g INNER JOIN proyecto AS p ON g.codgru = p.codgru LEFT JOIN fase AS f ON p.codpro = f.codpro INNER JOIN actividad AS a ON f.codfas = a.codfas";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res= $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getOne(){
        $res = NULL;
        $sql = "SELECT p.codpro, p.nompro, p.tempro, p.inipro, p.finpro, p.idusu, p.codgru, p.codval, f.codfas, f.nomfas, f.inifas, f.finfas, a.codact, a.iniact, a.finact, g.nomgru FROM grupo AS g INNER JOIN proyecto AS p ON g.codgru = p.codgru LEFT JOIN fase AS f ON p.codpro = f.codpro INNER JOIN actividad AS a ON f.codfas = a.codfas WHERE p.codpro = p.codgru";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion(); 
            $result = $conexion->prepare($sql);
            $result->execute(); 
            $res = $result->fetchAll(PDO::FETCH_ASSOC); 
            return $res;
    }

    //funciones CRUD tabla grupo
    function saveg(){
        $sql = "INSERT INTO grupo(nomgru) VALUES (:nomgru)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $nomgru = $this->getNomgru();
        $result->bindParam(':nomgru', $nomgru);
        try {
            $result->execute();
            return $conexion->lastInsertId(); 
        }catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    function editg(){
        try{
            $sql="UPDATE grupo SET nomgru=:nomgru WHERE codgru=:codgru";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();    
            $result = $conexion->prepare($sql);
            $nomgru = $this->getNomgru();
            $result->bindParam(':nomgru', $nomgru);
            $result->execute();
        }catch(Exception $e){
            ManejoError($e);
        }
    }
    function delg(){
        try{
            $sql="DELETE FROM grupo WHERE codgru=:codgru";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $codgru = $this->getCodgru();
            $result->bindParam(":codgru", $codgru);
            $result->execute();
        }catch(Exception $e){
            ManejoError($e);
        }
    }
    function curgrup(){
        try{
            $sql="SELECT nomcur FROM curso";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomcur = $this->getNomcur();
            $result->bindParam(":nomcur", $nomcur);
            $result->execute();
        }catch(Exception $e){
        
        }
    }
    function estcurg(){
        try{
            $sql="SELECT u.idusu, u.nomusu, c.codcur FROM usuario AS u INNER JOIN curso AS c ON u.idusu=c.idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomcur = $this->getNomcur();
            $result->bindParam(":nomcur", $nomcur);
            $result->execute();
        }catch(Exception $e){
         
        }
    }
//funciones CRUD tabla proyecto
    function savep(){
        $sql = "INSERT INTO proyecto(nompro, tempro, inipro, finpro) VALUES (:nompro, :tempro, :inipro, :finpro)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $nompro = $this->getNompro();
        $result->bindParam(':nompro', $nompro);
        $tempro = $this->getTempro();
        $result->bindParam(':tempro', $tempro);
        $inipro = $this->getInipro();
        $result->bindParam(':inipro', $inipro);
        $finpro = $this->getFinpro();
        $result->bindParam(':finpro', $finpro);
        try {
            $result->execute();
            return $conexion->lastInsertId(); 
        }catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    function editp(){
        try{
            $sql="UPDATE proyecto SET nompro=:nompro, tempro=:tempro, inipro=:inipro, finpro=:finpro WHERE codpro :codpro";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();    
            $result = $conexion->prepare($sql);
            $nompro = $this->getnompro();
            $result->bindParam(":nompro", $nompro);
            $inipro = $this->getinipro();
            $result->bindParam(":inipro",$inipro);
            $tempro = $this->gettempro();
            $result->bindParam(":tempro",$tempro);
            $finpro = $this->getfinpro();
            $result->bindParam(":finpro",$finpro);
            $result->execute();
        }catch(Exception $e){
            
        }
    }
    function delp(){
        try{
            $sql="DELETE FROM proyecto WHERE codpro=:codpro";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $codpro = $this->getCodpro();
            $result->bindParam(":codpro", $codpro);
            $result->execute();
        }catch(Exception $e){
         
        }
    }
    function tempro(){
        try{
            $sql="SELECT  c.coddom, v.nomval FROM dominio AS c INNER JOIN valor AS v ON c.coddom=v.coddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $tempro = $this->getTempro();
            $result->bindParam(":tempro", $tempro);
            $result->execute();
        }catch(Exception $e){
           
        }
    }
//funciones CRUD tabla fase
    function savef(){
        $sql = "INSERT INTO fase(nomfas, inifas, finfas) VALUES (:nomfas, :inifas, :finfas)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $nomfas = $this->getNomfas();
        $result->bindParam(':nomfas', $nomfas);
        $inifas = $this->getInifas(); 
        $result->bindParam(':inifas', $inifas);
        $finfas = $this->getFinfas();
        $result->bindParam(':finfas', $finfas);
        try {
            $result->execute();
            return $conexion->lastInsertId(); 
        }catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    function editf(){
        try{
            $sql="UPDATE fase SET nomfas=:nomfas, inifas=:inifas, finfas=:finfas WHERE codfas=:codfas";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();    
            $result = $conexion->prepare($sql);
            $nomfas = $this->getNomfas();
            $result->bindParam(":nomfas", $nomfas);
            $inifas = $this->getInifas();
            $result->bindParam(":inifas",$inifas);
            $finfas = $this->getFinfas();
            $result->bindParam(":finfas",$finfas);
            $result->execute();
        }catch(Exception $e){
          
        }
    }
    function delf(){
        try{
            $sql="DELETE FROM fase WHERE codfas=:codfas";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $codfas = $this->getCodfas();
            $result->bindParam(":codfas", $codfas);
            $result->execute();
        }catch(Exception $e){
           
        }
    }
//funciones CRUD tabla actividad 
    function savea(){
        $sql = "INSERT INTO actividad(nomact, iniact, finact) VALUES (:nomact, :iniact, :finact)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $nomact = $this->getNomact();
        $result->bindParam(':nomact', $nomact);
        $iniact = $this->getIniact();
        $result->bindParam(':iniact', $iniact);
        $finact = $this->getFinact();
        $result->bindParam(':finact', $finact);
        try {
            $result->execute();
            return $conexion->lastInsertId(); 
        }catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    function edita(){
        try{
            $sql="UPDATE actividad SET nomact=:nomact iniact=:iniact finact=:finact  WHERE codact=:codact";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();    
            $result = $conexion->prepare($sql);
            $nomact = $this->getNomact();
            $result->bindParam(":nomact", $nomact);
            $iniact = $this->getIniact();
            $result->bindParam(":iniact",$iniact);
            $finact = $this->getFinact();
            $result->bindParam(":finact",$finact);
            $result->execute();
        }catch(Exception $e){
            
        }
    }
    function dela(){
        try{
            $sql="DELETE FROM actividad WHERE codact=:codact";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $codact = $this->getCodact();
            $result->bindParam(":codact", $codact);
            $result->execute();
        }catch(Exception $e){
            
        }
    }
}