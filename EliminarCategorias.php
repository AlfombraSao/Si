<?php 

if (!empty($_GET["id"]) && !empty($_GET["nombre"])) {
    $id = $_GET["id"];
    $nombre = $_GET["nombre"];

    // Suponiendo que $conexion es tu conexión a la base de datos
    $conexion->begin_transaction(); // Iniciar transacción

    try {
        // Ahora eliminar el producto de la tabla categorias
        $eliminar = $conexion->prepare("DELETE FROM categorias WHERE id = ?");
        $eliminar->bind_param("i", $id); // Cambiado a "i" para entero
        $eliminar->execute();

        // Verificar si se eliminó correctamente
        if ($eliminar->affected_rows == 1) {
            echo "<div class='alert alert-success'>El producto se eliminó correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar el producto. Puede que no exista.</div>";
        }

        $conexion->commit(); // Confirmar transacción
    } catch (\Throwable $th) {
        $conexion->rollback(); // Revertir transacción en caso de error
        echo "<div class='alert alert-danger'>Error: " . $th->getMessage() . "</div>";
        // Aquí podrías registrar el error en un archivo de log
    }
?>

<script>
    history.replaceState(null, null, location.pathname);
</script>

<?php
}
?>