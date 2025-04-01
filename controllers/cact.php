<?php require_once(__DIR__ . '/../models/mact.php');

$codact = isset($_REQUEST['codact']) ? $_REQUEST['codact'] : NULL;
$nomact = isset($_POST['nomact']) ? $_POST['nomact'] : NULL;
$desact = isset($_POST['desact']) ? $_POST['desact'] : NULL;
$codfas = isset($_POST['codfas']) ? $_POST['codfas'] : NULL;
$iniact = isset($_POST['iniact']) ? $_POST['iniact'] : NULL;
$finact = isset($_POST['finact']) ? $_POST['finact'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$mact = new Mact();
$mact->setCodact($codact);

if ($ope == "save") {
    // Guardar actividad
    $mact->setNomact($nomact);
    $mact->setDesact($desact);
    $mact->setCodfas($codfas);
    $mact->setIniact($iniact);
    $mact->setFinact($finact);

    // Manejo de archivo
    if (!empty($_FILES['archivo']['name'])) {
        $directorio = "uploads/";  // Crear carpeta si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Guardar el archivo con un nombre único
        $nombreArchivo = time() . "_" . basename($_FILES["archivo"]["name"]);
        $rutaArchivo = $directorio . $nombreArchivo;

        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $rutaArchivo)) {
            $mact->setArchivo($nombreArchivo);  // Asignar nombre del archivo
        }
    }

    // Guardar o actualizar la actividad
    if ($codact) {
        $mact->edit();  // Editar actividad
    } else {
        $mact->save();  // Crear nueva actividad
    }
}

if ($ope == "del" && $codact) {
    $mact->del();  // Eliminar actividad
}

if ($ope == "edi" && $codact) {
    $datOne = $mact->getOne();  // Obtener una actividad por código
} else {
    $datOne = NULL;
}

$fases = $mact->getFases();  // Obtener todas las fases
$datAll = $mact->getAll();  // Obtener todas las actividades
?>
