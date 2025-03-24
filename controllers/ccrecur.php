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
    if (!$idcur) {
        $mcrecur->save();
        $message = "El curso ha sido guardado con éxito.";
    } else {
        $mcrecur->edit();
        $message = "El curso ha sido actualizado con éxito.";
    }
}

// Eliminar un curso
if ($ope == "eli" && $idcur) {
    $mcrecur->del();
    $message = "El curso ha sido eliminado con éxito.";
}

// Editar un curso (obtener datos para edición)
if ($ope == "edi" && $idcur) {
    $datOne = $mcrecur->getOne($idcur);
}

// Obtener todos los cursos
$datAll = $mcrecur->getAll();

// Función para generar el modal dinámico
function generateStudentModal($idCurso, $nombreCurso, $mcrecur) {
    // Obtener estudiantes con codper = 4 y estudiantes asignados
    $students = $mcrecur->getAvailableStudentsWithCodper($idCurso, 4);
    $assignedStudents = $mcrecur->getAssignedStudents($idCurso);

    $html = '<div class="modal fade" id="modalCurso'.$idCurso.'" tabindex="-1" role="dialog" aria-labelledby="modalCursoLabel'.$idCurso.'" aria-hidden="true">';
        $html .= '<div class="modal-dialog modal-lg">';
            $html .= '<div class="modal-content">';
                $html .= '<div class="modal-header">';
                    $html .= '<h5 class="modal-title" id="modalCursoLabel'.$idCurso.'">Estudiantes para el Curso: '.$nombreCurso.'</h5>';
                    $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                $html .= '</div>';
                $html .= '<div class="modal-body">';
                    $html .= '<form action="home.php?pg='.$_REQUEST['pg'].'" method="post">';
                        $html .= '<input type="hidden" name="idcur" value="'.$idCurso.'">';

                        // Tabla de estudiantes no asignados
                        $html .= '<h6>Estudiantes Disponibles:</h6>';
                        $html .= '<table class="table">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Seleccionar</th>';
                                $html .= '<th>No. Documento</th>';
                                $html .= '<th>Nombre</th>';
                                $html .= '<th>Correo</th>';
                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';
                        if ($students && !empty($students)) {
                            foreach ($students as $student) {
                                $html .= '<tr>';
                                    $html .= '<td><input type="checkbox" name="addStudents[]" value="'.$student['idusu'].'"></td>';
                                    $html .= '<td>'.$student['numdoc'].'</td>';
                                    $html .= '<td>'.$student['nomusu'].' '.$student['apeusu'].'</td>';
                                    $html .= '<td>'.$student['corusu'].'</td>';
                                $html .= '</tr>';
                            }
                        } else {
                            $html .= '<tr><td colspan="4" class="text-center">No hay estudiantes disponibles</td></tr>';
                        }
                        $html .= '</tbody>';
                        $html .= '</table>';

                        // Tabla de estudiantes asignados
                        $html .= '<h6>Estudiantes Asignados:</h6>';
                        $html .= '<table class="table">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Eliminar</th>';
                                $html .= '<th>No. Documento</th>';
                                $html .= '<th>Nombre</th>';
                                $html .= '<th>Correo</th>';
                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';
                        if ($assignedStudents && !empty($assignedStudents)) {
                            foreach ($assignedStudents as $student) {
                                $html .= '<tr>';
                                    $html .= '<td><input type="checkbox" name="removeStudents[]" value="'.$student['idusu'].'"></td>';
                                    $html .= '<td>'.$student['numdoc'].'</td>';
                                    $html .= '<td>'.$student['nomusu'].' '.$student['apeusu'].'</td>';
                                    $html .= '<td>'.$student['corusu'].'</td>';
                                $html .= '</tr>';
                            }
                        } else {
                            $html .= '<tr><td colspan="4" class="text-center">No hay estudiantes asignados</td></tr>';
                        }
                        $html .= '</tbody>';
                        $html .= '</table>';

                        $html .= '<div class="modal-footer">';
                            $html .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
                            $html .= '<button type="submit" class="btn btn-dark">Guardar Cambios</button>';
                            $html .= '<input type="hidden" name="ope" value="manageStudents">';
                        $html .= '</div>';
                    $html .= '</form>';
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';
    return $html;
}

