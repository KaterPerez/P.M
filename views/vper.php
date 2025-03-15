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
           
            <div class=" col-md-6">
                <label for="identificacion">Tipo Identificación</label>
                <input class="un" type="text" name="tipdoc" id="tipdoc" value="<?= $dtOne && isset($dtOne['tipdoc']) ? $dtOne['tipdoc'] : ''; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="identificacion">No. Identificación</label>
                <input class="un" type="text" name="numdoc" id="numdoc" value="<?= $dtOne && isset($dtOne['numdoc']) ? $dtOne['numdoc'] : ''; ?>" readonly>
            </div>
            <div class=" col-md-6">
                <label for="corusu">Correo electrónico</label>
                <input class="un" type="text" name="corusu" id="corusu" value="<?= $dtOne && isset($dtOne['corusu']) ? $dtOne['corusu'] : ''; ?>" readonly>
            </div>
            <div class=" col-md-6">
                <label for="telusu">Teléfono</label>
                <input class="un" type="text" name="telusu" id="telusu" value="<?= $dtOne && isset($dtOne['telusu']) ? $dtOne['telusu'] : ''; ?>" readonly>
            </div>
            <div class=" col-md-6">
                <label for="edausu">Edad</label>
                <input class="un" type="text" name="edausu" id="edausu" value="<?= $dtOne && isset($dtOne['edausu']) ? $dtOne['edausu'] : ''; ?>" readonly>
            </div>
           
            <div class=" col-md-6">
                <label for="genusu">Genero </label>
                <input class="un" type="text" name="genusu" id="genusu" value="<?= $dtOne && isset($dtOne['genusu']) ? $dtOne['genusu'] : ''; ?>" readonly>
            </div>
            <div class="fi col-md-4">
                <label for="ubicacion">Subir foto</label>
                <input type="file" name="foto" id="fotcan" class="form-control" accept="image/png, image/jpeg"><br>
            </div>
            <div class=" col-md-2" >
            <br>
            <input class="btn btn-primary" type="submit" value="Actualizar">
            <input type="hidden" name="idusu" id="idusu" value="<?php if($datOne) echo $datOne[0]['idusu'];?>">
            <input type="hidden" name="opera" value="save">
        </div>
        </div>
    </div>
</form>

