<?php
// Establecer la zona horaria a Colombia/Bogotá
date_default_timezone_set('America/Bogota');

// Conexión a la base de datos
$servername = "localhost";
$username = "usuarios";
$password = "claveusuario";
$dbname = "2024_footypoint";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar la compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $idproductos = $_POST['idproductos'];
    $cantidad = $_POST['cantidad'];
    
    // Obtener el precio del producto
    $sql_producto = "SELECT Precio FROM productos WHERE IDProductos = $idproductos";
    $resultado_producto = $conn->query($sql_producto);
    
    if ($resultado_producto->num_rows > 0) {
        $producto = $resultado_producto->fetch_assoc();
        $precio = $producto['Precio'];
        $total = $precio * $cantidad;
        $fecha = date('Y-m-d H:i:s'); // Fecha actual
        
        // Inserción directa en la tabla compras
        $sql = "INSERT INTO compras (usuario_id, total, fecha) VALUES ($id, $total, '$fecha')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Compra realizada exitosamente.";
        } else {
            echo "Error en la inserción directa: " . $conn->error;
        }
    } else {
        echo "Producto no encontrado.";
    }
}
?>