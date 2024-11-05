<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start(); // Inicia la sesión
    // Verifica si el usuario ya ha iniciado sesión
    if (isset($_SESSION['usuario'])) {
        // Redirigir a la página principal si ya ha iniciado sesión
        header("Location: IniciarSesion.php");
        exit;
    }

    // Verifica si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtiene los datos del formulario
        $correo = $_POST["emailusuario"];
        $clave = $_POST["claveusuario"];

        // Aquí deberías agregar la lógica para verificar las credenciales del usuario
        include("../controlador/conexion_sql.php");
        $query = "SELECT * FROM usuarios WHERE emailusuario = '$correo' AND claveusuario = '$clave'";
        $resultado = mysqli_query($conexion, $query);
        $usuario = mysqli_fetch_assoc($resultado);

        if (mysqli_num_rows($resultado) > 0) {
            // Si las credenciales son correctas, inicia sesión
            $_SESSION['usuario'] = $correo; // O el nombre de usuario que desees
            $_SESSION['usuario_id'] = $usuario['usuarios']; // O el nombre de usuario que desees
            echo '<script>alert("Inicio de sesión exitoso.");</script>';
            echo '<script>window.location = "../index.php";</script>'; // Redirige a la página principal
        } else {
            echo '<script>alert("Credenciales incorrectas. Inténtalo de nuevo.");</script>';
        }
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../css/styleIniciarSesion.css">
</head>
<body>
    <form action="" method="POST"> <!-- Cambié la acción a "" para que se envíe al mismo archivo -->
        <h1>Iniciar Sesión</h1>
        <hr>

        <i class="fa-solid fa-unclock"></i>
        <label>Correo Electrónico</label>
        <input type="email" name="emailusuario" placeholder="Email" required>

        <i class="fa-solid fa-unclock"></i>
        <label>Contraseña</label>
        <input type="password" name="claveusuario" placeholder="Clave" required>
        <hr>
    <div class="botones">
        <button type="submit" class="iniciar-sesion">Iniciar Sesión</button>
        <h5>¿No tienes una cuenta?</h5>
        <button type="button" onclick="window.location.href='Registrarse.php'" class="crear-cuenta">Crear cuenta</button>
        <button type="button" onclick="window.location.href='../index.php'" class="regresar">Regresar</button>
    </div>
    </form>
</body>
</html>