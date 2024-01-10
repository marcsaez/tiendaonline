<div class = "container">
    <div class="loginAdmin">
        <h1>ADMIN</h1>
    <form enctype="multipart/form-data" action="../../index.php?Controller=Admin&action=Login" method="POST" class = "formularioAdmin">
        <p>Usuario</p>
        <input type="text" maxlength="255" name="adminUser" class="inputsAdmin" required> 
        <p>Contraseña</p>
        <input type="password" maxlength="255" name="passwordAdmin" class="inputsAdmin" required><br>
        <input type="submit" name="Login" value="Iniciar Sesion" class = "inputsAdmin" id="logearse">
    </form>
    </div>
</div>