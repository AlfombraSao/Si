<?php
include '../headeradminvista.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<style>
 .limited-td {
        max-width: 150px; /* Ajusta el ancho máximo según tus necesidades */
        overflow: hidden; /* Oculta el contenido que excede el ancho */
        text-overflow: ellipsis; /* Muestra "..." para indicar que hay más texto */
        white-space: nowrap; /* Evita que el texto se divida en varias líneas */
    }

    table {
        width: 100%; /* Asegúrate de que la tabla ocupe el ancho completo */
        border-collapse: collapse; /* Elimina el espacio entre celdas */
    }

    td {
        border: 1px solid #ccc; /* Añade un borde para visualizar mejor */
        padding: 5px; /* Espaciado interno */
    }
</style>

<h1 class="text-center text-secondary font-weight-bold p-4">Registro Categorías</h1>

<?php
require "../controlador/conexion_sql.php";
require "../controlador/Registrarcategorias.php";
require "../controlador/EliminarCategorias.php";
$sql = $conexion->query("SELECT * FROM categorias");
?>

<script>
  function EliminarCategorias() {
    return confirm("¿Estás seguro de eliminar la categoría?");
  }
</script>
    
<div class="p-3 table-responsive">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Registrar una categoría
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../controlador/Registrarcategorias.php" method="post">
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la categoría</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <input type="submit" value="Registrar" name="btnregistrar" class="form-control btn btn-success">
      </form>
    </div>
  </div>
</div>

<table class="table table-hover table-striped">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripción</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($datoscategorias = $sql->fetch_object()) { ?>
      <tr>
        <th scope="row"><?php echo $datoscategorias->id ?></th>
        <td><?= $datoscategorias->nombre ?></td>
        <td class="limited-td"><?= $datoscategorias->descripcion ?></td>
        <td>
          <a href="CategoriasRegistro.php?id=<?= $datoscategorias->id ?>&nombre=<?= $datoscategorias->nombre ?>" class="btn btn-danger" onclick="return EliminarCategorias()">Eliminar</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
include 'Footer.php'
?>
</body>
</html>