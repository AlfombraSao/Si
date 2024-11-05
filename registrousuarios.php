<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // El usuario ya ha iniciado sesión, redirigir a la página principal
    echo '<script>alert("Ya has iniciado sesión como ' . $_SESSION['usuario'] . '");</script>';
    echo '<script>window.location = "../index.php";</script>';
    exit; // Detiene la ejecución del script
}

// Verifica si se han enviado los datos del formulario
if (!empty($_POST["nombreusuario"]) && !empty($_POST["claveusuario"]) && !empty($_POST["emailusuario"])) {
    
    $nombreusuario = $_POST["nombreusuario"];
    $claveusuario = $_POST["claveusuario"];
    $emailusuario = $_POST["emailusuario"];

    include("../controlador/conexion_sql.php");
    $query = "INSERT INTO usuarios (nombreusuario, claveusuario, emailusuario) VALUES ('".$nombreusuario."','".$claveusuario."', '".$emailusuario."')";

    echo $query;
    $resultado = false;

    try {
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            echo '<script>alert("Registro exitoso.");</script>';
            // Aquí puedes redirigir a otra página si es necesario
            echo '<script>window.location = "../index.php";</script>';
        } else {
            echo '<script>alert("Error al registrar el usuario.");</script>';
        }
    } catch (Exception $e) {
        $Mensaje = "No se pudo registrar el usuario por error en los datos";
        echo '<script>alert("' . $Mensaje . '");</script>';
    }
}
?>