// Obtener estudiantes disponibles y generar los modales
foreach ($datAll as $curso) {
    echo generateStudentModal($curso['idcur'], $curso['nomcur'], $mcrecur);
}

// Añadir o quitar estudiantes del curso
if ($ope == "manageStudents") {
    if (isset($_POST['addStudents']) && !empty($_POST['addStudents'])) {
        $studentsToAdd = $_POST['addStudents'];
        foreach ($studentsToAdd as $idusu) {
            $mcrecur->assignStudentsToCourse($idcur, $idusu);
        }
        $message = "Estudiantes añadidos con éxito al curso.";
    }

    if (isset($_POST['removeStudents']) && !empty($_POST['removeStudents'])) {
        $studentsToRemove = $_POST['removeStudents'];
        foreach ($studentsToRemove as $idusu) {
            $mcrecur->removeStudentFromCourse($idcur, $idusu);
        }
        $message = "Estudiantes eliminados con éxito del curso.";
    }
}

// Pasamos el mensaje como una variable de JavaScript
if (!empty($message)) {
    echo "<script>
            alert('$message');
            window.location.href = 'home.php?pg=$pg';
          </script>";
}

function generateListStudentsModal($idCurso, $nombreCurso, $datAll) {
    $html = '<div class="modal fade" id="modalListarEstudiantes' . $idCurso . '" tabindex="-1" role="dialog" aria-labelledby="modalListarEstudiantesLabel' . $idCurso . '" aria-hidden="true">';
        $html .= '<div class="modal-dialog modal-lg">';
            $html .= '<div class="modal-content">';
                $html .= '<div class="modal-header">';
                    $html .= '<h5 class="modal-title" id="modalListarEstudiantesLabel' . $idCurso . '">Estudiantes para el Curso: ' . $nombreCurso . '</h5>';
                    $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                $html .= '</div>';
                $html .= '<div class="modal-body">';
                    $html .= '<table class="table">';
                    $html .= '<thead>';
                        $html .= '<tr>';
                            $html .= '<th>Nombre</th>';
                            $html .= '<th>Activo</th>';
                            $html .= '<th>Perfil</th>';
                            $html .= '<th>Acción</th>';
                        $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '<tbody>';

                    if ($datAll && !empty($datAll)) {
                        foreach ($datAll as $dta) {
                            if ($dta['codper'] == 4) { // Solo mostrar estudiantes con perfil 4
                                $html .= '<tr>';
                                    // Nombre y detalles del estudiante
                                    $html .= '<td>';
                                        $html .= '<strong>' . $dta['nomusu'] . ' ' . $dta['apeusu'] . '</strong><br>';
                                        $html .= '<small>';
                                            $html .= '<strong>Tipo. Documento:</strong> ' . htmlspecialchars($dta['tipdoc']) . '<br>';
                                            $html .= '<strong>No. Documento:</strong> ' . htmlspecialchars($dta['numdoc']);
                                        $html .= '</small>';
                                    $html .= '</td>';

                                    // Activo
                                    $html .= '<td>' . ($dta['activo'] ? 'Sí' : 'No') . '</td>';

                                    // Perfil
                                    $html .= '<td>' . htmlspecialchars($dta['nomper']) . '</td>';

                                    // Botón "Ver Proyecto"
                                    $html .= '<td>';
                                        $html .= '<button class="btn btn-primary btn-sm" onclick="verProyecto(\'' . $dta['idusu'] . '\')">';
                                            $html .= 'Ver Proyecto';
                                        $html .= '</button>';
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