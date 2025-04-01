<?php class Mact
{
    //atributos
    private $codact;
    private $nomact;
    private $desact;
    private $codfas;
    private $iniact;
    private $finact;
    private $archivo;

public function getArchivo() {
    return $this->archivo;
}

public function setArchivo($archivo) {
    $this->archivo = $archivo;
}


    //metodos get
    public function getCodact()
    {
        return $this->codact;
    }
    public function getNomact()
    {
        return $this->nomact;
    }
    public function getDesact()
    {
        return $this->desact;
    }
    public function getCodfas()
    {
        return $this->codfas;
    }
    public function getIniact()
    {
        return $this->iniact;
    }
    public function getFinact()
    {
        return $this->finact;
    }
    //metodos SET
    public function setCodact($codact)
    {
        $this->codact = $codact;
    }
    public function setNomact($nomact)
    {
        $this->nomact = $nomact;
    }
    public function setDesact($desact)
    {
        $this->desact = $desact;
    }
    public function setCodfas($codfas)
    {
        $this->codfas = $codfas;
    }
    public function setIniact($iniact)
    {
        $this->iniact = $iniact;
    }
    public function setFinact($finact)
    {
        $this->finact = $finact;
    }

    //metodos publicos
    public function getAll()
    {
        $modelo = new conexion();
        $conexion = $modelo->get_Conexion();
        $sql = "SELECT a.codact, a.nomact, a.desact, a.codfas, a.iniact, a.finact, a.archivo, f.nomfas 
                FROM actividad a 
                INNER JOIN fase f ON a.codfas = f.codfas";
        $result = $conexion->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOne()
    {
        $res = NULL;
        $sql = "SELECT a.codact, a.nomact, a.desact, a.codfas, a.iniact, a.finact, f.codfas, f.nomfas FROM actividad AS a INNER JOIN fase AS f ON a.codfas = f.codfas WHERE a.codact=:codact";
        $modelo = new conexion();
        $conexion = $modelo->get_Conexion();
        $result = $conexion->prepare($sql);
        $codact = $this->getCodact();
        $result->bindParam(":codact", $codact);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getFases()
    {
        $res = NULL;
        $sql = "SELECT codfas, nomfas FROM fase"; 
        $modelo = new conexion();
        $conexion = $modelo->get_Conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    public function save()
{
    $modelo = new conexion();
    $conexion = $modelo->get_Conexion();
    try {
        $sql = "INSERT INTO actividad (nomact, desact, codfas, iniact, finact, archivo) 
                VALUES (:nomact, :desact, :codfas, :iniact, :finact, :archivo)";
        $result = $conexion->prepare($sql);
        $result->bindParam(":archivo", $this->archivo);
        $result->bindParam(":nomact", $this->nomact);
        $result->bindParam(":desact", $this->desact);
        $result->bindParam(":codfas", $this->codfas);
        $result->bindParam(":iniact", $this->iniact);
        $result->bindParam(":finact", $this->finact);
        
        if ($result->execute()) {
            echo "<script>alert('Actividad creada exitosamente.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert(Error al guardar la actividad);</script>";
    }
}

public function edit()
{
    $modelo = new conexion();
    $conexion = $modelo->get_Conexion();
    try {
        $sql = "UPDATE actividad SET nomact=:nomact, desact=:desact, codfas=:codfas, iniact=:iniact, finact=:finact, archivo=:archivo WHERE codact=:codact";
        $result = $conexion->prepare($sql);
        $result->bindParam(":archivo", $this->archivo);
        $result->bindParam(":codact", $this->codact);
        $result->bindParam(":nomact", $this->nomact);
        $result->bindParam(":desact", $this->desact);
        $result->bindParam(":codfas", $this->codfas);
        $result->bindParam(":iniact", $this->iniact);
        $result->bindParam(":finact", $this->finact);
        
        if ($result->execute()) {
            echo "<script>alert('Actividad actualizada exitosamente.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert(Error al actualizar la actividad);</script>";
    }
}
    public function del()
    {
        $sql = "DELETE FROM actividad WHERE codact= :codact";
        $modelo = new conexion();
        $conexion = $modelo->get_Conexion();

        $result = $conexion->prepare($sql);
        $codact = $this->getCodact();
        $result->bindParam(":codact", $codact);

        try {
            if ($result->execute()) {
                echo "<script>alert('Actividad eliminada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al eliminar la Actividad: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
}
?>
