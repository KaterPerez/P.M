<?php include("controllers/cfas.php")
    ?>

<div class="container">

    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Fases del proyecto</h1>
                <button class="btn btn-dark toggleFormButton">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <form name="frm1" action="#" method="POST" class="toggleForm"
        style="<?= isset($m) && $m == 1 ? '' : 'display:none;' ?>">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nomfas">Nombre de la fase</label>
                <input type="text" class="form-control form-control" name="nomfas" id="nomfas" value="<?php if ($datOne && $datOne[0]['nomfas'])
                    echo $datOne[0]['nomfas']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="disabledSelect" class="form-label">Proyecto</label>
                <select class="form-control form-select" id="codpro" name="codpro">
                    <option value="0">Seleccione...</option>
                    <?php if (!empty($cdpro)) {
                        foreach ($cdpro as $dt) { ?>
                            <option value="<?= $dt['codpro']; ?>" <?php if ($datOne && $datOne[0]['codpro'] == $dt['codpro'])
                                  echo 'selected'; ?>>
                                <?= $dt['nompro']; ?>
                            </option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inifas">Fecha de inicio</label>
                <input type="date" class="form-control form-control" name="inifas" id="inifas" value="<?php if ($datOne && $datOne[0]['inifas'])
                    echo $datOne[0]['inifas']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="finfas">Fecha de finalizacion</label>
                <input type="date" class="form-control form-control" name="finfas" id="finfas" value="<?php if ($datOne && $datOne[0]['finfas'])
                    echo $datOne[0]['finfas']; ?>" required>
            </div>

            <div class="form-group col-md-4">
                <br>
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="codfas" value="<?php if ($datOne && $datOne[0]['codfas'])
                    echo $datOne[0]['codfas']; ?>" required>
                <input type="submit" class="btn btn-dark" value="Enviar">
            </div>

        </div>
        <br>
    </form>

    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Fase</th>
                <th>Proyecto</th>
                <th>Grupo</th>
                <th>Fecha de inicio</th>
                <th>Fecha de finalización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) {
                foreach ($datAll as $dt) { ?>
                    <tr>

                        <td><?= $dt["nomfas"]; ?></td>
                        <td><?= $dt["nompro"]; ?></td>
                        <td>Grupo</td>
                        <td><?= $dt["inifas"]; ?></td>
                        <td><?= $dt["finfas"]; ?></td>
                        <td class="text-center">
                            <a href="home.php?pg=3001&ope=del&codfas=<?= $dt["codfas"]; ?>" title="Eliminar"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta fase?');"><i
                                    class="fa-solid fa-trash text-danger" style="color: #000000;"></i></a>
                            <a href="home.php?pg=3001&ope=edi&codfas=<?= $dt["codfas"]; ?>" title="Editar"><i
                                    class="fa-solid fa-pen-to-square text-success" style="color: #000000;"></i></a>
                        </td>


                    </tr>

                <?php }
            } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="js/java2.js"></script>