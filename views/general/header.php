<script src="../../js/header.js"></script>

<header>
    <section>
        <div>
            <img src='./img/Logo.png' alt='MangaHouse' id='logo'>
            <p>
                <span>manga</span>
                <span>house</span>
            </p>
        </div>
        <div>
            <!-- PLACEHOLDER, HAY QUE HACERLO CON AJAX -->
            <!-- <div id = 'busqueda'>
                <input type='text' placeholder='Indique lo que desea buscar...' id ='navegacion'>
            </div> -->
            <!-- BUSCADOR AJAX (SOLO CAMBIAR ID'S Y LLAMADA A FUNCION) -->
        <div id="buscadorAJAX">
        <script src="js/buscadorPrincipal.js"></script>
            <form action="index.php?Controller=Productos&action=buscar" method="post" name="busqueda">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar...">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#cacaca">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </form>
        </div>
        <div id="resultadosDiv"></div>

            <ul>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                </li>
                <!-- <li>
                    <img src='./img/user.png' alt='Usuario' class='imghdr'  onclick="mostrarDesplegable()">
                
                </li> -->
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                </li>
            </ul>
            
            <div id="desplegable" style="display:none;">
                <form action="">
                    <label for="user">Usuario: </label>
                    <input type="text" name="User" id="User">
                    <label for="pass">Contraseña: </label>
                    <input type="password" name="Pass" id="Pass">
                </form>
                <a href="#">Ha olvidado su contraseña?</a>
                <a href="#">No tiene cuena aun? Registrese aqui </a>
            </div>
        </div>
    </section>
    <section>
        <nav>
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