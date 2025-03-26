<?php class Mfas
{

    //atributos
    private $codfas;
    private $nomfas;
    private $codpro;
    private $inifas;
    private $finfas;
    private $idgru;

    //metodos get
    public function getCodfas()
    {
        return $this->codfas;
    }
    public function getNomfas()
    {
        return $this->nomfas;
    }
    public function getCodpro()
    {
        return $this->codpro;
    }
    public function getInifas()
    {
        return $this->inifas;
    }
    public function getFinfas()
    {
        return $this->finfas;
    }
    public function getidgru()
    {
        return $this->idgru;
    }
    //metodos SET
    public function setCodfas($codfas)
    {
        $this->codfas = $codfas;
    }
    public function setNomfas($nomfas)
    {
        $this->nomfas = $nomfas;
    }
    public function setCodpro($codpro)
    {
        $this->codpro = $codpro;
    }
    public function setInifas($inifas)
    {
        $this->inifas = $inifas;
    }
    public function setFinfas($finfas)
    {
        $this->finfas = $finfas;
    }
    public function setidgru($idgru)
    {
        $this->idgru = $idgru;
    }

    //metodos publicos
    public function getAll()
    {
        $res = NULL;
        $sql = "SELECT f.codfas, f.nomfas, f.codpro, f.inifas, f.finfas, g.idgru, g.nomgru ,p.codpro, p.nompro FROM fase AS f INNER JOIN grupo AS g INNER JOIN proyecto AS p ON f.codpro=p.codpro";
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
        $sql = "SELECT f.codfas, f.nomfas, f.codpro, f.inifas, f.finfas, g.idgru, g.nomgru ,p.codpro, p.nompro FROM fase AS f INNER JOIN grupo AS g INNER JOIN proyecto AS p ON f.codpro=p.codpro WHERE f.codfas=:codfas";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codfas = $this->getCodfas();
        $result->bindParam(":codfas", $codfas);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getCpro()
    {
        $sql = "SELECT codpro, nompro, idgru FROM proyecto";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function validateCodpro($codpro)
    {
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT COUNT(*) FROM proyecto WHERE codpro = :codpro";
        $result = $conexion->prepare($sql);
        $result->bindParam(":codpro", $codpro);
        $result->execute();
        return $result->fetchColumn() > 0; // Retorna true si existe
    }
    public function save()
    {
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();

        // Verificar que `codpro` exista en la tabla `proyecto`
        if (!$this->validateCodpro($this->getCodpro())) {
            echo "<script>alert('Error: El código de proyecto no existe.');</script>";
            return;
        }

        // Generar un código único para `codfas`
        do {
            $codfas = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $sqlCheck = "SELECT COUNT(*) FROM fase WHERE codfas = :codfas";
            $resultCheck = $conexion->prepare($sqlCheck);
            $resultCheck->bindParam(":codfas", $codfas);
            $resultCheck->execute();
            $exists = $resultCheck->fetchColumn();
        } while ($exists > 0);
        try {
            // Insertar el registro
            $sql = "INSERT INTO fase (nomfas, codpro, inifas, finfas, idgru) VALUES (:nomfas, :codpro, :inifas, :finfas, :idgru)";
            $result = $conexion->prepare($sql);
            $nomfas = $this->getNomfas();
            $result->bindParam(":nomfas", $nomfas);
            $codpro = $this->getCodpro();
            $result->bindParam(":codpro", $codpro);
            $inifas = $this->getInifas();
            $result->bindParam(":inifas", $inifas);
            $finfas = $this->getFinfas();
            $result->bindParam(":finfas", $finfas);
            $idgru = $this->getIdgru();
            $result->bindParam(":idgru", $idgru);

            if ($result->execute()) {
                echo "<script>alert('Fase creada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al guardar la fase: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    public function edit()
    {
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql = "UPDATE fase SET nomfas=:nomfas, codpro=:codpro, inifas=:inifas, finfas=:finfas, idgru=:idgru WHERE codfas=:codfas";
        $result = $conexion->prepare($sql);
        $codfas = $this->getCodfas();
        $result->bindParam(":codfas", $codfas);
        $nomfas = $this->getNomfas();
        $result->bindParam(":nomfas", $nomfas);
        $codpro = $this->getCodpro();
        $result->bindParam(":codpro", $codpro);
        $inifas = $this->getInifas();
        $result->bindParam(":inifas", $inifas);
        $finfas = $this->getFinfas();
        $result->bindParam(":finfas", $finfas);
        $idgru = $this->getIdgru();
        $result->bindParam(":idgru", $idgru);

        try {
            if ($result->execute()) {
                echo "<script>alert('Fase actualizada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al actualizar la fase: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    public function del()
    {
        $sql = "DELETE FROM fase WHERE codfas= :codfas";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
       
        $result = $conexion->prepare($sql);
        $codfas = $this->getCodfas();
        $result->bindParam(":codfas", $codfas);

        try {
            if ($result->execute()) {
                echo "<script>alert('Fase eliminada exitosamente.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error al eliminar la fase: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
    public function getStudentCourse($idgru) {
        $sql = "SELECT g.nomcur 
                FROM curso g
                INNER JOIN usuxcur ug ON g.idcur = ug.idcur
                WHERE ug.idgru
                LIMIT 1"; // Tomamos un solo resultado si está en varios grupos
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idgru", $idgru, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
?>
