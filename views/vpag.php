<?php require_once ('controllers/cpag.php');?>

<div class="container py-4">
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Paginas</h1>
                <!-- Cambié ID a clase para mayor flexibilidad -->
                <button class="btn btn-dark toggleFormButton" onclick="toggleFormulario()">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" class="toggleForm" style="display:none;">
        <div class="row g-3">
            <div class="form-group col-12 col-md-6">
                <label for="nompag">Nombre</label>
                <input type="text" name="nompag" id="nompag" maxlength="70" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['nompag']; ?>" required>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="rutpag">Ruta</label>
                <input type="text" name="rutpag" id="rutpag" class="form-control" 
                       value="<?php if($datOne) echo $datOne[0]['rutpag']; ?>" required>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="mospag">Mostrar</label>
                <select name="mospag" id="mospag" class="form-control">
                    <option value="1" <?php if ($datOne && $datOne[0]['mospag'] == 1) echo "selected"; ?>>Si</option>
                    <option value="2" <?php if ($datOne && $datOne[0]['mospag'] == 2) echo "selected"; ?>>No</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-2 d-flex align-items-center justify-content-center">
                <input class="btn btn-dark mt-4" type="submit" value="Guardar">
                <input type="hidden" name="codpag" id="codpag" value="<?php if($datOne) echo $datOne[0]['codpag']; ?>">
                <input type="hidden" name="opera" value="save">
            </div>
        </div>
    </form>
    <div class="row mt-4">
        <div class="col-12">
            <table id="example" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Página</th>
                        <th class="text-center">Mostrar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($datAll) { foreach ($datAll as $dta) { ?>       
                        <tr>
                            <td class="text-center">
                                <strong><?=$dta['codpag'];?> - <?=$dta['nompag'];?></strong><br>
                                <small><strong>Ruta: </strong><?=$dta['rutpag'];?></small>
                            </td>
                            <td class="text-center">
                                <?php if($dta['mospag']==1){ ?>
                                    <a href="home.php?pg=<?=$pg;?>&codpag=<?=$dta['codpag'];?>&opera=acti&mospag=2">
                                        <i id="vp" class="fa-solid fa-circle-check fa-2x text-success"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="home.php?pg=<?=$pg;?>&codpag=<?=$dta['codpag'];?>&opera=acti&mospag=1">
                                        <i class="fa-solid fa-circle-xmark fa-2x text-danger"></i>
                                    </a>
                                <?php } ?>
                            </td>
                            <td class="text-end">
                                <a href="home.php?pg=<?=$pg;?>&codpag=<?=$dta['codpag'];?>&opera=edi" title="Editar">
                                    <i class="fa-solid fa-pen-to-square fa-2x text-success"></i></a>
                                <a href="home.php?pg=<?=$pg;?>&codpag=<?=$dta['codpag'];?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                                    <i class="fa-solid fa-trash-can fa-2x text-danger"></i></a>
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
        </div>
    </div>
</div>

<script type="text/javascript" src="js/java2.js"></script>
