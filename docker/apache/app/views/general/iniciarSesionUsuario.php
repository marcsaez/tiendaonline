<form action="index.php?Controller=Usuario&action=iniciarSesionUsuario" method="post" name="iniciar-sesion">
    <label for="correoUsuario">Correo</label>
    <input type="text" name="correoUsuario" id="correoUsuario" required>
    <label for="passUsuario">Contraseña</label>
    <input type="password" name="passUsuario" id="passUsuario" required>
    <input type="submit" value="Iniciar Sesion">
</form>
<?php
if(isset($_SESSION['loginMal'])){
   // echo"<p>Correo o contraseña incorrectos, porfavor intentalo de nuevo</p>";
}
?>