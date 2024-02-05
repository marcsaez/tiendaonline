<div>
    <form action="index.php?controller=Usuario&action=registrarUsuario" method="post">
        <label for="usuarioEmail">Correo: *</label>
        <input type="text" name="usuarioEmail" id="usuarioEmail" required>
        <label for="usuarioTelefono">Telefono: *</label>
        <input type="tel" name="usuarioTelefono" id="usuarioTelefono" required>
        <label for="usuarioNombre">Nombre: *</label>
        <input type="text" name="usuarioNombre" id="usarioNombre" required>
        <label for="usuarioApellido">Apellido: *</label>
        <input type="text" name="usuarioApellido" id="usuarioApellido" required>
        <label for="usuarioDireccion">Dirección: *</label>
        <input type="text" name="usuarioDireccion" id="usuarioDireccion" required>
        <label for="usuarioPassword">Contraseña: *</label>
        <input type="password" name="usuarioPassword" id="usuarioPassword" required>
        <input type="submit" value="Registrarse">
    </form>
</div>