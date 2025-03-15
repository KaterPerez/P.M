<?php
class Mmenu {
    private $codpag;
    private $codper;

    function getCodpag() {
        return $this->codpag;
    }
    
    public function getCodper() {
        return $this->codper;
    }

    // Métodos SET con validaciones
    public function setCodpag($codpag) {
        try {
            if (is_numeric($codpag) && $codpag > 0) {
                $this->codpag = $codpag;
            } else {
                throw new InvalidArgumentException("El codpag debe ser un número positivo.");
            }
        } catch (InvalidArgumentException $e) {
            echo "Error: " . $e->getMessage();
            exit; // Detener ejecución si es necesario
        }
    }

    public function setCodper($codper) {
        try {
            if (is_numeric($codper) && $codper > 0) {
                $this->codper = $codper;
            } else {
                throw new InvalidArgumentException("El codper debe ser un número positivo.");
            }
        } catch (InvalidArgumentException $e) {
            echo "Error: " . $e->getMessage();
            exit; // Detener ejecución si es necesario
        }
    }

    // Funciones de base de datos (como getMenu() y getValid())
    public function getMenu() {
        $res = NULL;
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT p.codpag, p.nompag, p.rutpag, p.icopag FROM pagina AS p INNER JOIN pagxper AS l ON p.codpag = l.codpag WHERE p.mospag = 1 AND l.codper = :codper;";
        $result = $conexion->prepare($sql);
        $codper = $this->getCodper();
        $result->bindParam(":codper", $codper, PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getValid() {
        $res = NULL;
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT p.codpag, p.nompag, p.rutpag, p.icopag, p.mospag FROM pagina AS p INNER JOIN pagxper AS l ON p.codpag = l.codpag WHERE l.codper = :codper AND p.codpag = :codpag;";
        $result = $conexion->prepare($sql);
        $codper = $this->getCodper();
        $codpag = $this->getCodpag();
        $result->bindParam(':codper', $codper, PDO::PARAM_INT); // Asegurar tipo INT
        $result->bindParam(':codpag', $codpag, PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
}
?>
