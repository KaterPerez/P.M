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
                        <!-- Botón para abrir el modal -->
                        <td class="text-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalListarEstudiantes<?= $curso['idcur']; ?>">
                                <i class="fa-solid fa-eye"></i> Listar
                            </button>
                        </td>
                    </tr>
                <?php }} else { ?>
                    <tr>
                        <td colspan="3" class="text-center">No hay cursos disponibles</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modales Dinámicos Generados -->
<?php foreach ($datAll as $curso) {
    echo generateListStudentsModal($curso['idcur'], $curso['nomcur'], $datAll);
} ?>
<script type="text/javascript" src="js/java2.js"></script>
