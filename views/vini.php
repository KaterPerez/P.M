<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 border border-black rounded-4 p-4 shadow">
            <form action="models/validacion.php" method="POST">
                <h1 class="text-center mb-4 tbl">Iniciar Sesión</h1>
                <!-- Espaciado más amplio -->
                <div class="input-group mb-3 px-5">
                    <div class="ini w-100 mb-3">
                        <i class="fa-solid fa-envelope me-2"></i>
                        <input class="form-control inl" name="usu" type="text" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="ini w-100 mb-3">
                        <i class="fa-solid fa-lock me-2"></i>
                        <input class="form-control inl" name="con" type="password" placeholder="Contraseña" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between px-5">
                        <button class="btn btn-secondary custom-btn-size me-2" type="submit">Ingreso</button>
                        <a href="index.php?pg=205" class="btn btn-secondary custom-btn-size ms-2 text-center">Olvidó su contraseña</a>
                </div>

                <!-- Mensaje de error -->
                <?php 
                $error = isset($_GET['error']) ? $_GET['error'] : NULL; 
                if ($error == "ok") { 
                    echo "<div class='alert alert-danger mt-3'>Datos inválidos. Vuelve a intentarlo.</div>"; 
                }
                ?>
            </form>
        </div>
    </div>
</div>
