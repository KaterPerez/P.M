<?php require_once('controllers/ccrecur.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Cursos</h1>
                <button class="btn btn-dark toggleFormButton">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm">
    <div class="row g-3 p-3">
        <div class="form-group col-12 col-md-6">
            <label for="codcur">Número del Curso</label>
            <input type="text" class="form-control" name="codcur" value="<?php echo isset($datOne[0]['codcur']) ? $datOne[0]['codcur'] : ''; ?>" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="nomcur">Nombre del Curso</label>
            <input type="text" class="form-control" name="nomcur" value="<?php echo isset($datOne[0]['nomcur']) ? $datOne[0]['nomcur'] : ''; ?>" required>
        </div>
        <input type="hidden" name="idcur" value="<?php echo isset($datOne[0]['idcur']) ? $datOne[0]['idcur'] : ''; ?>">
        <input type="hidden" name="ope" value="save">
        <div class="col-12 col-md-2">
            <input class="btn btn-primary mt-4" type="submit" value="Guardar">
        </div>
    </div>
    </form>

</div>
<div class="table-responsive">
    <table id="example" class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Número de curso</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) { foreach ($datAll as $dta) { ?>
                <tr>
                    <td><strong><?= $dta['codcur']; ?></strong></td>
                    <td><strong><?= $dta['nomcur']; ?></strong></td>
                    <td class="text-end">
                        <a href="home.php?pg=<?= $pg; ?>&idcur=<?= $dta['idcur']; ?>&ope=edi" title="Editar">
                            <i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                        <a href="home.php?pg=<?= $pg; ?>&idcur=<?= $dta['idcur']; ?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                            <i class="fa-solid fa-trash-can fa-2x"></i></a>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="js/java2.js"></script>
