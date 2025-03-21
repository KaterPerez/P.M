<?php include("controllers/cregis.php"); ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Listar Estudiantes </h1>
            </div>
        </div>
    </div>
    <hr>
    <table id="example" class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>  
                <th>Nombre</th>
                <th>Activo</th>
                <th>Perfil</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($datAll) {
                foreach ($datAll as $dta) { 
                    if ($dta['codper'] == 4) { ?>
                        <tr>
                            <td>
                                <strong><?=$dta['nomusu'];?> <?=$dta['apeusu'];?></strong><br>
                                <small>
                                    <strong>Tipo. Documento:</strong> <?= htmlspecialchars($dta['tipdoc']); ?><br>
                                    <strong>No. Documento:</strong> <?= htmlspecialchars($dta['numdoc']); ?><br>
                                    <strong>Correo:</strong> <?= htmlspecialchars($dta['corusu']); ?>
                                </small>
                            </td>
                            <td>
                            </td>
                            <td>
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
