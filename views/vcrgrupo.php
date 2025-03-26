<?php include("controllers/ccrgrupo.php") ?>
<div class="container">

    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Crear Proyecto</h1>
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
                <label for="nompro">Nombre del proyecto</label>
                <input type="text" class="form-control form-control" name="nompro" id="nompro" value="<?php if ($datOne && $datOne[0]['nompro'])
                    echo $datOne[0]['nompro']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="disabledSelect" class="form-label">Grupo</label>
                <select class="form-control form-select" id="idgru" name="idgru">
                    <option value="0">Seleccione...</option>
                    <?php if (!empty($cdgru)) {
                        foreach ($cdgru as $dt) { ?>
                            <option value="<?= $dt['idgru']; ?>" <?php if ($datOne && $datOne[0]['idgru'] == $dt['idgru'])
                                  echo 'selected'; ?>>
                                <?= $dt['nomgru']; ?>
                            </option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="tempro">Tema del proyecto</label>
              <select name="tempro" id="tempro" class="form-select" required>
                  <option value="">Seleccione...</option>
                  <option value="Tecnologicos y de Programacion" <?= isset($datOne[0]['tempro']) && $datOne[0]['tempro'] == 'Tecnologicos y de Programacion' ? 'selected' : ''; ?>>Tecnologicos y de Programacion</option>
                  <option value="Ciencias y Medio Ambiente" <?= isset($datOne[0]['tempro']) && $datOne[0]['tempro'] == 'Ciencias y Medio Ambiente' ? 'selected' : ''; ?>>Ciencias y Medio Ambiente</option>
                  <option value="Emprendimiento y Negocios" <?= isset($datOne[0]['tempro']) && $datOne[0]['tempro'] == 'Emprendimiento y Negocios' ? 'selected' : ''; ?>>Emprendimiento y Negocios</option>
                  <option value="Arte y Cultura" <?= isset($datOne[0]['tempro']) && $datOne[0]['tempro'] == 'Arte y Cultura' ? 'selected' : ''; ?>>Arte y Cultura</option>
                  <option value="Ciencias sociales y Educacion" <?= isset($datOne[0]['tempro']) && $datOne[0]['tempro'] == 'Ciencias sociales y Educacion' ? 'selected' : ''; ?>>Ciencias sociales y Educacion</option>
              </select>
          </div>
            <div class="form-group col-md-4">
                <label for="inipro">Fecha de inicio</label>
                <input type="date" class="form-control form-control" name="inipro" id="inipro" value="<?php if ($datOne && $datOne[0]['inipro'])
                    echo $datOne[0]['inipro']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="finpro">Fecha de finalizacion</label>
                <input type="date" class="form-control form-control" name="finpro" id="finpro" value="<?php if ($datOne && $datOne[0]['finpro'])
                    echo $datOne[0]['finpro']; ?>" required>
            </div>

            <div class="form-group col-md-4">
                <br>
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="codpro" value="<?php if ($datOne && $datOne[0]['codpro'])
                    echo $datOne[0]['codpro']; ?>" required>
                <input type="submit" class="btn btn-dark" value="Enviar">
            </div>

        </div>
        <br>
    </form>

    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Proyecto</th>
                <th>Grupo</th>
                <th>Tema del proyecto</th>
                <th>Fecha de inicio</th>
                <th>Fecha de finalización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) {
                foreach ($datAll as $dt) { ?>
                    <tr>

                        <td><?= $dt["nompro"]; ?></td>
                        <td><?= $dt["nomgru"]; ?></td>
                        <td><?= $dt["tempro"]; ?></td>
                        <td><?= $dt["inipro"]; ?></td>
                        <td><?= $dt["finpro"]; ?></td>
                        <td class="text-center">
                            <a href="home.php?pg=2003&ope=del&codpro=<?= $dt["codpro"]; ?>" title="Eliminar"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');"><i
                                    class="fa-solid fa-trash text-danger" style="color: #000000;"></i></a>
                            <a href="home.php?pg=2003&ope=edi&codpro=<?= $dt["codpro"]; ?>" title="Editar"><i
                                    class="fa-solid fa-pen-to-square text-success" style="color: #000000;"></i></a>
                        </td>


                    </tr>

                <?php }
            } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="js/java2.js"></script>
