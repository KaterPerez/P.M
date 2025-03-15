<div class="row border border-black inier row border border-black">
    <form action="models/validacion.php" method="POST">
        <h1 class="tbl">Iniciar Sesión</h1>
        <div class="input-group">
            <div class="ini">
                <i class="fa-solid fa-envelope"></i>
                <input class="inl" name="usu" type="text" placeholder="Correo Electrónico" required>
            </div>
            <div class="ini">
                <i class="fa-solid fa-lock"></i>
                <input class="inl" name="con" type="password" placeholder="Contraseña" required>
            </div>
            <div class="d-flex justify-content-between">
                <button id="btn-abm" class="btn btn-secondary me-2" type="submit">Ingreso</button>
                <a href="index.php?pg=205">
                    <button id="btn-abm" class="btn btn-secondary ms-2" type="button">Olvido su contraseña</button>
                </a>
            </div> 
        </div>
        <?php 
            $error = isset($_GET['error']) ? $_GET['error'] : NULL; 
            if ($error == "ok") { 
                echo "<div class='alert alert-danger'>Datos inválidos. Vuelve a intentarlo.</div>"; 
            }
        ?>
    </form>
</div>


