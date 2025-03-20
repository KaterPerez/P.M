<?php include("controllers/cval.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Valor</h1>
                <!-- <button class="btn btn-dark toggleFormButton">
                    <i class="fa-solid fa-plus"></i>
                </button> -->
            </div>
        </div>
    </div>
    <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm" style="display:none;">
        <div class="row g-3 align-items-center">
            <div class="form-group col-12 col-md-5">
                <label for="nomval"  class="form-label">Nombre de valor</label>
                <input type="text" name="nomval" id="nomval" maxlength="70" class="form-control" value="<?php if ($datOne) echo $datOne[0]['nomval']; ?>" required>
            </div>
            <div class="form-group col-12 col-md-5">
                <label for="nomdom"  class="form-label">Dominio</label>
                <select name="coddom" id="coddom" class="form-select">
                    <?php if ($datDom) {
                        foreach ($datDom as $ddo) { ?>
                            <option value="<?= $ddo['coddom']; ?>" <?php if ($datOne && $ddo['coddom'] == $datOne[0]['coddom']) echo "selected"; ?>>
                                <?= $ddo['nomdom']; ?>
                            </option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group col-5 col-md-2 text-center">
                <button type="submit" class="btn btn-primary mt-md-4 mt-2 w-100">Guardar</button>
                <input type="hidden" name="opera" value="save">
                <input type="hidden" name="codval" id="codval" value="<?php if ($datOne) echo $datOne[0]['codval']; ?>">
            </div>
        </div>
    </form>
</div>
<br>
<div class="table-responsive">
    <table id="example" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Codigo</th>
                <th>Valor</th>
                <th>Dominio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) {
                foreach ($datAll as $dta) { ?>
                    <tr>
                        <td><?= $dta['codval']; ?></td>
                        <td><?= $dta['nomval']; ?></td>
                        <td>
                            <?php if ($datDom) {
                                foreach ($datDom as $dtd) {
                                    if ($dtd['coddom'] == $dta['coddom']) {
                                        echo $dtd['nomdom'];
                                    }
                                }
                            } ?>
                        </td>
                        <td class="text-end">
                            <a href="home.php?pg=<?= $pg; ?>&codval=<?= $dta['codval']; ?>&opera=edi" title="Editar">
                                <i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                            <a href="home.php?pg=<?= $pg; ?>&codval=<?= $dta['codval']; ?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                                <i class="fa-solid fa-trash-can fa-2x"></i></a>
                        </td>
                    </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="js/java2.js"></script>