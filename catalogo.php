<?php
session_start();
include '../controlador/conexion_sql.php'; 
include 'header.php';
// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar categorías
$sql = "SELECT * FROM categorias";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styleproductos.css"> 
    <title>Footypoint - Productos</title>
</head>
<body>

<?php
if ($result->num_rows > 0) {
    // Iterar sobre cada categoría
    while ($categoria = $result->fetch_assoc()) {
        echo '<section class="product">';
        echo '<h2 class="product-category">' . $categoria['nombre'] . '</h2>';

        // Consultar productos de la categoría
        $categoria_id = $categoria['id'];
        $sql_productos = "SELECT * FROM productos WHERE categoria_id = $categoria_id";
        $result_productos = $conexion->query($sql_productos);

        // Controles de navegación
        echo '<button class="pre-btn"><img src="../imagenes/flecha.png" alt=""></button>';
        echo '<button class="nxt-btn"><img src="../imagenes/flecha.png" alt=""></button>';
        echo '<div class="product-container">';

        if ($result_productos->num_rows > 0) {
            // Iterar sobre cada producto
            while ($producto = $result_productos->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<div class="product-image">';
                echo '<img src="' . $producto['imagen'] . '" class="product-thumb" alt="">';
                // Modificar el botón para añadir al carrito
                echo '<button class="card-btn" onclick="addToCart(' . $producto['id'] . ')">Añadir al carrito</button>';
                echo '</div>';
                echo '<div class="product-info">';
                echo '<h2 class="product-brand">' . $producto['nombre'] . '</h2>';
                echo '<p class="product-short-description">' . $producto['descripcion'] . '</p>';
                echo '<span class="price">$' . number_format($producto['valor'], 0, ',', '.') . '</span>'; // Formato en pesos
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay productos en esta categoría.</p>';
        }

        echo '</div>'; // product-container
        echo '</section>'; // product
    }
} else {
    echo '<p>No hay categorías disponibles.</p>';
}

$conexion->close();
?>

<script>
function addToCart(productId) {
    <?php if (!isset($_SESSION['usuario_id'])): ?>
        alert('Por favor, inicie sesión para añadir productos al carrito.');
        window.location.href = 'IniciarSesion.php';
    <?php else: ?>
        window.location.href = 'ingresarcantidad.php?id=' + productId;
    <?php endif; ?>
}
</script>

<script src="../js/scriptproductos.js"></script>
<?php
include 'footer.php';
?>
</body>
</html>