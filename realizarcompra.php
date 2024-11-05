<?php
session_start();
require 'conexion_sql.php';

// Establecer la zona horaria
date_default_timezone_set('America/Bogota');

// Verificar la zona horaria actual
$currentTimezone = date_default_timezone_get();
echo "La zona horaria actual es: " . $currentTimezone . "<br>"; // Para verificar la zona horaria

if (isset($_SESSION['carro']) && count($_SESSION['carro']) > 0) {
    // Aquí deberías manejar la información del cliente
    $usuarios = 1; // Cambiar por el ID real del cliente
    $total = 0;

    // Calcular el total de la compra
    foreach ($_SESSION['carro'] as $item) {
        $total += $item['Precio'] * $item['Cantidad'];
    }

    // Obtener la fecha y hora actual en el formato adecuado
    $fechaActual = date('Y-m-d H:i:s');
    echo "Fecha y hora actual: " . $fechaActual . "<br>"; // Para verificar la fecha y hora

    // Inserción directa en la tabla compras
    $sql = "INSERT INTO compras (usuarios, Total, Fecha) VALUES ($usuarios, $total, '$fechaActual')";

    if ($pdo->exec($sql)) {
        echo "Compra registrada exitosamente.";
    } else {
        echo "Error en la inserción directa: ";
        print_r($pdo->errorInfo());
    }
}
?>
