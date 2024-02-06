<!DOCTYPE html>
<?php
include('funciones.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_FILES['photo']['tmp_name'])){
        subirFoto($_FILES['photo']['tmp_name']);
        echo "<meta http-equiv='refresh' content ='0; url=subirFoto.php'>";
    }else{
    ?>
        <form action="subirFoto.php" method="post" enctype="multipart/form-data">
            <h2>Introduzca sus datos a continuacion: </h2>
            <table>
                    <td><label class="lbl">Foto: </label></td>
                    <td><input type="file" name="photo" accept="image/*" required></td>
                </tr>       
                </tr>
                    <td><input type="submit" value="Registrarse" class="button"></td>
                    <td><a class="button" href = 'controlAdmin.php'> Atras </a></td>
                </tr>
                    </tr>
                </table>
        </form>
        <?php
    }
    ?>
</body>
</html>