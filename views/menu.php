<!-- <div class="vi">
        <!- <a  href="home.php?pg=45"><i class="gi fa-solid fa-cubes-stacked" title="Grupos"></i></a>
        <a  href="home.php?pg=57"><i class="gi fa-solid fa-cubes-stacked" title="Grupos"></i></a> ->
        <a  href="home.php?pg=42"><i class="gr fa-solid fa-users-gear" title="Grupo Estudiante"></i></a>
        <a  href="home.php?pg=456"><i class="gi fa-solid fa-file" title="Pagina por perfil"></i></a>
</div> -->
<?php include "Controllers/cmenu.php";?> 
<nav class="nilba border border-black ">
    <ul class="nav-links">
    <li>  <?php if($dtAll){foreach ($dtAll AS $dt){ ?>
                <a  href="home.php?pg=<?=$dt['codpag'];?>" title="<?=$dt['nompag'];?>">
                        <i class="<?=$dt['icopag'];?>"></i>
                </a>
        <?php }} ?></li>
        <li><a href="#" onclick="confirmarCierreSesion()"><i class="gi fa-solid fa-reply" title="Salir"></i></a></li>
    </ul>

    <div class="menu-toggle" id="mobile-menu">
            <i class=" bar fa-solid fa-bars"></i>
    </div>
</nav>

<script>
    document.getElementById("mobile-menu").addEventListener("click", function() {
        document.querySelector(".nav-links").classList.toggle("active");
    });

    function confirmarCierreSesion() {
        if (confirm("¿Está seguro de que desea cerrar esta sesión?")) {
            window.location.href = 'index.php?';
        }
    }
</script>