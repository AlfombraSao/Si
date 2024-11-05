<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../controlador/registrousuarios.php");
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../css/styleIniciarSesion.css">
</head>
<body>
    
    <form action="Registrarse.php" method="POST">
    <h1>Registrarse</h1>
    <hr>
        <i class="fa-solid fa-user"></i>
        <label>Nombre</label>
        <input type="text" name="nombreusuario" placeholder="Nombre">

        <i class="fa-solid fa-user"></i>
        <label>Correo Electrónico</label>
        <input type="text" name="emailusuario" placeholder="Email">
    

        <i class="fa-solid fa-unclock"></i>
        <label>Contraseña</label>
        <input type="text" name="claveusuario" placeholder="Clave">
    <hr>
    
        <div class="botones">
        <button type="submit" class="iniciar-sesion" href="../index.php">Registrarse</button>
        <h5>¿Ya tienes una cuenta?</h5>
        <button type="button" onclick="window.location.href='IniciarSesion.php'" class="crear-cuenta">Iniciar Sesion</button>
        <button type="button" onclick="window.location.href='../index.php'" class="regresar">Regresar</button>
    </div>

    </form>

    

</body>
</html>