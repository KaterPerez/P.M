<?php include("controllers/cact.php") ?>

<div class="container">

    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Actividad de proyecto</h1>
                <button class="btn btn-dark toggleFormButton" onclick="toggleFormulario()">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <form name="frm1" action="#" method="POST" class="toggleForm"
        style="<?= isset($m) && $m == 1 ? '' : 'display:none;' ?>">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nomact">Nombre de la actividad</label>
                <input type="text" class="form-control form-control" name="nomact" id="nomact" value="<?php if ($datOne && $datOne[0]['nomact'])
                    echo $datOne[0]['nomact']; ?>" required>
            </div>
            <div class="form-group col-md-5">
                <label for="desact">Descripción de la actividad</label>
                <input type="text" class="form-control form-control" name="desact" id="desact" value="<?php if ($datOne && $datOne[0]['desact'])
                    echo $datOne[0]['desact']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="disabledSelect" class="form-label">Fase</label>
                <select class="form-control form-select" id="codfas" name="codfas">
                    <option value="0">Seleccione...</option>
                    <?php if (!empty($cdpro)) {
                        foreach ($cdpro as $dt) { ?>
                            <option value="<?= $dt['codfas']; ?>" <?php if ($datOne && $datOne[0]['codfas'] == $dt['codfas'])
                                  echo 'selected'; ?>>
                                <?= $dt['nomfas']; ?>
                            </option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="iniact">Fecha de inicio</label>
                <input type="date" class="form-control form-control" name="iniact" id="iniiniactas" value="<?php if ($datOne && $datOne[0]['iniact'])
                    echo $datOne[0]['iniact']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="finact">Fecha de finalizacion</label>
                <input type="date" class="form-control form-control" name="finact" id="finact" value="<?php if ($datOne && $datOne[0]['finact'])
                    echo $datOne[0]['finact']; ?>" required>
            </div>

            <div class="form-group col-md-4">
                <br>
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="codact" value="<?php if ($datOne && $datOne[0]['codact'])
                    echo $datOne[0]['codact']; ?>" required>
                <input type="submit" class="btn btn-dark" value="Enviar">
            </div>

        </div>
        <br>
    </form>

    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Actividad</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Fase</th>
                <th class="text-center">Fecha de inicio</th>
                <th class="text-center">Fecha de finalización</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) {
                foreach ($datAll as $dt) { ?>
                    <tr>
                        <td class="text-center"><?= $dt["nomact"]; ?></td>
                        <td class="text-center"><?= $dt["desact"]; ?></td>
                        <td class="text-center"><?= $dt["nomfas"]; ?></td>
                        <td class="text-center"><?= $dt["iniact"]; ?></td>
                        <td class="text-center"><?= $dt["finact"]; ?></td>
                        <td class="text-center"> <!-- Botón para abrir el modal -->
                            <button>
                                <div class="col-md-5">
                                    <input type="file" name="archivo" id="archivo" accept=".pdf, .docx, .xlsx, .xls"
                                        class="form-control" style="width: 100%;">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-dark">Cargar Datos</button>
                                </div>
                            </button>
                        </td>
                        <td class="text-center">
                            <a href="home.php?pg=3002&ope=edi&codact=<?= $dt["codact"]; ?>" title="Editar">
                                <i class="fa-solid fa-pen-to-square fa-2x text-success" style="color: #000000;"></i>
                            </a>
                            <a href="home.php?pg=3002&ope=del&codact=<?= $dt["codact"]; ?>" title="Eliminar"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta Actividad?');"><i class="fa-solid fa-trash fa-2x text-danger" style="color: #000000;"></i>
                            </a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="js/java2.js"></script>
