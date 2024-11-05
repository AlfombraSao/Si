<?php
require "../controlador/conexion_sql.php";

$mensaje = ""; // Inicializa la variable de mensaje

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];
    $stock = $_POST['stock'];
    $categoria_id = $_POST['categoria_id'];

    // Manejo de la imagen
    $imagen = $_FILES['imagen']['name'];
    $ruta_imagen = '../imagenes/' . basename($imagen); // Ruta donde se guardará la imagen

    // Si se ha subido una nueva imagen
    if (!empty($imagen)) {
        // Mueve la imagen a la carpeta 'imagenes'
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
            // Actualiza la base de datos con la nueva imagen
            $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', valor = '$valor', stock = '$stock', categoria_id = '$categoria_id', imagen = '$ruta_imagen' WHERE id = '$id'";
        } else {
            // Manejo de error si la imagen no se pudo mover
            header('Location: ../vista/RegistroProducto.php?error=' . urlencode("Error al subir la imagen."));
            exit;
        }
    } else {
        // Si no se subió una nueva imagen, solo actualiza los demás campos
        $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', valor = '$valor', stock = '$stock', categoria_id = '$categoria_id' WHERE id = '$id'";
    }

    // Ejecuta la consulta
    if ($conexion->query($sql) === TRUE) {
        header('Location: ../vista/RegistroProducto.php?mensaje=Producto actualizado con éxito');
        exit;
    } else {
        header('Location: ../vista/RegistroProducto.php?error=' . urlencode("Error al actualizar el producto: " . $conexion->error));
        exit;
    }
}
?>