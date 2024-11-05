<?php
include '../headeradminvista.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>

<style>
    table {
        width: 100%; /* Asegúrate de que la tabla ocupe el ancho completo */
        border-collapse: collapse; /* Elimina el espacio entre celdas */
    }

    td {
        border: 1px solid #ccc; /* Añade un borde para visualizar mejor */
        padding: 5px; /* Espaciado interno */
    }
</style>

<h1 class="text-center text-secondary font-weight-bold p-4">Historial de Compras</h1>

<?php
require "../controlador/conexion_sql.php";

// Consulta para obtener las compras
$sql = $conexion->query("SELECT * FROM compras");
?>

<table class="table table-hover table-striped">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Usuario ID</th>
      <th scope="col">Total</th>
      <th scope="col">Fecha</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($datos = $sql->fetch_object()) { ?>
    <tr>
      <th scope="row"><?php echo $datos->id; ?></th>
      <td><?php echo $datos->usuario_id; ?></td>
      <td><?php echo $datos->total; ?></td>
      <td><?php echo $datos->fecha; ?></td>
      
    </tr>
    <?php } ?>
  </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
include 'Footer.php';
?>