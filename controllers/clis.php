<?php
include("models/mcrecur.php");
include("models/mregis.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario en sesión sea un profesor
if (!isset($_SESSION['idusu']) || $_SESSION['codper'] != 3) {
    die("No tienes permisos para ver esta página.");
}

$idProfesor = $_SESSION['idusu'];
 

$idcur = isset($_REQUEST['idcur']) ? $_REQUEST['idcur'] : NULL;  
$codcur = isset($_POST['codcur']) ? $_POST['codcur'] : NULL;
$nomcur = isset($_POST['nomcur']) ? $_POST['nomcur'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mcrecur = new Mcrecur();
$mregtd  = new Mregtd();
$mcrecur->setIdcur($idcur);


$message = ""; // Variable para el mensaje

// Guardar o Editar un curso
if ($ope == "save") {
    $mcrecur->setIdcur($idcur);
    $mcrecur->setCodcur($codcur);
    $mcrecur->setNomcur($nomcur);
    $mcrecur->setIdusu($idusu);
}

// Obtener todos los cursos del profesor
$datAll = $mcrecur->getCoursesByTeacher($idProfesor);

if (!$datAll) {
    echo "<script>alert('No tienes cursos asignados.');</script>";
} else {
    foreach ($datAll as $curso) {
        // Obtener los estudiantes de este curso
        $datEstudiantes = $mregtd->getAllByCurso($curso['idcur'], 4); 

        // Verificar si hay estudiantes
        if ($datEstudiantes) {
            echo generateListStudentsModal($curso['idcur'], $curso['nomcur'], $datEstudiantes);
        } else {
            echo "<script>alert('No se encontraron estudiantes para el curso: " . htmlspecialchars($curso['nomcur']) . "');</script>";
        }
    }
}


// Función para generar el modal dinámico

function generateListStudentsModal($idcur, $nomcur, $datEstudiantes) {
    $html = '<div class="modal fade" id="modalListarEstudiantes' . htmlspecialchars($idcur) . '" tabindex="-1" role="dialog" aria-labelledby="modalListarEstudiantesLabel' . htmlspecialchars($idcur) . '" aria-hidden="true">';
        $html .= '<div class="modal-dialog modal-lg">';
            $html .= '<div class="modal-content">';
                $html .= '<div class="modal-header">';
                    $html .= '<h5 class="modal-title" id="modalListarEstudiantesLabel' . htmlspecialchars($idcur) . '">Lista Curso: ' . htmlspecialchars($nomcur) . '</h5>';
                    $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                $html .= '</div>';
                $html .= '<div class="modal-body">';
                    $html .= '<table class="table">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Nombre</th>';
                                $html .= '<th>Grupo</th>';
                                $html .= '<th>Perfil</th>';
                                $html .= '<th>Acción</th>';
                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';
                            if ($datEstudiantes && !empty($datEstudiantes)) {
                                foreach ($datEstudiantes as $dta) {
                                    if (isset($dta['codper']) && $dta['codper'] == 4) {
                                        $html .= '<tr>';
                                            $html .= '<td>';
                                                $html .= '<strong>' . htmlspecialchars($dta['nomusu']) . ' ' . htmlspecialchars($dta['apeusu']) . '</strong><br>';
                                                $html .= '<small>';
                                                    $html .= '<strong>Tipo Documento:</strong> ' . htmlspecialchars($dta['tipdoc']) . '<br>';
                                                    $html .= '<strong>No. Documento:</strong> ' . htmlspecialchars($dta['numdoc']);
                                                $html .= '</small>';
                                            $html .= '</td>';
                                            $html .= '<td>' .  htmlspecialchars($dta['nomgru']) . '</td>';
                                            $html .= '<td>' . htmlspecialchars($dta['nomper']) . '</td>';
                                            $html .= '<td>';
                                            $html .= '<button class="btn btn-primary btn-sm" onclick="verProyecto(\'' . htmlspecialchars($dta['idusu']) . '\')">Ver Proyecto</button>';
                                            $html .= '</td>';
                                        $html .= '</tr>';
                                    }
                                }
                            } else {
                                $html .= '<tr>';
                                    $html .= '<td colspan="4" class="text-center">No hay datos disponibles</td>';
                                $html .= '</tr>';
                            }
                        $html .= '</tbody>';
                    $html .= '</table>';
                $html .= '</div>';
                $html .= '<div class="modal-footer">';
                    $html .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';

    return $html;
}

?>