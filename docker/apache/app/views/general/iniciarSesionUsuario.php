<form action="index.php?Controller=Usuario&action=iniciarSesionUsuario" method="post" name="iniciar-sesion">
    <label for="correoUsuario">Correo</label>
    <input type="text" name="correoUsuario" id="correoUsuario" required>
    <label for="passUsuario">Contraseña</label>
    <input type="password" name="passUsuario" id="passUsuario" required>
    <?php
    if(isset($_SESSION['loginError'])){ 
        echo "<span>".$_SESSION['loginError']."</span>";
    }?>
    <input type="submit" value="Iniciar Sesion">
</form>