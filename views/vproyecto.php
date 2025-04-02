<?php include("controllers/ccrgrupo.php") ?>
<div class="container">

    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Ver Proyecto</h1>
            </div>
        </div>
    </div>


    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Proyecto</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Grupo</th>
                <th class="text-center">Tema del proyecto</th>
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
                        <td class="text-center"><?= $dt["nompro"]; ?></td>
                        <td class="text-center"><?= $dt["despro"]; ?></td>
                        <td class="text-center"><?= $dt["nomgru"]; ?></td>
                        <td class="text-center"><?= $dt["tempro"]; ?></td>
                        <td class="text-center"><?= $dt["inipro"]; ?></td>
                        <td class="text-center"><?= $dt["finpro"]; ?></td>
                        <td class="text-center">                        
                        </td>
                        <td class="text-center">
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="js/java2.js"></script>
