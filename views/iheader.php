<div class="container">
    <nav class="navbar navbar-expand-lg">
        <img src="img/PM-removebg-preview.jpg" width="250px" height="100px">
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" id="ingmod" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?pg=1896">Precio</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#loginModal">
            Iniciar sesión
        </button>
    </nav> 
</div>  

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title w-100 text-center" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="models/validacion.php" method="POST">
                    <div class="mb-3">
                        <label for="usu" class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" class="form-control" name="usu" id="usu" placeholder="Correo Electrónico" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="con" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" name="con" id="con" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-dark w-100">Ingresar</button>
                        </div>
                        <div class="col-6">
                            <a href="index.php?pg=205" class="btn btn-outline-dark w-100 text-center">Olvidó su contraseña</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .btn-close-white {
        background-color: transparent;
        box-shadow: none;
    }
    .modal .btn-close-white:hover {
        background-color: white !important; 
        color: black !important; 
        border: 1px solid black; 
    }
</style>
