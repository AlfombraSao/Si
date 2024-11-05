<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../controlador/registroadmin.php");
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar administradores</title>
    <link rel="stylesheet" href="../css/styleIniciarSesion.css">
</head>
<body>
    
    <form action="Registrarseadmin.php" method="POST">
    <h2>Registrarse Administrador</h2>
    <hr>
        <i class="fa-solid fa-user"></i>
        <label>Nombre</label>
        <input type="text" name="nombreadmin" placeholder="Nombre">

        <i class="fa-solid fa-user"></i>
        <label>Correo Electrónico</label>
        <input type="text" name="emailadmin" placeholder="Email">
    

        <i class="fa-solid fa-unclock"></i>
        <label>Contraseña</label>
        <input type="text" name="claveadmin" placeholder="Clave">
    <hr>
    
    <div class="botones">
        <button type="submit" class="iniciar-sesion" href="../indexadmin.php">Registrarse</button>
        <button type="button" onclick="window.location.href='../indexadmin.php'" class="regresar2">Regresar</button>


    </form>

    

</body>
</html>