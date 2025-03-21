<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Conexión a MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");
$colproducto = $cliente->Ferreteria_5A->producto; // Obtener la colección de productos

// Eliminar el producto si se pasa un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $colproducto->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    // Redirigir a la página principal (index.php) para mostrar el listado actualizado
    header('Location: index.php');
}
?>
