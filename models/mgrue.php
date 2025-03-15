<?php
class Mgrue{
    //Tabla grupo
    private $codgru;
    private $nomgru;
    private $idusu;
    //Tabla usuario
    private $codubi;
    private $numdoc;
    private $tipdoc;
    private $nomusu;
    private $apeusu;
    private $corusu;
    private $telusu;
    private $pasusu;
    private $dirusu;
    private $edausu;
    private $genusu;
    private $codper;
    private $codval;
    //Tabla proyecto 
    private $codpro;
    private $nompro;
    private $tempro;
    private $inipro;
    private $finpro;

    //Metodos GET y SET grupo
    function getCodgru(){
        return $this->codgru;
    }
    function getNomgru(){
        return $this->nomgru;
    }
    function getIdusu(){
        return $this->idusu;
    }

    function setCodgru($codgru){
        $this->codgru=$codgru;
    }
    function setNomgru($nomgru){
        $this->nomgru=$nomgru;
    }
    function setIdusu($idusu){
        $this->idusu=$idusu;
    }

    //Metodos GET y SET usuario
    function getCodubi(){
        return $this->codubi;
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

    function setCodubi($codubi){
        $this->codubi=$codubi;
    }
    function setNumdoc($numdoc){
        $this->numdoc=$numdoc;
    }
    function setTipdoc($tipdoc){
        $this->tipdoc=$tipdoc;
    }
    function setNomusu($nomusu){
        $this->nomusu=$nomusu;
    }
    function setApeusu($apeusu){
        $this->apeusu=$apeusu;
    }
    function setCorusu($corusu){
        $this->corusu=$corusu;
    }
    function setTelusu($telusu){
        $this->telusu=$telusu;
    }
    function setPasusu($pasusu){
        $this->pasusu=$pasusu;
    }
    function setDirusu($dirusu){
        $this->dirusu=$dirusu;
    }
    function setEdausu($edausu){
        $this->edausu=$edausu;
    }
    function setGenusu($genusu){
        $this->genusu=$genusu;
    }
    function setCodper($codper){
        $this->codper=$codper;
    }
    function setCodval($codval){
        $this->codval=$codval;
    }

    //Metodos GET y SET proyecto 
    function getcodpro(){
        return $this->codpro;
    }
    function getnompro(){
        return $this->nompro;
    }
    function gettempro(){
        return $this->tempro;
    }
    function getinipro(){
        return $this->inipro;
    }
    function getfinpro(){
        return $this->finpro;
    }

    function setCodubi($codpro){
        $this->codpro=$codpro;
    }
    function setCodubi($nompro){
        $this->nompro=$nompro;
    }
    function setCodubi($tempro){
        $this->tempro=$tempro;
    }
    function setCodubi($inipro){
        $this->inipro=$inipro;
    }
    function setCodubi($finpro){
        $this->finpro=$finpro;
    }



    function getAll(){
        $res = NULL;
        $sql = "";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOne(){
        $res = NULL;
        $sql = "";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codgru = $this->getCodfas();
        $result->bindParam(":codgru", $codgru);
        $result->execute(); 
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }








    public function guardarGrupo($curso, $nombreGrupo, $cantidadIntegrantes, $integrantes) {
        $stmt = $this->db->prepare("INSERT INTO grupos (curso, nombre_grupo, cantidad_integrantes) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $curso, $nombreGrupo, $cantidadIntegrantes);
        $stmt->execute();
        $grupoId = $stmt->insert_id;

        foreach ($integrantes as $integrante) {
            $stmtIntegrante = $this->db->prepare("INSERT INTO integrantes (grupo_id, nombre_integrante) VALUES (?, ?)");
            $stmtIntegrante->bind_param("is", $grupoId, $integrante);
            $stmtIntegrante->execute();
        }
    }

    public function obtenerGrupos() {
        $stmt = $this->db->prepare("SELECT * FROM grupos");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminarGrupo($id) {
        $stmt = $this->db->prepare("DELETE FROM grupos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}