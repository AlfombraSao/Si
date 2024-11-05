<?php
if (!empty($_POST["btnregistrar"])) {
    // Verificar que todos los campos requeridos estén llenos
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"])) {
        
        $nombre = trim($_POST["nombre"]);
        $descripcion = trim($_POST["descripcion"]);

        include("conexion_sql.php");
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Usar sentencias preparadas para evitar inyección SQL
        $stmt = $conexion->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $descripcion); // 'ss' indica que son dos cadenas

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir a la página con la tabla de categorías
            header("Location: ../vista/CategoriasRegistro.php?success=1");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al registrar: " . $stmt->error . "</div>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "<div class='alert alert-warning'>Por favor, complete todos los campos requeridos.</div>";
    }
}
?>