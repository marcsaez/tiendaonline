<div>
    <form action="index.php?Controller=Usuario&action=iniciarSesionUsuario" method="post">
    <label for="correoUsuario">Correo: </label>
    <input type="text" name="correoUsuario" id="correoUsuario">
    <label for="passUsuario">Contraseña: </label>
    <input type="password" name="passUsuario" id="passUsuario">
    <input type="submit" value="Iniciar Sesion">
    </form>
    <?php
    if(isset($_SESSION['loginMal'])){
        echo"<p>Correo o contraseña incorrectos, porfavor intentalo de nuevo</p>";
    }
    ?>
</div>