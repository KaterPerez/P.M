<?php require_once('controllers/cgrue.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Grupos</h1>
                <button class="btn btn-dark toggleFormButton" onclick="toggleFormulario()">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
	<h2>Curso al que pertenece: <?= $cursoEstudiante ? $cursoEstudiante['nomcur'] : 'No asignado'; ?></h2>
    <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm" style="display:none;">
        <div class="row mb-3"> <br>
            <div class="form-group col-12 col-md-6">
                <label for="nomgru">Nombre del Grupo</label>
                <input type="text" class="form-control" name="nomgru" value="<?= isset($datOne[0]['nomgru']) ? $datOne[0]['nomgru'] : ''; ?>" required>
            </div>
            <input type="hidden" name="idgru" value="<?= isset($datOne[0]['idgru']) ? $datOne[0]['idgru'] : ''; ?>">
            <input type="hidden" name="ope" value="save">
            <div class="col-12 col-md-2">
                <input class="btn btn-dark mt-4" type="submit" value="Guardar">
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Nombre del Grupo</th>
                    <th class="text-center">Estudiantes</th>
                    <th class="text-center">Proyecto</th>
					<th></th>
					<th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($datAll) { foreach ($datAll as $grupo) { ?>
                    <tr>
                        <td class="text-center"><?= $grupo['nomgru']; ?></td>
                        <td class="text-center">                            <!-- Botón para abrir el modal -->
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalGrupo<?= $grupo['idgru']; ?>">
                                <i class="fa-solid fa-user-plus"></i> Añadir Estudiantes
                            </button>
                        </td>
						<td class="text-center">                            <!-- Botón para abrir el modal -->
                            <button class="btn btn-dark">
								<a href="home.php?pg=2002" style="text-decoration: none; color: white;">
									<i class="fa-solid fa-bars-progress"></i> Crear proyecto
								</a>
                            </button>
                        </td>
                        <td></td>
                        <td class="text-end">
                        <a href="home.php?pg=<?= $pg; ?>&idgru=<?= $grupo['idgru']; ?>&ope=edi" title="Editar">
                            <i class="fa-solid fa-pen-to-square fa-2x text-success"></i></a>
                        <a href="home.php?pg=<?= $pg; ?>&idgru=<?= $grupo['idgru']; ?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                            <i class="fa-solid fa-trash-can fa-2x text-danger"></i></a>
                        </td>
                    </tr>
                <?php }} else { ?>
                    <tr>
                        <td colspan="3" class="text-center">No hay grupos disponibles</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    if (typeof notificationMessage !== 'undefined' && notificationMessage !== "") {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: notificationMessage
        });
    }
</script>
<script type="text/javascript" src="js/java2.js"></script>
