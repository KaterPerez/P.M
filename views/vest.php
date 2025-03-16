<?php include("controllers/cregis.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between my-4">
                <h4>Registro de Estudiante</h4>
                <a href="home.php?pg=<?= $pg; ?>" class="btn btn-primary">Nuevo Registro</a>
            </div>
        </div>
    </div>

    <form id="frmins" class="row g-3" action="home.php?pg=<?= $pg; ?>" method="POST">
        <div class="form-group col-md-6">
            <label for="nomusu">Ingrese el Nombre:</label>
            <input type="text" name="nomusu" id="nomusu" maxlength="70" class="form-control" 
                   value="<?php if($datOne) echo $datOne[0]['nomusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="apeusu">Ingrese el Apellido:</label>
            <input type="text" name="apeusu" id="apeusu" maxlength="70" class="form-control" 
                   value="<?php if($datOne) echo $datOne[0]['apeusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="numdoc">Ingrese el No. Documento:</label>
            <input type="text" name="numdoc" id="numdoc" maxlength="70" class="form-control" 
                   value="<?php if($datOne) echo $datOne[0]['numdoc']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="codper">Perfil</label>
            <select name="codper" id="codper" class="form-control">
                <option value="3" <?php if ($datOne && $datOne[0]['codper'] == 3) echo " selected "; ?>>Estudiante</option>
                <option value="4" <?php if ($datOne && $datOne[0]['codper'] == 4) echo " selected "; ?>>Profesor</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="telusu">Ingrese el Teléfono:</label>
            <input type="text" name="telusu" id="telusu" maxlength="70" class="form-control" 
                   value="<?php if($datOne) echo $datOne[0]['telusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="corusu">Ingrese el Correo:</label>
            <input type="email" name="corusu" id="corusu" maxlength="70" class="form-control" 
                   value="<?php if($datOne) echo $datOne[0]['corusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="pasusu">Ingrese la Contraseña:</label>
            <input type="password" name="pasusu" id="pasusu" maxlength="70" class="form-control" 
                   value="<?php if($datOne) echo $datOne[0]['pasusu']; ?>" required>
        </div>
        <div class="form-group col-md-12 text-end">
            <button type="submit" class="btn btn-success">Registrar</button>
            <input type="hidden" name="idusu" id="idusu" 
                   value="<?php echo isset($datOne[0]['idusu']) ?($datOne[0]['idusu']) : ''; ?>">
            <input type="hidden" name="ope" value="save">
        </div>
    </form>

    <hr>

    <table id="example" class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>  
                <th>Nombre</th>
                <th>Apellido</th>
                <th>No. Documento</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($datAll) {
                foreach ($datAll as $dta) { 
                    if ($dta['codper'] == 3 || $dta['codper'] == 4) { // Filtrar por codper = 3 o 4 ?>
                        <tr>
                            <td><?= $dta['nomusu']; ?></td>
                            <td><?= $dta['apeusu']; ?></td>
                            <td><?= $dta['numdoc']; ?></td>
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