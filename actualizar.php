<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Importar las clases necesarias de MongoDB
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Decimal128;

// Conexión a MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");
$colproducto = $cliente->Ferreteria_5A->producto; // Obtener la colección de productos

// Obtener el ID del producto a actualizar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $producto = $colproducto->findOne(['_id' => new ObjectId($id)]);
}

// Verificar si el formulario fue enviado para actualizar el producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $costo = $_POST['costo']; // El costo recibido

    // Crear un Decimal128 para el costo
    $costoDecimal = new Decimal128($costo); // Convertir el costo a Decimal128

    // Actualizar el producto
    $colproducto->updateOne(
        ['_id' => new ObjectId($id)],
        ['$set' => [
            'nombProd' => $nombre,
            'marca' => $marca,
            'categoria' => $categoria,
            'costo' => $costoDecimal // Usar Decimal128 aquí
        ]]
    );

    // Redirigir a la página principal (index.php) para mostrar el listado actualizado
    header('Location: index.php');
}
?>
