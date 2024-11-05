<?php
include 'conexion_sql.php';

// Consulta para obtener los datos de la columna Categoria_id
$query = "SELECT id FROM categorias ORDER BY id";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Consulta fallida: " . $conexion->error);
}

// Almacenar las categorías en un array
$categorias = array();
while ($fila = $resultado->fetch_assoc()) {
    $categorias[] = $fila['id']; // Guardamos solo el valor de Categoria_id
}
?>