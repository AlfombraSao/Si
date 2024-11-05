<?php
session_start();
include '../controlador/conexion_sql.php'; // Incluye la conexión a la base de datos
include 'header.php';

// Obtener el ID del producto de la URL
$idProducto = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Realizar una consulta para obtener la información del producto
$sql = "SELECT * FROM productos WHERE id = $idProducto";
$result = $conexion->query($sql);

// Verificar si se obtuvo un resultado
if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Producto no encontrado.";
    exit();
}

// Lógica para agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cantidad = intval($_POST['cantidad']);
    
    // Crear objeto carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Calcular la cantidad total deseada
    $cantidadActual = isset($_SESSION['carrito'][$idProducto]) ? $_SESSION['carrito'][$idProducto]['cantidad'] : 0;
    $cantidadTotal = $cantidadActual + $cantidad;

    // Verificar que la cantidad total no exceda el stock disponible
    if ($cantidadTotal > $product['stock']) {
        echo "<script>alert('La cantidad ingresada excede el stock disponible.');</script>";
    } else {
        // Verificar si el producto ya está en el carrito
        if (isset($_SESSION['carrito'][$idProducto])) {
            // Actualizar la cantidad
            $_SESSION['carrito'][$idProducto]['cantidad'] += $cantidad;
            $_SESSION['carrito'][$idProducto]['total'] = $_SESSION['carrito'][$idProducto]['cantidad'] * $product['valor'];
        } else {
            // Agregar nuevo producto al carrito
            $_SESSION['carrito'][$idProducto] = [
                'id' => $product['id'],
                'nombre' => $product['nombre'],
                'valor' => $product['valor'],
                'stock' => $product['stock'],
                'cantidad' => $cantidad,
                'total' => $cantidad * $product['valor'],
                'imagen' => $product['imagen']
            ];
        }

        // Redireccionar a la página del carrito
        header('Location: carrito.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Cantidad</title>
    <style>
        .cantidad_resumen {
          margin: 0px 16px 16px;
        }
    </style>
</head>
<body>
    <div class="cantidad_resumen">
        <h1><?php echo htmlspecialchars($product['nombre']); ?></h1>
        <img src="<?php echo htmlspecialchars($product['imagen']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>" style="max-width: 300px;">
        <p>Descripción: <?php echo htmlspecialchars($product['descripcion']); ?></p>
        <p>Precio: <?php echo number_format($product['valor'], 2); ?> $</p>
        <p>Stock disponible: <?php echo $product['stock'] - (isset($_SESSION['carrito'][$product['id']]) ? $_SESSION['carrito'][$product['id']]['cantidad'] : 0); ?></p>


        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <label for="Cantidad">Cantidad:</label>
            <input type="number" name="cantidad" value="1" min="1" max="<?php echo $product['stock'] - (isset($_SESSION['carrito'][$product['id']]) ? $_SESSION['carrito'][$product['id']]['cantidad'] : 0); ?>">
            <button type="submit">Agregar al Carro</button>
        </form>

        <a href="catalogo.php">Volver al Catálogo</a>
    </div>
    
<?php
  include 'footer.php';
?>
</body>
</html>
