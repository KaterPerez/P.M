<?php include("controllers/cact.php") ?>

<div class="container">

    <div class="row">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center py-3">
                <h1 class="me-3">Actividad de proyecto</h1>
            </div>
        </div>
    </div>


    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Actividad</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Fase</th>
                <th class="text-center">Fecha de inicio</th>
                <th class="text-center">Fecha de finalización</th>
                <th class="text-center">Archivo</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) {
                foreach ($datAll as $dt) { ?>
                    <tr>
                        <td class="text-center"><?= $dt["nomact"]; ?></td>
                        <td class="text-center"><?= $dt["desact"]; ?></td>
                        <td class="text-center"><?= $dt["nomfas"]; ?></td>
                        <td class="text-center"><?= $dt["iniact"]; ?></td>
                        <td class="text-center"><?= $dt["finact"]; ?></td>
                        <td>
                            <?php if (!empty($dt['archivo'])) { ?>
                                <a href="uploads/<?= htmlspecialchars($dt['archivo']); ?>" target="_blank">Ver archivo</a>
                            <?php } else { ?>
                                No hay archivo
                            <?php } ?>
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
