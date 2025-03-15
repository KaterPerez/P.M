<?php include("controllers/cregis.php") ?>
<form action="" method="POST" class="regis row">
    <h1 class="til">Registro</h1>
    <div class="input-group">
        <div class="regi-fi col-md-6">
            <i class="fa-solid fa-lock"></i>
            <input class="in" name="nuicie" id="nuicie" type="number" placeholder="Ingrese con el numero de identificacion" required>
        </div>
        <div class="regi-fi col-md-6">
            <i class="fa-solid fa-school"></i>
            <input class="in" name="nomie" id="nomie" type="text" placeholder="Ingrese el nombre IE" required>
        </div>
        <div class="regi-fi col-md-5">
            <i class="fa-solid fa-envelope"></i>
            <input class="in" name="corie" id="corie" type="email" placeholder="Ingrese correo IE" required>
        </div>
        <div class="regi-fi col-md-6">
            <i class="fa-solid fa-map-location-dot"></i>
            <input class="in" name="dirie" id="dirie" type="text" placeholder="Ingrese ubicación" required>
        </div>
        <div class="regi-fi col-md-6">
            <i class="fa-solid fa-lock"></i>
            <input class="in" name="pasie" id="pasie" type="password" placeholder="Ingrese una contraseña" required>
        </div>
        <div class="bunt col-md-3">
            <input class="btn btn-secondary" type="button" value="Regresar">
        </div>
        <div class="bunt col-md-3">
            <input class="btn btn-secondary" type="submit" value="Registrar">
            <input type="hidden" name="ope" value="save">
        </div>
    </div>
</form>
