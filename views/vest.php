<?php include("controllers/cregis.php"); ?>
<div class="container">
<br>
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Registrar Estudiante y Profesor</h1>
                <!-- Cambié ID a clase para mayor flexibilidad -->
                <button class="btn btn-dark toggleFormButton">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm border border-black" style="display:none;">
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
                <?php if (!empty($datVal)) {
                foreach ($datVal as $ddo) { ?>
                <option value="<?= htmlspecialchars($ddo['codval']); ?>" 
                    <?php if (!empty($datOne) && $ddo['codval'] == $datOne[0]['codval']) echo "selected"; ?>>
                    <?= htmlspecialchars($ddo['nomval']); ?>
                </option>
                <?php }} ?>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="numdoc">Ingrese el No. Documento:</label>
                <input type="text" name="numdoc" id="numdoc" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['numdoc']; ?>" required>
            </div>
            <div class="form-group col-md-1">
                <label for="codper">Activo</label>
                <select name="codper" id="codper" class="form-control">
                    <option value="4" <?php if ($datOne && $datOne[0]['codper'] == 4) echo " selected "; ?>>Estudiante</option>
                    <option value="3" <?php if ($datOne && $datOne[0]['codper'] == 3) echo " selected "; ?>>Profesor</option>
                </select>
            </div>
            
            <div class="form-group col-md-2">
                <label for="codper">Perfil</label>
                <select name="codper" id="codper" class="form-control">
                    <option value="4" <?php if ($datOne && $datOne[0]['codper'] == 4) echo " selected "; ?>>Estudiante</option>
                    <option value="3" <?php if ($datOne && $datOne[0]['codper'] == 3) echo " selected "; ?>>Profesor</option>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label for="edausu">Edad:</label>
                <input type="numero" name="edausu" id="edausu" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['edausu']; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="corusu">Genero:</label>
                <select name="codper" id="codper" class="form-control">
                    <option value="4" <?php if ($datOne && $datOne[0]['codper'] == 4) echo " selected "; ?>>Estudiante</option>
                    <option value="3" <?php if ($datOne && $datOne[0]['codper'] == 3) echo " selected "; ?>>Profesor</option>
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
                <input class="btn btn-primary mt-4" type="submit" value="Registrar">
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
                <th>Nombre </th>
                <th>Activo </th>
                <th>Perfil </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($datAll) {
                foreach ($datAll as $dta) { 
                    if ($dta['codper'] == 3 || $dta['codper'] == 4) { // Filtrar por codper = 3 o 4?>
                        <tr>
                            <td>
                                <strong><?=$dta['nomusu'];?> <?=$dta['apeusu'];?></strong><br>
                            <small>
                                
                            <strong>Tipo. Documento: </strong>
<?php 
if (!empty($datVal)) { // Asegúrate de que $datVal no esté vacío
    foreach ($datVal as $dtd) {
        if (isset($dta['codval']) && $dtd['codval'] == $dta['codval']) { // Verifica que codval exista en $dta
            echo htmlspecialchars($dtd['nomval']); // Escapar para prevenir inyecciones XSS
        }
    }
} else {
    echo "No disponible"; // Muestra un mensaje predeterminado si no hay datos
}
?><br>

                                <strong>No. Documento: </strong><?=$dta['numdoc'];?><br>
                                <strong>Correo: </strong><?=$dta['corusu'];?>
                            </small>
                            </td>
                            <td><?= $dta['corusu']; ?></td>
                            <td><?= $dta['corusu']; ?></td>
                            <td class="text-end">
                                <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dta['idusu']; ?>&ope=edi" title="Editar" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dta['idusu']; ?>&ope=eli" title="Eliminar" class="btn btn-sm btn-danger" onclick="return eliminar();">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
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