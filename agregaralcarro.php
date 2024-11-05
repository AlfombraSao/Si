<?php
session_start();
require 'conexion_sql.php';

if (isset($_POST['IDProductos'], $_POST['Cantidad'])) {
    $IDProductos = intval($_POST['IDProductos']);
    $Cantidad = intval($_POST['Cantidad']);

    // Consulta para obtener el producto
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE IDProductos = ?");
    $stmt->execute([$IDProductos]);
    $productos = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($idproductos) {
        $item = [
            'usuarios' => $IDProductos['IDProductos'],
            'NombreProductos' => $IDProductos['NombreProductos'],
            'Precio' => $IDProductos['Precio'],
            'Cantidad' => $Cantidad
        ];

        // Añadir al carrito
        $_SESSION['carro'][] = $item;
        echo "Producto agregado al carrito.";
    } else {
        echo "Producto no encontrado.";
    }
}
?>
