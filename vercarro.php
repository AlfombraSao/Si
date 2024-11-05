<?php
session_start();

if (isset($_SESSION['carro']) && count($_SESSION['carro']) > 0) {
    echo "<h2>Tu Carrito de Compras</h2>";
    foreach ($_SESSION['carro'] as $item) {
        echo "productos: {$item['NombreProductos']} - Precio: {$item['Precio']} - Cantidad: {$item['Cantidad']}<br>";
    }
} else {
    echo "El carrito está vacío.";
}
?>
