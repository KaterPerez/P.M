<?php include("controllers/cdom.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Dominio</h1>
                <!-- Cambié ID a clase para mayor flexibilidad -->
                <button class="btn btn-dark toggleFormButton">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Aseguramos que el formulario tenga la clase correcta -->
    <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm" style="display:none;">
        <div class="row g-3 p-3">
            <div class="form-group col-12 col-md-6">
                <label for="nomdom">Nombre de dominio</label>
                <input type="text" name="nomdom" id="nomdom" maxlength="70" 
                       class="form-control" value="<?php if ($datOne) echo $datOne[0]['nomdom']; ?>" required>
            </div>
            <div class="col-12 col-md-2">
                <input class="btn btn-primary mt-4" type="submit" value="Guardar">
                <input type="hidden" name="coddom" id="coddom" value="<?php if ($datOne) echo $datOne[0]['coddom']; ?>">
                <input type="hidden" name="opera" value="save">
            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Dominio</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) { foreach ($datAll as $dta) { ?>
                <tr>
                    <td><strong><?= $dta['coddom']; ?></strong></td>
                    <td><strong><?= $dta['nomdom']; ?></strong></td>
                    <td class="text-end">
                        <a href="home.php?pg=<?= $pg; ?>&coddom=<?= $dta['coddom']; ?>&opera=edi" title="Editar">
                            <i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                        <a href="home.php?pg=<?= $pg; ?>&coddom=<?= $dta['coddom']; ?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                            <i class="fa-solid fa-trash-can fa-2x"></i></a>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="js/java2.js"></script>
