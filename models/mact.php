<?php class Mact
{
    //atributos
    private $codact;
    private $nomact;
    private $desact;
    private $codfas;
    private $iniact;
    private $finact;


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
        $res = NULL;
        // Modificación de la consulta para incluir el nombre del grupo vinculado al proyecto
        $sql = "SELECT a.codact, a.nomact, a.desact, a.codfas, a.iniact, a.finact, f.codfas, f.nomfas FROM actividad AS a INNER JOIN fase AS f ON a.codfas = f.codfas";  // Relación entre proyecto y grupo
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
        $sql = "SELECT a.codact, a.nomact, a.desact, a.codfas, a.iniact, a.finact, f.codfas, f.nomfas FROM actividad AS a INNER JOIN fase AS f ON a.codfas = f.codfas WHERE a.codact=:codact";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codact = $this->getCodact();
        $result->bindParam(":codact", $codact);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getCpro()
    {
        $sql = "SELECT codfas, nomfas FROM fase";
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

        // Generar un código único para `codact`
        do {
            $codact = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $sqlCheck = "SELECT COUNT(*) FROM actividad WHERE codact = :codact";
            $resultCheck = $conexion->prepare($sqlCheck);
            $resultCheck->bindParam(":codact", $codact);
            $resultCheck->execute();
            $exists = $resultCheck->fetchColumn();
        } while ($exists > 0);
        try {
            // Insertar el registro
            $sql = "INSERT INTO actividad (nomact, desact, codfas, iniact, finact) VALUES (:nomact, :desact, :codfas, :iniact, :finact)";
            $result = $conexion->prepare($sql);
            $nomact = $this->getNomact();
            $result->bindParam(":nomact", $nomact);
            $desact = $this->getDesact();
            $result->bindParam(":desact", $desact);
            $codfas = $this->getCodfas();
            $result->bindParam(":codfas", $codfas);
            $iniact = $this->getIniact();
            $result->bindParam(":iniact", $iniact);
            $finact = $this->getFinact();
            $result->bindParam(":finact", $finact);

            if ($result->execute()) {
                echo "<script>alert('Actividad creada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al guardar la Actividad: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    public function edit()
    {
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql = "UPDATE actividad SET nomact=:nomact, desact=:desact, codfas=:codfas, iniact=:iniact, finact=:finact WHERE codact=:codact";
        $result = $conexion->prepare($sql);
        $codact = $this->getCodact();
        $result->bindParam(":codact", $codact);
        $nomact = $this->getNomact();
        $result->bindParam(":nomact", $nomact);
        $desact = $this->getDesact();
        $result->bindParam(":desact", $desact);
        $codfas = $this->getCodfas();
        $result->bindParam(":codfas", $codfas);
        $iniact = $this->getIniact();
        $result->bindParam(":iniact", $iniact);
        $finact = $this->getFinact();
        $result->bindParam(":finact", $finact);

        try {
            if ($result->execute()) {
                echo "<script>alert('Actividad actualizada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al actualizar la Actividad: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    public function del()
    {
        $sql = "DELETE FROM actividad WHERE codact= :codact";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();

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
