<?php
require_once '../models/conexion.php';
require_once '../models/datos.php';
require_once '../models/mcrgrupo.php';

if (isset($_GET['codpro'])) {
    $codpro = $_GET['codpro'];

    // Obtener archivos del modelo
    $proyecto = new Mcrgrupo();
    $archivos = $proyecto->getArchivosByProyecto($codpro);

    // Verificar si hay archivos
    if (empty($archivos)) {
        die('No hay archivos para este proyecto.');
    }

    // Ruta del ZIP
    $zipFileName = "proyecto_{$codpro}.zip";
    $zipFilePath = __DIR__ . "/../uploads/{$zipFileName}"; // Asegurar ubicación correcta

    // Crear directorio si no existe
    if (!is_dir(__DIR__ . "/../uploads")) {
        mkdir(__DIR__ . "/../uploads", 0777, true);
    }

    // Crear ZIP
    $zip = new ZipArchive();
    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        die('No se pudo crear el archivo ZIP. Verifica permisos.');
    }

    foreach ($archivos as $archivo) {
        // Obtener ruta real del archivo
        $filePath = realpath(__DIR__ . "/../uploads/" . $archivo['archivo']);

        // Verificar que el archivo existe
        if (!$filePath || !file_exists($filePath)) {
            echo "Archivo no encontrado: " . __DIR__ . "/../uploads/" . $archivo['archivo'] . "<br>";
        } else {
            $zip->addFile($filePath, basename($filePath));
        }
    }

    $zip->close();

    // Verificar si el ZIP se creó correctamente
    if (!file_exists($zipFilePath)) {
        die('El archivo ZIP no se generó correctamente.');
    }

    // Descargar el ZIP
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . basename($zipFilePath) . '"');
    header('Content-Length: ' . filesize($zipFilePath));
    readfile($zipFilePath);

    unlink($zipFilePath); // Eliminar ZIP después de la descarga
    exit;
} else {
    die('Código de proyecto no proporcionado.');
}
?>
