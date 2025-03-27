<?php include("controllers/cregis.php"); ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Registrar Estudiante y Profesor</h1>
                <button class="btn btn-dark toggleFormButton" onclick="toggleFormulario()">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    
<form action="controllers/cmas.php" method="post" enctype="multipart/form-data">
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
        <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm" style="display:none;">
        <div class="row g-3 p-3">
            <div class="form-group col-md-3">
                <label for="nomusu">Ingrese el Nombre:</label>
                <input type="text" name="nomusu" id="nomusu" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['nomusu']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="apeusu">Ingrese el Apellido:</label>
                <input type="text" name="apeusu" id="apeusu" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['apeusu']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="tipdoc">Tipo de Documento</label>
            <select name="tipdoc" id="tipdoc" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="T.I" <?php if (!empty($datOne) && $datOne[0]['tipdoc'] == 'T.I') echo "selected"; ?>>T.I</option>
                <option value="C.C" <?php if (!empty($datOne) && $datOne[0]['tipdoc'] == 'C.C') echo "selected"; ?>>C.C</option>
            </select>
            </div>
            <div class="form-group col-md-3">
                <label for="numdoc">Ingrese el No. Documento:</label>
                <input type="text" name="numdoc" id="numdoc" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['numdoc']; ?>" required>
            </div>
            <div class="form-group col-md-1">
                <label for="actusu">Activo</label>
                <select name="actusu" id="actusu" class="form-control">
                    <option value="1" <?php if ($datOne && $datOne[0]['actusu'] == 1) echo " selected "; ?>>Si</option>
                    <option value="2" <?php if ($datOne && $datOne[0]['actusu'] == 2) echo " selected "; ?>>No</option>
                </select>
            </div> 
            <div class="form-group col-md-2">
                <label for="codper">Perfil</label>
                <select name="codper" id="codper" class="form-control" required>
                    <option value="4" <?php if (isset($datOne[0]['codper']) && $datOne[0]['codper'] == 4) echo "selected"; ?>>Estudiante</option>
                    <option value="3" <?php if (isset($datOne[0]['codper']) && $datOne[0]['codper'] == 3) echo "selected"; ?>>Profesor</option>
                </select>
            </div>

            <div class="form-group col-md-1">
                <label for="edausu">Edad:</label>
                <input type="numero" name="edausu" id="edausu" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['edausu']; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="genusu">Género:</label>
            <select name="genusu" id="genusu" class="form-control" required>
                <option value="">Seleccione...</option>
                <option value="Masculino" <?php if (!empty($datOne) && $datOne[0]['genusu'] == 'Masculino') echo "selected"; ?>>Masculino</option>
                <option value="Femenino" <?php if (!empty($datOne) && $datOne[0]['genusu'] == 'Femenino') echo "selected"; ?>>Femenino</option>
            </select>
            </div>

            <div class="form-group col-md-3">
                <label for="telusu">Ingrese el Teléfono:</label>
                <input type="text" name="telusu" id="telusu" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['telusu']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="corusu">Ingrese el Correo:</label>
                <input type="email" name="corusu" id="corusu" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['corusu']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="pasusu">Ingrese la Contraseña:</label>
                <input type="password" name="pasusu" id="pasusu" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['pasusu']; ?>" required>
            </div>
            <div class="col-12 col-md-2">
                <input class="btn btn-dark mt-4" type="submit" value="Registrar">
                <input type="hidden" name="idusu" id="idusu" 
                       value="<?php echo isset($datOne[0]['idusu']) ?($datOne[0]['idusu']) : ''; ?>">
                <input type="hidden" name="ope" value="save">
            </div>
        </div>
    </form>
    <hr>
    <table id="example" class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>  
                <th >Nombre</th>
                <th class="text-center">Activo</th>
                <th class="text-center">Perfil</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($datAll) {
                foreach ($datAll as $dta) { 
                    if ($dta['codper'] == 3 || $dta['codper'] == 4) { ?>
                        <tr>
                            <td>
                                <strong><?=$dta['nomusu'];?> <?=$dta['apeusu'];?></strong><br>
                                <small>
                                    <strong>Tipo. Documento:</strong> <?= htmlspecialchars($dta['tipdoc']); ?><br>
                                    <strong>No. Documento:</strong> <?= htmlspecialchars($dta['numdoc']); ?><br>
                                    <strong>Correo:</strong> <?= htmlspecialchars($dta['corusu']); ?>
                                </small>
                            </td>
                            <td class="text-center">
                                <?php if($dta['actusu'] == 1) { ?>
                                    <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dta['idusu']; ?>&ope=actusu">
                                        <i class="fa-solid fa-circle-check fa-2x text-success"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dta['idusu']; ?>&ope=actusu">
                                        <i class="fa-solid fa-circle-xmark fa-2x text-danger"></i>
                                    </a>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($dta['codper'] == 3) { ?>
                                    Profesor
                                <?php } elseif ($dta['codper'] == 4) { ?>
                                    Estudiante
                                <?php }?>
                            </td>
                            <td class="text-end">
                                <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dta['idusu']; ?>&ope=edi" title="Editar">
                                    <i class="fa-solid fa-pen-to-square fa-2x text-success"></i></a>
                                <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dta['idusu']; ?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                                    <i class="fa-solid fa-trash-can fa-2x text-danger"></i></a>
                            </td>
                        </tr>
                    <?php }
                }
            } else { ?>
                <tr>
                    <td colspan="5" class="text-center">No hay datos disponibles</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="js/java2.js"></script>
