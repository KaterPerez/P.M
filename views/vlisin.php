<?php include("controllers/clisin.php")?>

<div class="container">

    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Instituciones</h1>
                <button class="btn btn-dark toggleFormButton" onclick="toggleFormulario()">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <form name="frm1" action="#" method="POST" class="toggleForm"
        style="<?= isset($m) && $m == 1 ? '' : 'display:none;' ?>">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="nomie">Nombre de la institución</label>
                <input type="text" class="form-control form-control" name="nomie" id="nomie" value="<?php if ($datOne && $datOne[0]['nomie'])
                    echo $datOne[0]['nomie']; ?>" required>
            </div>
            <div class="form-group col-md-2">
              <label for="tipie">Tema del proyecto</label>
              <select name="tipie" id="tipie" class="form-select" required>
                  <option value="">Seleccione...</option>
                  <option value="Educacion superior" <?= isset($datOne[0]['tipie']) && $datOne[0]['tipie'] == 'Educacion superior' ? 'selected' : ''; ?>>Educación superior</option>
                  <option value="Educacion publica" <?= isset($datOne[0]['tipie']) && $datOne[0]['tipie'] == 'Educacion publica' ? 'selected' : ''; ?>>Educación publica</option>
                  <option value="Educacion privada" <?= isset($datOne[0]['tipie']) && $datOne[0]['tipie'] == 'Educacion privada' ? 'selected' : ''; ?>>Educación privada</option>
              </select>
          </div>
            <div class="form-group col-md-3">
              <label for="nuicie">Numero de identificación</label>
              <input type="text" class="form-control form-control" name="nuicie" id="nuicie" value="<?php if ($datOne && $datOne[0]['nuicie'])
                  echo $datOne[0]['nuicie']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="munie">Municipio</label>
                <input type="text" class="form-control form-control" name="munie" id="munie" value="<?php if ($datOne && $datOne[0]['munie'])
                    echo $datOne[0]['munie']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="dirie">Dirección</label>
                <input type="text" class="form-control form-control" name="dirie" id="dirie" value="<?php if ($datOne && $datOne[0]['dirie'])
                    echo $datOne[0]['dirie']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="corie">Correo</label>
                <input type="text" class="form-control form-control" name="corie" id="corie" value="<?php if ($datOne && $datOne[0]['corie'])
                    echo $datOne[0]['corie']; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="telie">Telefono</label>
                <input type="text" class="form-control form-control" name="telie" id="telie" value="<?php if ($datOne && $datOne[0]['telie'])
                    echo $datOne[0]['telie']; ?>" required>
            </div>
            <div class="form-group col-md-1">
                <label for="actie">Activo</label>
                <select name="actie" id="actie" class="form-control">
                    <option value="0">...</option>
                    <option value="1" <?php if ($datOne && $datOne[0]['actie'] == 1) echo " selected "; ?>>Si</option>
                    <option value="2" <?php if ($datOne && $datOne[0]['actie'] == 2) echo " selected "; ?>>No</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <br>
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="codie" value="<?php if ($datOne && $datOne[0]['codie'])echo $datOne[0]['codie']; ?>">
                <input type="submit" class="btn btn-dark" value="Enviar">
            </div>
        </div>
        <br>
    </form>

    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Institución</th>
                <th>Tipo</th>
                <th># Identificacion</th>
                <th>Departamento</th> 
                <th>Municipio</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) {
                foreach ($datAll as $dt) { ?>
                    <tr>

                      <td><?= $dt["nomie"]; ?></td>
                      <td><?= $dt["tipie"]; ?></td>
                      <td><?= $dt["nuicie"]; ?></td>
                      <td><?= $dt["munie"]; ?></td>
                      <td><?= $dt["dirie"]; ?></td>
                      <td><?= $dt["corie"]; ?></td>
                      <td><?= $dt["telie"]; ?></td>
                      <td>
                        <?php if($dt['actie'] == 1) { ?>
                          <a href="home.php?pg=<?= $pg; ?>&codie=<?= $dt['codie']; ?>&ope=actie">
                            <i class="fa-solid fa-circle-check fa-2x text-success"></i>
                          </a>
                        <?php } else { ?>
                          <a href="home.php?pg=<?= $pg; ?>&codie=<?= $dt['codie']; ?>&ope=actie">
                            <i class="fa-solid fa-circle-xmark fa-2x text-danger"></i>
                          </a>
                        <?php } ?>
                      </td>
                        <td class="text-center">
                            <a href="home.php?pg=4002&ope=edi&codie=<?= $dt["codie"]; ?>" title="Editar"><i
                                    class="fa-solid fa-pen-to-square text-success" style="color: #000000;"></i></a>
                            <a href="home.php?pg=4002&ope=del&codie=<?= $dt["codie"]; ?>" title="Eliminar"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta fase?');"><i
                                    class="fa-solid fa-trash text-danger" style="color: #000000;"></i></a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="js/java2.js"></script>
