<?php
include("models/mcrecur.php");

$codcur = isset($_REQUEST['codcur']) ? $_REQUEST['codcur'] : NULL;  
$nomcur = isset($_POST['nomcur']) ? $_POST['nomcur'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$mcrecur = new Mcrecur();
$mcrecur->setCodcur($codcur); 

if ($ope == "save") {
    $mcrecur->setCodcur($codcur); 
    $mcrecur->setNomcur($nomcur);
    $mcrecur->setIdusu($idusu);
    if ($mcrecur->savec()) {
        $mensaje = "Curso guardado exitosamente.";
        exit;
    }else {
        $mensaje = "Error al guardar el curso.";
    }
}
if ($ope == "editc" && $_POST) {
    if (isset($_POST['nomcur']) && isset($_POST['idusu'])) {
        $nomcur = $_POST['nomcur'];
        $idusu = $_POST['idusu'];

        // Asignamos los valores a los métodos del objeto
        $mcrecur->setNomcur($nomcur);
        $mcrecur->setIdusu($idusu);

        $mcrecur->editc();
        $mensaje = "Curso editado exitosamente.";
        header("Location: home.php?pg=<?=$pg;?>" . urlencode($mensaje)); 
        exit;
    } 
}
// Si se está eliminando, ejecutar la lógica de eliminación
if ($ope == "delc") {
    $mcrecur->setCodcur($codcur); 
    $mcrecur->delc();  // Eliminar el curso
}
$getOne = ($ope == "editc" && $codcur) ? $mcrecur->getOne() : NULL;

//si vamos a eliminar datos del formulario
$getDel = ($ope == "delc"&& $codcur) ? $mcrecur->getOne() : NULL;


// Obtener los detalles del curso para mostrar en la vista
$getOne = $mcrecur->getOne();

// Obtener todos los cursos
$datCursos = $mcrecur->getAll();



?>

