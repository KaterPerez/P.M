<?php class Mcrgrupo{
    private $idtproy;
    private $idnomp;

    function getIdtproy(){
        return $this->idtproy;
    }
    function getIdnomp(){
        return $this->idnomp;
    }

    function setIdtproy($idtproy){
        $this->idtproy = $idtproy;
    }
    function setIdnomp($idnomp){
        $this->idnomp = $idnomp;
    }

    public function getMen(){
		$sql = "SELECT p.idtproy, p.nompag, p.rutpag, p.icopag FROM pagina AS p INNER JOIN pagper AS j ON p.idtproy=j.idtproy WHERE p.mospas=1 AND j.idnomp=:idnomp ORDER BY p.ordpag;";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idnomp = $this->getIdnomp();
		$result->bindParam(':idnomp',$idnomp);
		$result->execute();
		$res = $result ->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

    public function getVal(){
		$sql = "SELECT p.idtproy, p.nompag, p.rutpag, p.icopag, p.mospas FROM pagina AS p INNER JOIN pagper AS g ON p.idtproy=g.idtproy WHERE p.idtproy=:idtproy AND g.idnomp=:idnomp";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idnomp = $this->getIdnomp();
		$idtproy = $this->getIdtproy();
		$result->bindParam(':idnomp',$idnomp);
		$result->bindParam(':idtproy',$idtproy);
		$result->execute();
		$res = $res = $result ->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
}
?>