<?php require_once ('controllers/cpag.php');?>

<form id="frmins"  class="dg" action="home.php?pg=<?=$pg;?>" method="POST">
    <div class="row ">
        <div class="form-group col-md-6">
            <label for="nompag">Nombre</label>
            <input type="text" name="nompag" id="nompag" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['nompag']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="rutpag">Ruta</label>
            <input type="text" name="rutpag" id="rutpag" class="form-control" required value="<?php if($datOne) echo $datOne[0]['rutpag']; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="mospag">Mostrar</label>
            <select name="mospag" id="mospag" class="form-control">
                <option value="1" <?php if ($datOne && $datOne[0]['mospag'] == 1) echo " selected "; ?>>Si</option>
                <option value="2" <?php if ($datOne && $datOne[0]['mospag'] == 2) echo " selected "; ?>>No</option>
            </select>
        </div>
        <div class=" col-md-2" style="margin:auto;">
            <input class="btn btn-primary" type="submit" value="Guardar">
            <input type="hidden" name="codpag" id="codpag" value="<?php if($datOne) echo $datOne[0]['codpag'];?>">
            <input type="hidden" name="opera" value="save">
        </div>
    </div>
</form>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>  
            
            <th>Página</th>
            <th>Mostrar</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) { foreach ($datAll AS $dta) { ?>       
            <tr>
                <td>
                    <strong><?=$dta['codpag'];?> - <?=$dta['nompag'];?></strong><br>
                    <small>
                        <strong>Ruta: </strong><?=$dta['rutpag'];?>
                    </small>
                </td>
                <td>
                <?php if($dta['mospag']==1){ ?>
                        <a href="home.php?pg=<?=$pg;?>& codpag=<?=$dta['codpag'];?>&opera=acti&mospag=2">
                            <i id="vp" class="fa fa-solid fa-circle-check fa-2x "></i>
                        </a>
                    <?php }else{ ?>
                        <a href="home.php?pg=<?=$pg;?>& codpag=<?=$dta['codpag'];?>&opera=acti&mospag=1">
                        <i class="fa fa-solid fa-circle-xmark fa-2x " style="color: #ff0000;"></i>
                        </a>
                    <?php } ?>
                </td>
                
                <td style="text-align:right;">
                <a href="home.php?pg=<?=$pg;?>& codpag=<?=$dta['codpag'];?>&opera=edi" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>& codpag=<?=$dta['codpag'];?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
                </td>
            </tr>
        <?php }} ?>      
    </tbody>
    <tfoot>
        <tr>

            <th>Página</th>
            <th>Mostrar</th>
            
            <th></th>
        </tr>
    </tfoot>
</table> 
<script type="text/javascript" src="js/java2.js"></script>
