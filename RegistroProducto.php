<?php
include '../controlador/ComboCategorias.php';
include '../headeradminvista.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro productos</title>
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

<h1 class="text-center text-secondary font-wight-bold p-4">Registro Productos</h1>

<?php

require "../controlador/conexion_sql.php";
require "../controlador/RegistrarProductos.php";
require "../controlador/eliminarproductos.php";
$sql=$conexion->query("select * from productos");

?>

<script>
  function eliminarproductos(params) {
    let res=confirm("¿Estas seguro de eliminar este producto?") ;
    return res;
  }
</script>
    
<div class="p-3 table-responsive">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Registrar un producto
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" enctype="multipart/form-data" method="POST">
          <input type="file" class="form-control mb-2" name="imagen">
          <div class="mb-3">
    <label for="nombre" class="form-label">Nombre del productos</label>
    <input type="text" class="form-control" id="nombre" Name="nombre">
  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea type="text" class="form-control" id="descripcion" Name="descripcion"></textarea>
  </div>
  <div class="mb-3">
    <label for="valor" class="form-label">Valor</label>
    <input type="number" class="form-control" id="valor" Name="valor" min="100">
  </div>
  <div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" class="form-control" id="stock" Name="stock" min="1">
  </div>
  <div class="mb-3">
    <label for="categoria_id" class="form-label">Categoria_id</label>
    <select name="categoria_id" id="categoria_id"> 
    <?php
    foreach ($categorias as $categoria_id) {
        echo "<option value='" . $categoria_id . "'>" . $categoria_id . "</option>"; // Usamos el mismo valor para el option
    }
    ?>
    </select>
  </div>
          <input type="submit" value="Registrar" name="btnregistrar" class="form-control btn btn-success">
        </form>
      </div>
    </div>
  </div>
</div>

<table class="table table-hover table-stripped">



  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Foto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Valor</th>
      <th scope="col">Descripción</th>
      <th scope="col">Stock</th>
      <th scope="col">Categoria_id</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    while ($datos=$sql->fetch_object()) { ?>
    <tr>
      <th scope="row"><?php echo $datos->id ?></th>
      <td>
        <img width="80" src="<?= $datos->imagen ?>" alt="">
      </td>
            <td>
                <?= $datos->nombre ?>
            </td>
            <td>
                <?= $datos->valor ?>
            </td>
            <td class=limited-td>
                <?= $datos->descripcion ?>
            </td>
            <td>
                <?= $datos->stock ?>
            </td>
            <td>
                <?= $datos->categoria_id ?>
            </td>

            
            <td>
            <a data-bs-toggle="modal" data-bs-target="#exampleModaleditar<?= $datos->id?>" class="btn btn-warning">Editar</a>
            </td>
<!-- Modal -->
 

<div class="modal fade" id="exampleModaleditar<?= $datos->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar el Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../controlador/ActualizarProducto.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $datos->id ?>">
          <div>
            <input type="file" class="form-control mb-2" name="imagen">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre del producto</label>
              <input type="text" value="<?= $datos->nombre ?>" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <input type="text" value="<?= $datos->descripcion ?>" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="mb-3">
              <label for="valor" class="form-label">Valor</label>
              <input type="number" value="<?= $datos->valor ?>" class="form-control" id="valor" name="valor" min="100">
            </div>
            <div class="mb-3">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" value="<?= $datos->stock ?>" class="form-control" id="stock" name="stock" min="1">
            </div>
            <div class="mb-3">
              <label for="categoria_id" class="form-label">Categoría_id</label>
              <select name="categoria_id" id="categoria_id" class="form-select">
                <?php
               foreach ($categorias as $categoria_id) {
        echo "<option value='" . $categoria_id . "'>" . $categoria_id . "</option>"; // Usamos el mismo valor para el option
    }
                ?>
              </select>
            </div>
          </div>
          <input type="submit" value="Registrar" name="btneditar" class="form-control btn btn-success">
        </form>
      </div>
    </div>
  </div>
</div>


      <td>

        <a href="RegistroProducto.php?id=<?= $datos->id ?>&nombre=<?=  $datos->imagen ?>" class="btn btn-danger" onclick="return eliminarproductos()">Eliminar</a>
      </td>
    </tr>
      
    
   <?php }
    ?>
    
  </tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
   include 'Footer.php';

?>