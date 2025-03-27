<?php require_once('controllers/ccrecur.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Cursos</h1>
                <button class="btn btn-dark toggleFormButton" onclick="toggleFormulario()">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <form action="controllers/cmac.php" method="post" enctype="multipart/form-data">
        <div class="row align-items-end">
            <div class="col-md-4">
                <label for="archivo" class="form-label">Selecciona el archivo Excel:</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx, .xls" class="form-control" style="width: 100%;">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-dark">Cargar Datos</button>
            </div>
        </div>
    </form>
    <br>
    <br>

    <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm" style="display:none;">
        <div class="row g-3 p-3">
            <div class="form-group col-12 col-md-3">
                <label for="codcur">Número del Curso</label>
                <input type="text" class="form-control" name="codcur" value="<?= isset($datOne[0]['codcur']) ? $datOne[0]['codcur'] : ''; ?>" required>
            </div>
            <div class="form-group col-12 col-md-3">
                <label for="nomcur">Nombre del Curso</label>
                <input type="text" class="form-control" name="nomcur" value="<?= isset($datOne[0]['nomcur']) ? $datOne[0]['nomcur'] : ''; ?>" required>
            </div>
            <div class="form-group col-12 col-md-4">
            <label for="idusu">Asignar Profesor:</label>
                <select name="idusu" id="idusu" class="form-control">
                        <option value="">-- Seleccione un profesor --</option>
                        <?php foreach ($professors as $prof) { ?>
                            <option value="<?= $prof['idusu'] ?>" <?= ($idusu == $prof['idusu']) ? 'selected' : '' ?>>
                                <?= $prof['nombre'] ?>
                            </option>
                        <?php } ?>
                </select>
            </div>
            <input type="hidden" name="idcur" value="<?= isset($datOne[0]['idcur']) ? $datOne[0]['idcur'] : ''; ?>">
            <input type="hidden" name="ope" value="save">
            <div class="col-12 col-md-2">
                <input class="btn btn-dark mt-4" type="submit" value="Guardar">
            </div>
        </div>
    </form>
    <br>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Número de curso</th>
                    <th class="text-center">Nombre del Curso</th>
                    <th class="text-center">Profesor</th>
                    <th class="text-center">Añadir Estudiante</th>
                    <th class="text-center">Descargar Lista</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($datAll) { foreach ($datAll as $curso) { ?>
                    <tr>
                        <td class="text-center"><?= $curso['codcur']; ?></td>
                        <td class="text-center"><?= $curso['nomcur']; ?></td>
                        <td class="text-center">
                            <?php 
                            // Buscar el profesor asignado al curso
                            $nombreProfesor = "No asignado"; // Por defecto
                            foreach ($professors as $prof) { 
                                if ($prof['idusu'] == $curso['idusu']) { 
                                    $nombreProfesor = $prof['nombre']; 
                                    break; // Encontró el profesor, no sigue buscando
                                }
                            }
                            echo $nombreProfesor;
                            ?>
                        </td>
                        <td class="text-center"><!-- Botón para abrir el modal -->
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCurso<?= $curso['idcur']; ?>">
                                <i class="fa-solid fa-user-plus"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <a href="views/vpdfcur.php?idcur=<?= $curso['idcur']; ?>" class="btn btn-danger">
                                <i class="fa-solid fa-file-pdf"></i>PDF
                            </a>

                        </td>
                        <td class="text-end">
                        <a href="home.php?pg=<?= $pg; ?>&idcur=<?= $curso['idcur']; ?>&ope=edi" title="Editar">
                            <i class="fa-solid fa-pen-to-square fa-2x text-success "></i></a>
                        <a href="home.php?pg=<?= $pg; ?>&idcur=<?= $curso['idcur']; ?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                            <i class="fa-solid fa-trash-can fa-2x text-danger"></i></a>
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
