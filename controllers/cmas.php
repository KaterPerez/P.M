<?php
include("../models/conexion.php");

$conexion_obj = new conexion();
$conexion = $conexion_obj->get_Conexion();

require_once("../PHPExcel/Classes/PHPExcel.php");

// Verificar que se haya subido el archivo sin errores
if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == 0) {
    $archivo = $_FILES["archivo"]["tmp_name"];

    try {
        // Cargar el archivo Excel
        $objPHPExcel = PHPExcel_IOFactory::load($archivo);
        $worksheet = $objPHPExcel->getActiveSheet();

        // Obtener el número total de filas (suponiendo que la primera fila es cabecera)
        $highestRow = $worksheet->getHighestRow();

        // Preparamos la consulta con parámetros nombrados
        $sql = "INSERT INTO usuario (nomusu, apeusu, tipdoc, numdoc, actusu, codper, edausu, genusu, telusu, corusu, pasusu)
                SELECT :nomusu, :apeusu, :tipdoc, :numdoc, :actusu, p.codper, :edausu, :genusu, :telusu, :corusu, :pasusu
                FROM perfil p
                WHERE p.codper = :codper";
        $stmt = $conexion->prepare($sql);

        // Recorrer desde la fila 2 (para omitir la cabecera)
        for ($row = 2; $row <= $highestRow; $row++) {
            // Obtener los valores desde cada celda
            $nomusu = $worksheet->getCell('A' . $row)->getValue();
            $apeusu = $worksheet->getCell('B' . $row)->getValue();
            $tipdoc = $worksheet->getCell('C' . $row)->getValue();
            $numdoc = $worksheet->getCell('D' . $row)->getValue();
            $actusu = (int)$worksheet->getCell('E' . $row)->getValue();
            $codper = (int)$worksheet->getCell('F' . $row)->getValue();
            $edausu = (int)$worksheet->getCell('G' . $row)->getValue();
            $genusu = $worksheet->getCell('H' . $row)->getValue();
            $telusu = $worksheet->getCell('I' . $row)->getValue();
            $corusu = $worksheet->getCell('J' . $row)->getValue();
            $pasusu = $worksheet->getCell('K' . $row)->getValue();

            // Vincular los parámetros
            $stmt->bindParam(':nomusu', $nomusu, PDO::PARAM_STR);
            $stmt->bindParam(':apeusu', $apeusu, PDO::PARAM_STR);
            $stmt->bindParam(':tipdoc', $tipdoc, PDO::PARAM_STR);
            $stmt->bindParam(':numdoc', $numdoc, PDO::PARAM_STR);
            $stmt->bindParam(':actusu', $actusu, PDO::PARAM_INT);
            $stmt->bindParam(':codper', $codper, PDO::PARAM_INT);
            $stmt->bindParam(':edausu', $edausu, PDO::PARAM_INT);
            $stmt->bindParam(':genusu', $genusu, PDO::PARAM_STR);
            $stmt->bindParam(':telusu', $telusu, PDO::PARAM_STR);
            $stmt->bindParam(':corusu', $corusu, PDO::PARAM_STR);
            $stmt->bindParam(':pasusu', $pasusu, PDO::PARAM_STR);

            // Ejecutar la consulta; en caso de error, devolver el mensaje
            if (!$stmt->execute()) {
                $errorInfo = $stmt->errorInfo();
                echo "Error en la fila $row: " . $errorInfo[2] . "\n";
            }
        }
        echo "<script>alert('Carga masiva realizada con éxito.');</script>";
    } catch (Exception $e) {
        echo "Error al procesar el archivo: " . $e->getMessage();
    }
} else {
    echo "No se ha subido ningún archivo o se produjo un error en la carga.";
}
?>