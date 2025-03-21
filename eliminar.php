<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Conexión a MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");
$colproducto = $cliente->Ferreteria_5A->producto; // Obtener la colección de productos

// Verificar si el ID está presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtener el ID de la URL

    // Verificar que el ID tenga 24 caracteres (ObjectId en MongoDB)
    if (strlen($id) == 24) {
        try {
            // Eliminar el producto de la base de datos usando el ID
            $resultado = $colproducto->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

            // Verificar si la eliminación fue exitosa
            if ($resultado->getDeletedCount() > 0) {
                echo "Producto eliminado correctamente.";
            } else {
                echo "No se encontró el producto para eliminar.";
            }

            // Redirigir a la página principal (index.php) después de eliminar el producto
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            echo "Error al eliminar el producto: " . $e->getMessage();
        }
    } else {
        echo "ID no válido.";
    }
} else {
    echo "No se ha especificado un ID para eliminar.";
}
?>
