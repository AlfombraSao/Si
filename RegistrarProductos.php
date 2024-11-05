<?php
if (!empty($_POST["btnregistrar"])) {
    // Verificar que todos los campos requeridos estén llenos
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["valor"]) && !empty($_POST["stock"]) && !empty($_POST["categoria_id"]) && !empty($_FILES["imagen"]["tmp_name"])) {
        
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $valor = $_POST["valor"];
        $categoria_id = $_POST["categoria_id"];
        $stock= $_POST["stock"];

        include("conexion_sql.php");
        
        // Consulta para insertar el producto
        $Consulta = "INSERT INTO productos (nombre, descripcion, valor, stock, categoria_id) VALUES ('$nombre', '$descripcion', '$valor', '$stock', '$categoria_id')";
        
        $Resultado = mysqli_query($conexion, $Consulta);
        
        // Verificar si la consulta se ejecutó correctamente
        if ($Resultado) {
            $idRegistro = mysqli_insert_id($conexion); // Obtener el ID generado

            $imagen = $_FILES["imagen"]["tmp_name"];
            $nombreImagen = $_FILES["imagen"]["name"];
            $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
            $sizeImagen = $_FILES["imagen"]["size"];
            $directorio = "../imagenes/";

            // Verificar el tipo de imagen
            if ($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png") {
                $ruta = $directorio . $idRegistro . "." . $tipoImagen;
                $actualizarImagen = $conexion->query("UPDATE productos SET imagen='$ruta' WHERE id=$idRegistro");

                // Mover la imagen al directorio
                if (move_uploaded_file($imagen, $ruta)) {
                    echo "<div class='alert alert-info'>Registrado con éxito</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error al mover la imagen</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>No se acepta ese formato de imagen</div>";
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    } else {
        echo "<div class='alert alert-danger'>Por favor, completa todos los campos y selecciona una imagen.</div>";
    } ?>


<script>
    history.replaceState(null,null,location.pathname);
</script>

<?php }
?>

