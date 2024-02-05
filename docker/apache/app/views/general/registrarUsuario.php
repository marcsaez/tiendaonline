<form action="index.php?Controller=Usuario&action=registrarUsuario" method="post" name="registrarse">
    <div>
        <label for="usuarioNombre">Nombre</label>
    </div>
    <div>
        <label for="usuarioApellido">Apellido</label>
    </div>
    <div>
        <input type="text" name="usuarioNombre" id="usarioNombre" required>
    </div>
    <div>
        <input type="text" name="usuarioApellido" id="usuarioApellido" required>
    </div>
    <div>
        <label for="usuarioTelefono">Telefono</label>
    </div>
    <div>
        <input type="tel" name="usuarioTelefono" id="usuarioTelefono" required>
    </div>
    <div>
        <label for="usuarioDireccion">Dirección</label>
    </div>
    <div>
        <input type="text" name="usuarioDireccion" id="usuarioDireccion" required>
    </div>
    <div>
        <label for="usuarioEmail">Correo</label>
    </div>
    <div>
        <input type="text" name="usuarioEmail" id="usuarioEmail" required>
    </div>
    <div>
        <label for="usuarioPassword">Contraseña</label>
    </div>
    <div>
        <label for="usuarioPasswordRepeat">Repetir Contraseña</label>
    </div>
    <div>
        <input type="password" name="usuarioPassword" id="usuarioPassword" required>
    </div>
    <div>
        <input type="password" name="usuarioPasswordRepeat" id="usuarioPasswordRepeat" required>
    </div>
    <div>
        <input type="submit" value="Registrarse">
    </div>
</form>
