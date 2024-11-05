<?php
session_start();
include 'header.php';
include '../controlador/conexion_sql.php';

// Establecer la zona horaria
date_default_timezone_set('America/Bogota');


// Verifica si el carrito está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo 'Tu carrito está vacío.';
    exit();    
}





// Calcular el total del carrito
$totalCompra = 0;
foreach ($_SESSION['carrito'] as $item) {
    $totalCompra += $item['total'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proceder_pago'])) {
    $totalCompra = number_format($totalCompra, 2, '.', '');
    $estado = 1;
    $fecha = date('Y-m-d H:i:s');
    $usuario = $_SESSION['usuario_id']; // Ahora seguro de que está definido

    $query = "INSERT INTO compras (usuario_id, total, fecha, estado) VALUES ($usuario, $totalCompra, '$fecha', $estado)";
    if ($conexion->query($query) === TRUE) {
        $compra_id = $conexion->insert_id;

        foreach ($_SESSION['carrito'] as $item) {
            if (!isset($item['id'])) {
                echo "<script>alert('El carrito contiene un producto sin ID.');</script>";
                exit();
            }

            $producto_id = $item['id'];
            $cantidad = $item['cantidad'];

            $queryDetalle = "INSERT INTO detalle_compras (compra_id, producto_id, cantidad) VALUES ($compra_id, $producto_id, $cantidad)";
            $conexion->query($queryDetalle);

            $nuevoStock = $item['stock'] - $cantidad;
            $queryStock = "UPDATE productos SET stock = $nuevoStock WHERE id = $producto_id";
            $conexion->query($queryStock);
        }

        unset($_SESSION['carrito']);
        echo '<script>alert("¡Compra realizada exitosamente! Sigue comprando.");</script>';
        echo '<script>window.location = "../index.php";</script>';
        exit();
    } else {
        echo "<script>alert('Error en la inserción directa: " . $conexion->error . "');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $IDProductos = $_POST['IDProductos'];

        if ($_POST['action'] === 'update') {
            $nuevaCantidad = intval($_POST['cantidad']);
            if ($nuevaCantidad > 0 && $nuevaCantidad <= $_SESSION['carrito'][$IDProductos]['stock']) {
                $_SESSION['carrito'][$IDProductos]['cantidad'] = $nuevaCantidad;
                $_SESSION['carrito'][$IDProductos]['total'] = $nuevaCantidad * $_SESSION['carrito'][$IDProductos]['valor'];
            } else {
                echo "<script>alert('La cantidad ingresada excede el stock disponible.');</script>";
            }
        } elseif ($_POST['action'] === 'remove') {
            unset($_SESSION['carrito'][$IDProductos]);
        }

        $totalCompra = 0;
        foreach ($_SESSION['carrito'] as $item) {
            $totalCompra += $item['total'];
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Compra</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            margin-bottom: 16px;
        }
        h2 {
            margin: 16px 0px;
        }
        .resumen_carrito {
            margin: 0px 16px 16px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../css/styleproductos.css"> 
</head>
<body>
  <div class="resumen_carrito">
    <h1>Resumen de tu Compra</h1>
    <table>
        <tr>
            <th>Producto</th>
            <th>Imagen</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($_SESSION['carrito'] as $IDProductos => $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                <td><img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" style="max-width: 50px;"></td>
                <td>$ <?php echo number_format($item['valor'], 2); ?></td>
                <td>
                    <form method="POST" style="display:inline;" name="update_products">
                        <input type="hidden" name="IDProductos" value="<?php echo $IDProductos; ?>">
                        <input type="number" name="cantidad" value="<?php echo $item['cantidad']; ?>" min="1" max="<?php echo $item['stock']; ?>" style="width: 60px;">
                        <input type="hidden" name="action" value="update">
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
                <td>$ <?php echo number_format($item['total'], 2); ?></td>
                <td>
                    <form method="POST" style="display:inline;" name="delete_products">
                        <input type="hidden" name="IDProductos" value="<?php echo $IDProductos; ?>">
                        <input type="hidden" name="action" value="remove">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Total a Pagar: $ <?php echo number_format($totalCompra, 2); ?></h2>

    <!-- Formulario para proceder al pago -->
    <form method="POST" action="">
        <input type="hidden" name="proceder_pago" value="1">
        <button type="submit">Proceder al Pago</button>
    </form>

    <form method="POST" action="catalogo.php">
        <button type="submit">Continuar comprando</button>
    </form>
  </div>
</body>
<?php
  include 'footer.php';
?>
</html>