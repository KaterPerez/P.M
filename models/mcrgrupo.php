<?php class Mcrgrupo
{

    //atributos
    private $codpro;
    private $nompro;
    private $codgru;
    private $tempro;
    private $inipro;
    private $finpro;

    //metodos get
    public function getCodpro()
    {
        return $this->codpro;
    }
    public function getNompro()
    {
        return $this->nompro;
    }
    public function getCodgru()
    {
        return $this->codgru;
    }
    public function getTempro()
    {
        return $this->tempro;
    }
    public function getInipro()
    {
        return $this->inipro;
    }
    public function getFinpro()
    {
        return $this->finpro;
    }
    //metodos SET
    public function setCodpro($codpro)
    {
        $this->codpro = $codpro;
    }
    public function setNompro($nompro)
    {
        $this->nompro = $nompro;
    }
    public function setCodgru($codgru)
    {
        $this->codgru = $codgru;
    }
    public function setTempro($tempro)
    {
        $this->tempro = $tempro;
    }
    public function setInipro($inipro)
    {
        $this->inipro = $inipro;
    }
    public function setFinpro($finpro)
    {
        $this->finpro = $finpro;
    }

    //metodos publicos
    public function getAll()
    {
        $res = NULL;
        $sql = "SELECT p.codpro, p.nompro, p.codgru, p.tempro, p.inipro, p.finpro, g.codgru, g.nomgru FROM Proyecto AS p LEFT JOIN grupo AS g ON p.codgru=g.codgru";
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
        $sql = "SELECT p.codpro, p.nompro, p.codgru, p.tempro, p.inipro, p.finpro, g.codgru, g.nomgru FROM Proyecto AS p INNER JOIN grupo AS g ON p.codgru=g.codgru WHERE p.codpro=:codpro";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codpro = $this->getCodpro();
        $result->bindParam(":codpro", $codpro);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getCgru()
    {
        $sql = "SELECT codgru, nomgru FROM grupo";
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

        // Generar un código único para `codpro`
        do {
            $codpro = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $sqlCheck = "SELECT COUNT(*) FROM proyecto WHERE codpro = :codpro";
            $resultCheck = $conexion->prepare($sqlCheck);
            $resultCheck->bindParam(":codpro", $codpro);
            $resultCheck->execute();
            $exists = $resultCheck->fetchColumn();
        } while ($exists > 0);
        try {
            // Insertar el registro
            $sql = "INSERT INTO proyecto (nompro, codgru, tempro, inipro, finpro) VALUES (:nompro, :codgru, :tempro, :inipro, :finpro)";
            $result = $conexion->prepare($sql);
            $nompro = $this->getNompro();
            $result->bindParam(":nompro", $nompro);
            $codgru = $this->getCodgru();
            $result->bindParam(":codgru", $codgru);
            $tempro = $this->getTempro();
            $result->bindParam(":tempro", $tempro);
            $inipro = $this->getInipro();
            $result->bindParam(":inipro", $inipro);
            $finpro = $this->getFinpro();
            $result->bindParam(":finpro", $finpro);

            if ($result->execute()) {
                echo "<script>alert('Proyecto creado exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al guardar el proyecto. " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    public function edit()
    {
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql = "UPDATE proyecto SET nompro=:nompro, codgru=:codgru, tempro=:tempro, inipro=:inipro, finpro=:finpro WHERE codpro=:codpro";
        $result = $conexion->prepare($sql);
        $codpro = $this->getCodpro();
        $result->bindParam(":codpro", $codpro);
        $nompro = $this->getNompro();
        $result->bindParam(":nompro", $nompro);
        $codgru = $this->getCodgru();
        $result->bindParam(":codgru", $codgru);
        $tempro = $this->getTempro();
        $result->bindParam(":tempro", $tempro);
        $inipro = $this->getInipro();
        $result->bindParam(":inipro", $inipro);
        $finpro = $this->getFinpro();
        $result->bindParam(":finpro", $finpro);

        try {
            if ($result->execute()) {
                echo "<script>alert('Proyecto actualizado exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al actualizar el proyecto. " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    public function del()
    {
        $sql = "DELETE FROM proyecto WHERE codpro= :codpro";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
       
        $result = $conexion->prepare($sql);
        $codpro = $this->getCodpro();
        $result->bindParam(":codpro", $codpro);

        try {
            if ($result->execute()) {
                echo "<script>alert('Proyecto eliminado exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al eliminar el proyecto. Antes de eliminar proyectos verifique que ninguna fase se encuentre vinculado al el.');</script>";
        }
    }
}
?>