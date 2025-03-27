<?php

require_once("../models/mregis.php");
require_once("../models/mcrecur.php");
require_once("../models/conexion.php");
require_once("../fpdf/fpdf.php");

date_default_timezone_set('America/Bogota');

// Obtener el ID del curso desde la URL
if (!isset($_GET['idcur'])) {
    die("No se especificó un curso.");
}
$idcur = $_GET['idcur'];

// Obtener datos del curso con el nombre del profesor
$mcrecur = new Mcrecur();
$curso = $mcrecur->getCursoById($idcur);

// Obtener lista de estudiantes
$mregtd = new Mregtd();
$estudiantes = $mregtd->getAllByCurso($idcur, 4); // 4 = estudiantes

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Título
$pdf->Cell(190, 10, "Lista de estudiantes", 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);

// Fecha
$meses = ["", "ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];
$fecha = "CHÍA, " . $meses[intval(date('m'))] . " " . date('d') . " DE " . date('Y');
$pdf->Cell(190, 10, utf8_decode($fecha), 0, 1, 'C');
$pdf->Ln(10);

// Información del curso con el nombre del profesor
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, "Curso: " . utf8_decode($curso['nomcur']), 0, 1, 'L');
$pdf->Cell(190, 10, "Codigo: " . utf8_decode($curso['codcur']), 0, 1, 'L');
$pdf->Cell(190, 10, "Profesor: " . utf8_decode($curso['nomusu'] . ' ' . $curso['apeusu']), 0, 1, 'L'); // Nuevo campo
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, "Nombre", 1); // Se aumentó a 80
$pdf->Cell(40, 10, "Documento", 1);
$pdf->Cell(35, 10, "Grupo", 1);
$pdf->Cell(35, 10, "Perfil", 1);
$pdf->Ln();

// Agregar datos de los estudiantes
$pdf->SetFont('Arial', '', 12);
if ($estudiantes) {
    foreach ($estudiantes as $est) {
        $pdf->Cell(80, 10, utf8_decode($est['nomusu'] . ' ' . $est['apeusu']), 1); // Aumentado a 80
        $pdf->Cell(40, 10, utf8_decode($est['numdoc']), 1);
        $pdf->Cell(35, 10, utf8_decode($est['nomgru']), 1);
        $pdf->Cell(35, 10, utf8_decode($est['nomper']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(190, 10, "No hay estudiantes en este curso.", 1, 1, 'C');
}

// Descargar PDF
$pdf->Output("D", "Lista_Curso_$idcur.pdf"); // Fuerza la descarga
exit;
?>
