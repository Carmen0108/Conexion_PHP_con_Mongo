<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Conexión a MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");
$colproducto = $cliente->Ferreteria_5A->producto; // Obtener la colección de productos

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $costo = $_POST['costo']; // El costo recibido

    // Crear un Decimal128 para el costo
    $costoDecimal = new MongoDB\BSON\Decimal128($costo);

    // Insertar el nuevo producto
    $colproducto->insertOne([
        'nombProd' => $nombre,
        'marca' => $marca,
        'categoria' => $categoria,
        'costo' => $costoDecimal // Usar Decimal128 aquí
    ]);

    // Redirigir a la página principal (index.php) para mostrar el listado actualizado
    header('Location: index.php');
}
?>
