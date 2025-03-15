<?php require_once('controllers/ccrecur.php'); ?>

<div class="container">
    <br>
    <br>

    <!-- Formulario para agregar o editar curso -->
    <form name="frm1" action="#" method="POST">
        <div class="row">
            <!-- Campo para el nombre del curso -->
            <div class="form-group col-md-4">
                <label for="nomcur">Nombre del Curso</label>
                <input type="text" class="form-control" name="nomcur" value="<?php if (isset($getOne) && isset($getOne[0])) echo $getOne[0]['nomcur']; ?>" required>
            </div>

            <!-- Campo para el código del curso -->
            <div class="form-group col-md-4">
                <label for="codcur">Código del Curso</label>
                <input type="text" class="form-control" name="codcur" value="<?php if (isset($getOne) && isset($getOne[0])) echo $getOne[0]['codcur']; ?>" required>
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="form-group col-md-10">
                <br>
                <input type="hidden" name="ope" value="save">
                <input type="submit" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </form>

    <!-- Tabla para mostrar los cursos -->
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Cod.Curso</th>
                <th>Nombre del Curso</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($datCursos) {
                foreach ($datCursos as $curso) {
                    ?>
                    <tr>
                        <td><?= $curso['codcur']; ?></td>
                        <td><?= $curso['nomcur']; ?></td>
                        <td>
                            <?php
                            ?>
                        </td>
                        <td>
    <!-- Enlace para editar curso -->
    <a href="home.php?pg=<?=$pg;?>&codcur=<?=$curso['codcur']; ?>&ope=editc" title="Editar">
        <i class="fa-solid fa-pencil"></i>
    </a>

    <!-- Enlace para eliminar curso -->
    <a href="home.php?pg=<?=$pg;?>&codcur=<?=$curso['codcur']; ?>&ope=delc" title="Eliminar">
        <i class="fa-solid fa-trash"></i>
    </a>
</td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Cod.Curso</th>
                <th>Nombre del Curso</th>
            </tr>
        </tfoot>
    </table>
</div>
