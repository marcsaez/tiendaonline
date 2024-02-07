<script src="./js/header.js"></script>
<?php 
    if (!isset($_SESSION['userType'])){
?>
<div class="popup-container" id="popup-container">
    <main class="popup">
        <section id="iniciar-sesion">
            <h1>Inicia Sesion</h1>
            <span>Accede con una cuenta ya existente.</span>
            <?php include "views/general/iniciarSesionUsuario.php"; ?>
        </section>
        <span class="separator"></span>
        <section id="registrarse">
            <h1>Aún no te has registrado?</h1>
            <span>Registrate para disfrutar las ventajas de ser miembro de Manga House!</span>
            <?php include "views/general/registrarUsuario.php"; ?>
        </section>
    </main>
</div>
        
<?php } ?>

<header id="header">
    <section>
        <div id="header-logo">
            <a href="index.php"><img src='./img/Logo.png' alt='MangaHouse' id='logo'></a>
            <p>
                <span>manga</span>
                <span>house</span>
            </p>
            
        </div>
        <div id="header-user">
            <div id="buscadorAJAX">
                <script src="js/buscadorPrincipal.js"></script>
                <form action="index.php?Controller=Productos&action=buscarPrincipal" method="post" name="busqueda">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Buscar...">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#cacaca">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </form>
                <div id="resultadosDiv"></div>
            </div>

            <ul>
                <li title="Carrito">
                    <!-- icono carrito -->
                    <a href="index.php?Controller=Carrito&action=abrirCarrito">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </a>

                </li>
                <li title="Iniciar Sesion">
                    <!-- icono usuario -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="user-btn">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <?php 
                        if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'usuario'){
                            echo '
                                <ul class="opciones-usuario" id="desplegable-usuario">
                                    <li>'.$_SESSION['userMail'].'</li>
                                    <li><a href="index.php?Controller=Usuario&action=mostrarPerfil">Mis Pedidos</a></li>
                                    <li><a href="index.php?Controller=Usuario&action=logOutUsuario">Cerrar Sesión</a></li>
                                </ul>
                            ';
                        }
                    ?>

                </li>
            </ul>
        </div>
    </section>
    <section>
        <nav id="nav-inferior">
            <ul>
                <li><a href="#">NOVEDADES</a></li>
                <?php
                    foreach($totalCategorias as $categoria){
                        $categoriaNameUpperCase = strtoupper($categoria['categoryname']);
                        echo "<li><a href='index.php?Controller=Categorias&action=filtrar&categoria=".$categoria['categoryid']."&nombre=".$categoria['categoryname']."'>".$categoriaNameUpperCase."</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </section>
</header>