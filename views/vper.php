<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('controllers/cper.php');
?>

<form class="perin" name="frm1" method="POST" action="controllers/cper.php" enctype="multipart/form-data">
    <input type="hidden" name="idusu" value="<?= $_SESSION['idusu'] ?? ''; ?>">
    <input type="hidden" name="ope" value="<?= isset($dtOne) ? 'edit' : 'save'; ?>">

    <div class="perftada">
        <div class="peavat">
            <i class="img-avatar fa-solid fa-user"></i>
        </div>
    </div>

    <div class="perbio border">
        <h3 class="oltu">
            <input class="on" type="text" name="nomusu" value="<?= $dtOne && isset($dtOne['nomusu'], $dtOne['apeusu']) ? $dtOne['nomusu'] . ' ' . $dtOne['apeusu'] : ''; ?>" readonly>
        </h3>
    </div>

    <div class="perfo">
        <div class="datos row">
            <div class="col-md-6">
                <label for="tipdoc">Tipo Identificación</label>
                <input class="un" type="text" name="tipdoc" id="tipdoc" value="<?= $dtOne['tipdoc'] ?? ''; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="numdoc">No. Identificación</label>
                <input class="un" type="text" name="numdoc" id="numdoc" value="<?= $dtOne['numdoc'] ?? ''; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="corusu">Correo electrónico</label>
                <input class="un" type="text" name="corusu" id="corusu" value="<?= $dtOne['corusu'] ?? ''; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="telusu">Teléfono</label>
                <input class="un" type="text" name="telusu" id="telusu" value="<?= $dtOne['telusu'] ?? ''; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="edausu">Edad</label>
                <input class="un" type="text" name="edausu" id="edausu" value="<?= $dtOne['edausu'] ?? ''; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="genusu">Género</label>
                <input class="un" type="text" name="genusu" id="genusu" value="<?= $dtOne['genusu'] ?? ''; ?>" readonly>
            </div>
            <div class="fi col-md-4">
                <label for="fotper">Subir foto</label>
                <input type="file" name="fotper" id="fotper" class="form-control" accept="image/png, image/jpeg"><br>
            </div>
            <div class="col-md-2">
                <br>
                <input class="btn btn-primary" type="submit" value="Actualizar">
            </div>
        </div>
    </div>
</form>

