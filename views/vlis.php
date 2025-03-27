<?php require_once('controllers/clis.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Cursos</h1>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Número de curso</th>
                    <th class="text-center">Nombre del Curso</th>
                    <th class="text-center">Listar estudiantes</th>
                </tr>
            </thead>
            <tbody>
    <?php if ($datAll) { foreach ($datAll as $curso) { ?>
        <tr>
            <td class="text-center"><?= $curso['codcur']; ?></td>
            <td class="text-center"><?= $curso['nomcur']; ?></td>
            <td class="text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalListarEstudiantes<?= $curso['idcur']; ?>">
                    <i class="fa-solid fa-eye"></i> Listar
                </button>
            </td>
        </tr>
    <?php }} else { ?>
        <tr>
            <td colspan="3" class="text-center">No tienes cursos asignados</td>
        </tr>
    <?php } ?>
</tbody>

        </table>
    </div>
</div>

<!-- Modales Dinámicos Generados -->
<?php 
// Para cada curso, generamos el modal correspondiente con los estudiantes de ese curso
foreach ($datAll as $curso) {
    // Obtener los estudiantes de este curso
    $datEstudiantes = $mregtd->getAllByCurso($curso['idcur'], 4); // Ajusta el 4 si es necesario para tu lógica
    echo generateListStudentsModal($curso['idcur'], $curso['nomcur'], $datEstudiantes);
}
?>
<script>
function verProyecto(idusu) {
    window.location.href = "home.php?pg=2002&id=" + idusu;

}
</script>


<script type="text/javascript" src="js/java2.js"></script>
