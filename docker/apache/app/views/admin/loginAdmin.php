<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Document</title>
</head>
<body>
    <main id="loginAdmin">
        <div>
            <form enctype="multipart/form-data" action="../../index.php?Controller=Admin&action=Login" method="POST" class = "formularioAdmin">
                <h1>Admin</h1>
                <label for="adminUser">Usuario</label>
                <input type="text" maxlength="255" name="adminUser" required> 
                <label for="passwordAdmin">Contraseña</label>
                <input type="password" maxlength="255" name="passwordAdmin" required>
                <input type="submit" name="Login" value="Iniciar Sesion" id="logearse">
            </form>
        </div>
    
    </main>
</body>
</html>