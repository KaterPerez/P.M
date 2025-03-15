<?php include ("controllers/cregis.php");?>
<div class="ñl">
  <div class="rp">
    <h4  border-white>Registro de Estudiante</h4>
  </div>
  <form id="frmins" class="dg" action="home.php?pg=<?=$pg;?>" method="POST">
    <div class="row ">
        <div class="form-group col-md-6">
            <label for="nomdom">Ingrese el Nombre:</label>
            <input type="text" name="nomusu" id="nomusu" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['nomusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="nomdom">Ingrese el Apellido:</label>
            <input type="text" name="apeusu" id="apeusu" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['apeusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="nomdom">Ingrese el No. Documento:</label>
            <input type="text" name="numdoc" id="numdoc" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['numdoc']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="nomdom">Ingrese el Teléfono:</label>
            <input type="text" name="telusu" id="telusu" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['telusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="nomdom">Ingrese el Correo:</label>
            <input type="text" name="corusu" id="corusu" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['corusu']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="nomdom">Ingrese la Contraseña:</label>
            <input type="text" name="pasusu" id="pasusu" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['pasusu']; ?>" required>
        </div>
        <div class="col-md-2" style="margin:auto;">
    <input class="btn btn-primary" type="submit" value="Registrar">
    <input type="hidden" name="idusu" id="idusu" 
           value="<?php echo isset($datOne[0]['idusu']) ?($datOne[0]['idusu']) : ''; ?>">
    <input type="hidden" name="ope" value="save">
</div>

    </div>
  </form>
  
  <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>  
            <th>Nombre</th>
            <th>Apellido</th>
            <th>No.Documento</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) { foreach ($datAll AS $dta) { ?>       
            <tr>
                <td>
                    <strong><?=$dta['nomusu'];?></strong><br>
                </td>
                <td>
                    <strong><?=$dta['apeusu'];?></strong><br>
                </td>
                <td>
                    <strong><?=$dta['numdoc'];?></strong><br>
                </td>
                <td>
                    <strong><?=$dta['corusu'];?></strong><br>
                </td>
                <td style="text-align:right;">
                <a href="home.php?pg=<?=$pg;?>& idusu=<?=$dta['idusu'];?>&ope=edi" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>& idusu=<?=$dta['idusu'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
                </td>
            </tr>
        <?php }} ?>      
    </tbody>
    <tfoot>
    <tr>  
            <th>Nombre</th>
            <th>Apellido</th>
            <th>No.Documento</th>
            <th>Correo</th>
        </tr>
    </tfoot>
</table> 
</div>


