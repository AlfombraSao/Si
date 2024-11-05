<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ya ha iniciado sesión
if (isset($_SESSION['administradores'])) {
    // El usuario ya ha iniciado sesión, redirigir a la página principal
    echo '<script>alert("Ya has iniciado sesión como ' . $_SESSION['administradores'] . '");</script>';
    echo '<script>window.location = "../indexadmin.php";</script>';
    exit; // Detiene la ejecución del script
}

// Verifica si se han enviado los datos del formulario
if (!empty($_POST["nombreadmin"]) && !empty($_POST["claveadmin"]) && !empty($_POST["emailadmin"])) {
    
    $nombreadmin = $_POST["nombreadmin"];
    $claveadmin = $_POST["claveadmin"];
    $emailadmin = $_POST["emailadmin"];

    include("../controlador/conexion_sql.php");
    $query = "INSERT INTO administradores (nombreadmin, claveadmin, emailadmin) VALUES ('".$nombreadmin."','".$claveadmin."', '".$emailadmin."')";

    echo $query;
    $resultado = false;

    try {
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            echo '<script>alert("Registro exitoso.");</script>';
            // Aquí puedes redirigir a otra página si es necesario
            echo '<script>window.location = "../indexadmin.php";</script>';
        } else {
            echo '<script>alert("Error al registrar el usuario como administrador.");</script>';
        }
    } catch (Exception $e) {
        $Mensaje = "No se pudo registrar el usuario como administrador por error en los datos";
        echo '<script>alert("' . $Mensaje . '");</script>';
    }
}
?>