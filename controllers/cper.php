<?php
include_once(__DIR__ . '/../models/mper.php');
include_once(__DIR__ . '/../controllers/optimg.php');

// Habilitar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Instancia de la clase
$mper = new Mper();
echo "Clase Mper instanciada correctamente.<br>";

// Variables de sesión y solicitud
$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL;
$numdoc = isset($_POST['numdoc']) ? $_POST['numdoc'] : NULL;
$tipdoc = isset($_POST['tipdoc']) ? $_POST['tipdoc'] : NULL;
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$apeusu = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL;
$telusu = isset($_POST['telusu']) ? $_POST['telusu'] : NULL;
$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu'] : NULL;
$dirusu = isset($_POST['dirusu']) ? $_POST['dirusu'] : NULL;
$edausu = isset($_POST['edausu']) ? $_POST['edausu'] : NULL;
$genusu = isset($_POST['genusu']) ? $_POST['genusu'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$fotper = isset($_FILES['fotper']) ? $_FILES['fotper'] : NULL;

// Procesar archivo de imagen
if ($fotper) {
    echo "Archivo recibido: " . $fotper['name'] . "<br>";
    // Procesar la imagen con opti()
    $ruta_fotper = opti($fotper, 'fotper', 'fotos', date('YmdHis'));
    echo "Ruta del archivo procesado: $ruta_fotper<br>";
} else {
    $ruta_fotper = NULL; // No se recibió archivo
    echo "No se recibió archivo de imagen.<br>";
}

// Guardar o Editar
if ($ope == "save") {
    echo "Operación SAVE iniciada.<br>";

    $mper->setIdusu($idusu);
    $mper->setNumdoc($numdoc);
    $mper->setTipdoc($tipdoc);
    $mper->setNomusu($nomusu);
    $mper->setApeusu($apeusu);
    $mper->setTelusu($telusu);
    $mper->setPasusu($pasusu);
    $mper->setDirusu($dirusu);
    $mper->setEdausu($edausu);
    $mper->setGenusu($genusu);
    $mper->setFotper($ruta_fotper);

    try {
        if ($idusu) {
            echo "Editando usuario con ID: $idusu<br>";
            $mper->edit();
            echo "Usuario editado correctamente.<br>";
        } else {
            echo "Guardando nuevo usuario.<br>";
            $mper->save();
            echo "Usuario guardado correctamente.<br>";
        }
    } catch (Exception $e) {
        echo "Error al guardar los datos: " . $e->getMessage() . "<br>";
    }
}

// Obtener datos del usuario
if ($idusu) {
    echo "Obteniendo datos del usuario con ID: $idusu<br>";
    $dtOne = $mper->getOne($idusu);
    print_r($dtOne);
} else {
    echo "No hay usuario en la sesión.<br>";
    $dtOne = NULL;
}
?>