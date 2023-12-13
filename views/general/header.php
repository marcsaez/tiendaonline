<script src="../../js/header.js"></script>
<header>
    <div class = 'header'>
        <img src='./img/Logo.png' alt='MangaHouse' id='logo'>
    </div>
    <div id = 'busqueda'>
        <!-- PLACEHOLDER, HAY QUE HACERLO CON AJAX -->
        <input type='text' placeholder='Indique lo que desea buscar...' id ='navegacion'>
    </div>
    <div id = 'navegacion'>
        <ul>
            <li>
                <img src='./img/carrito.png' alt='Carrito' class='imghdr'>
            </li>
            <li>
                <img src='./img/user.png' alt='Usuario' class='imghdr'  onclick="mostrarDesplegable()">
               
            </li>
            <li>
                <img src='./img/desplegable.png' alt='Menu' class='imghdr'  onclick="mostrarMenu()">
            </li>
        </ul>
    </div>
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
    <div id="desplegableMenu" style="display:none;">
        <h4>Aqui va el listado generado automaticamente con un foreach de las categorias de la BDD</h4>
    </div>    
</header>