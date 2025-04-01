<?php
include("../models/conexion.php");

$conexion_obj = new conexion();
$conexion = $conexion_obj->get_Conexion();

require_once("../PHPExcel/PHPExcel/Classes/PHPExcel.php");

// Verificar que se haya subido el archivo sin errores
if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == 0) {
    $archivo = $_FILES["archivo"]["tmp_name"];

    try {
        // Cargar el archivo Excel
        $objPHPExcel = PHPExcel_IOFactory::load($archivo);
        $worksheet = $objPHPExcel->getActiveSheet();

        // Obtener el número total de filas (suponiendo que la primera fila es cabecera)
        $highestRow = $worksheet->getHighestRow();

        // Preparamos la consulta con parámetros nombrados para la tabla curso
        $sql = "INSERT INTO curso (codcur, nomcur)
                VALUES (:codcur, :nomcur)";
        $stmt = $conexion->prepare($sql);

        // Recorrer desde la fila 2 (para omitir la cabecera)
        for ($row = 2; $row <= $highestRow; $row++) {
            // Obtener los valores desde cada celda
            $codcur = (int)$worksheet->getCell('A' . $row)->getValue();
            $nomcur = $worksheet->getCell('B' . $row)->getValue();

            // Vincular los parámetros a la consulta preparada
            $stmt->bindParam(':codcur', $codcur, PDO::PARAM_INT);
            $stmt->bindParam(':nomcur', $nomcur, PDO::PARAM_STR);

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
