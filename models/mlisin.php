<?php class mlisin
{

    //atributos
    private $codie;
    private $nomie;
    private $tipie;
    private $dirie;
    private $nuicie;
    private $corie;
    private $codubi;
    private $telie;
    private $actie;

    //metodos get
    public function getCodie()
    {
        return $this->codie;
    }
    public function getNomie()
    {
        return $this->nomie;
    }
    public function getTipie()
    {
        return $this->tipie;
    }
    public function getDirie()
    {
        return $this->dirie;
    }
    public function getNuicie()
    {
        return $this->nuicie;
    }
    public function getCorie()
    {
        return $this->corie;
    }
    public function getCodubi()
    {
        return $this->codubi;
    }
    public function getTelie()
    {
        return $this->telie;
    }
    public function getActie()
    {
        return $this->actie;
    }
   

    //metodos SET_
    public function setCodie($codie)
    {
        $this->codie = $codie;
    }
    public function setNomie($nomie)
    {
        $this->nomie = $nomie;
    }
    public function setTipie($tipie)
    {
        $this->tipie = $tipie;
    }
    public function setDirie($dirie)
    {
        $this->dirie = $dirie;
    }
    public function setNuicie($nuicie)
    {
        $this->nuicie = $nuicie;
    }
    public function setCorie($corie)
    {
        $this->corie = $corie;
    }
    public function setCodubi($codubi)
    {
        $this->codubi = $codubi;
    }
    public function setTelie($telie)
    {
        $this->telie = $telie;
    }
    public function setActie($actie)
    {
        $this->actie = $actie;
    }

    public function getAll()
    {
        $res = NULL;
        $sql = "SELECT i.codie, i.nomie, i.tipie, i.dirie, i.nuicie, i.corie, i.codubi, i.telie, i.actie, u.codubi, u.munubi FROM ie AS i INNER JOIN ubicacion AS u ON i.codubi = u.codubi";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function getOne()
    {
        $res = NULL;
        $sql = "SELECT i.codie, i.nomie, i.tipie, i.dirie, i.nuicie, i.corie, i.codubi, i.telie, i.actie, u.codubi, u.munubi FROM ie AS i INNER JOIN ubicacion AS u ON i.codubi = u.codubi WHERE codie=:codie";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codie = $this->getCodie();
        $result->bindParam(":codie", $codie);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    public function getCgru()
    {
        $sql = "SELECT codubi, munubi FROM ubicacion";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function save()
    {
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();

        // Generar un código único para `codie`
        do {
            $codie = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $sqlCheck = "SELECT COUNT(*) FROM ie WHERE codie = :codie";
            $resultCheck = $conexion->prepare($sqlCheck);
            $resultCheck->bindParam(":codie", $codie);
            $resultCheck->execute();
            $exists = $resultCheck->fetchColumn();
        } while ($exists > 0);
        try {
            // Insertar el registro
            $sql = "INSERT INTO ie  (nomie, tipie, dirie, nuicie, corie, codubi, telie, actie) VALUES (:nomie, :tipie, :dirie, :nuicie, :corie, :codubi, :telie, :actie)";
            $result = $conexion->prepare($sql);
            $nomie = $this->getNomie();
            $result->bindParam(":nomie", $nomie);
            $tipie = $this->getTipie();
            $result->bindParam(":tipie", $tipie);
            $dirie = $this->getDirie();
            $result->bindParam(":dirie", $dirie);
            $nuicie = $this->getNuicie();
            $result->bindParam(":nuicie", $nuicie);
            $corie = $this->getCorie();
            $result->bindParam(":corie", $corie);
            $codubi = $this->getCodubi();
            $result->bindParam(":codubi", $codubi);
            $telie = $this->getTelie();
            $result->bindParam(":telie", $telie);
            $actie = $this->getActie();
            $result->bindParam(":actie", $actie);
            if ($result->execute()) {
                echo "<script>alert('Institución creada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al guardar la Institución. " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    public function edit()
    {
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql = "UPDATE ie SET SELECT nomie=:nomie, tipie=:tipie, dirie=:dirie, nuicie=:nuicie, corie=:corie, codubi=:cosubi, telie=:telie, actie=:actie WHERE codie=:codie";
        $result = $conexion->prepare($sql);
        $codie = $this->getCodie();
        $result->bindParam(":codie", $codie);
        $nomie = $this->getNomie();
        $result->bindParam(":nomie", $nomie);
        $tipie = $this->getTipie();
        $result->bindParam(":tipie", $tipie);
        $dirie = $this->getDirie();
        $result->bindParam(":dirie", $dirie);
        $nuicie = $this->getNuicie();
        $result->bindParam(":nuicie", $nuicie);
        $corie = $this->getCorie();
        $result->bindParam(":corie", $corie);
        $codubi = $this->getCodubi();
        $result->bindParam(":codubi", $codubi);
        $telie = $this->getTelie();
        $result->bindParam(":telie", $telie);
        $actie = $this->getActie();
        $result->bindParam(":actie", $actie);
        try {
            if ($result->execute()) {
                echo "<script>alert('Institución actualizada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al actualizar la Institución. " . addslashes($e->getMessage()) . "');</script>";
        }
    }
    function ediActie(){
        $sql = "UPDATE ie SET actie=:actie WHERE codie=:codie";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codie = $this->getCodie();
        $result->bindParam(":codie",$codie);
        $actie = $this->getActie();
        $result->bindParam(":actie",$actie);
        $result->execute(); 
    }
    public function del()
    {
        $sql = "DELETE FROM ie WHERE codie= :codie";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
       
        $result = $conexion->prepare($sql);
        $codie = $this->getCodie();
        $result->bindParam(":codie", $codie);

        try {
            if ($result->execute()) {
                echo "<script>alert('Institución eliminada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al eliminar la Institución. " . addslashes($e->getMessage()) . "');</script>";
        }
    }
}
?>
