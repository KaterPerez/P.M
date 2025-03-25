<?php
include("models/mcrecur.php");
include("models/mregis.php");

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

$idcur = 1; // Supongamos un ID de curso fijo para probar
$datAll = $mregtd->getAllByCurso($idcur, 4);
if ($datAll) {
    $nombreCurso = isset($datAll[0]['nomcur']) ? $datAll[0]['nomcur'] : 'Sin nombre';
    $numeroCurso = isset($datAll[0]['codcur']) ? $datAll[0]['codcur'] : 'Sin número';
    
    // Pasa solo el nombre y número del curso al modal
    echo generateListStudentsModal($idcur, "$nombreCurso (Número: $numeroCurso)", $datAll);
} else {
    echo "No se encontraron estudiantes para este curso.";
}

// Obtener todos los cursos
$datAll = $mcrecur->getAll();

// Función para generar el modal dinámico

function generateListStudentsModal($idCurso, $nombreCurso, $datAll) {
    $html = '<div class="modal fade" id="modalListarEstudiantes' . htmlspecialchars($idCurso) . '" tabindex="-1" role="dialog" aria-labelledby="modalListarEstudiantesLabel' . htmlspecialchars($idCurso) . '" aria-hidden="true">';
        $html .= '<div class="modal-dialog modal-lg">';
            $html .= '<div class="modal-content">';
                // Encabezado del modal
                $html .= '<div class="modal-header">';
                    $html .= '<h5 class="modal-title" id="modalListarEstudiantesLabel' . htmlspecialchars($idCurso) . '">Listal Curso: ' . htmlspecialchars($nombreCurso) . '</h5>';
                    $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                $html .= '</div>';

                // Cuerpo del modal
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

                            // Validación de datos y generación de filas
                            if ($datAll && !empty($datAll)) {
                                foreach ($datAll as $dta) {
                                    if (isset($dta['codper']) && $dta['codper'] == 4) {
                                        $html .= '<tr>';
                                            // Detalles del estudiante
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
                                // Mensaje si no hay datos
                                $html .= '<tr>';
                                    $html .= '<td colspan="4" class="text-center">No hay datos disponibles</td>';
                                $html .= '</tr>';
                            }

                        $html .= '</tbody>';
                    $html .= '</table>';
                $html .= '</div>';
                
                // Pie del modal
                $html .= '<div class="modal-footer">';
                    $html .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';

    return $html;
}
?>