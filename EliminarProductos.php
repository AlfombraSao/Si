<?php 

if (!empty($_GET["id"]) && !empty($_GET["nombre"])) {
    $id = $_GET["id"];
    $nombre = $_GET["nombre"];

    // Suponiendo que $conexion es tu conexión a la base de datos
    $conexion->begin_transaction(); // Iniciar transacción

    try {
        // Eliminar registros dependientes de detalle_compras
        $stmt = $conexion->prepare("DELETE FROM detalle_compras WHERE producto_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Ahora eliminar el producto de la tabla productos
        $eliminar = $conexion->prepare("DELETE FROM productos WHERE id = ?");
        $eliminar->bind_param("i", $id);
        $eliminar->execute();

        // Verificar si se eliminó correctamente
        if ($eliminar->affected_rows == 1) {
            echo "<div class='alert alert-success'>El producto se eliminó correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar el producto.</div>";
        }

        $conexion->commit(); // Confirmar transacción
    } catch (\Throwable $th) {
        $conexion->rollback(); // Revertir transacción en caso de error
        echo "<div class='alert alert-danger'>Error: " . $th->getMessage() . "</div>";
    }
?>

<script>
    history.replaceState(null, null, location.pathname);
</script>

<?php
}
?>