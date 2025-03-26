<?php
require_once 'models/mgrue.php';
require_once 'models/mregis.php';

$idgru = isset($_REQUEST['idgru']) ? $_REQUEST['idgru'] : NULL;  
$nomgru = isset($_POST['nomgru']) ? $_POST['nomgru'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mgrue = new Mgrue();
$mgrue->setIdgru($idgru);

$message = ""; // Variable para el mensaje

// Guardar o Editar un grupo
if ($ope == "save") {
    $mgrue->setIdgru($idgru);
    $mgrue->setNomgru($nomgru);
    $mgrue->setIdusu($idusu);
    if (!$idgru) {
        $mgrue->save();
        $message = "El grupo ha sido guardado con éxito.";
    } else {
        $mgrue->edit();
        $message = "El grupo ha sido actualizado con éxito.";
    }
}
if ($ope == "eli" && $idgru) {
    $mgrue->del();
    $message = "El grupo ha sido eliminado con éxito.";
}
if ($ope == "edi" && $idgru) {
    $datOne = $mgrue->getOne($idgru);
}
$datAll = $mgrue->getAll();

// Obtener estudiantes disponibles y generar los modales
foreach ($datAll as $grupo) {
    echo generateStudentModal($grupo['idgru'], $grupo['nomgru'], $mgrue);
}

// Añadir o quitar estudiantes del grupo
if ($ope == "manageStudents") {
    if (isset($_POST['addStudents']) && !empty($_POST['addStudents'])) {
        $studentsToAdd = $_POST['addStudents'];
        foreach ($studentsToAdd as $idusu) {
            $mgrue->assignStudentsToCourse($idgru, $idusu);
        }
        $message = "Estudiantes añadidos con éxito al grupo.";
    }

    if (isset($_POST['removeStudents']) && !empty($_POST['removeStudents'])) {
        $studentsToRemove = $_POST['removeStudents'];
        foreach ($studentsToRemove as $idusu) {
            $mgrue->removeStudentFromCourse($idgru, $idusu);
        }
        $message = "Estudiantes eliminados con éxito del grupo.";
    }
}

// Pasamos el mensaje como una variable de JavaScript
if (!empty($message)) {
    echo "<script>
            alert('$message');
            window.location.href = 'home.php?pg=$pg';
          </script>";
}

$cursoEstudiante = null;
if (isset($_SESSION['idusu'])) { // Suponiendo que el ID del usuario está en la sesión
    $cursoEstudiante = $mgrue->getStudentCourse($_SESSION['idusu']);
}

function generateStudentModal($idgrupo, $nombregrupo, $mgrue) {
    // Obtener estudiantes con codper = 4 y estudiantes asignados
    $students = $mgrue->getAvailableStudentsWithCodper($idgrupo, 4);
    $assignedStudents = $mgrue->getAssignedStudents($idgrupo);

    $html = '<div class="modal fade" id="modalgrupo'.$idgrupo.'" tabindex="-1" role="dialog" aria-labelledby="modalgrupoLabel'.$idgrupo.'" aria-hidden="true">';
        $html .= '<div class="modal-dialog modal-lg">';
            $html .= '<div class="modal-content">';
                $html .= '<div class="modal-header">';
                    $html .= '<h5 class="modal-title" id="modalgrupoLabel'.$idgrupo.'">Estudiantes para el grupo: '.$nombregrupo.'</h5>';
                    $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                $html .= '</div>';
                $html .= '<div class="modal-body">';
                    $html .= '<form action="home.php?pg='.$_REQUEST['pg'].'" method="post">';
                        $html .= '<input type="hidden" name="idgru" value="'.$idgrupo.'">';

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
?>
