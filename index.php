<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Conexión a MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");
$colproducto = $cliente->Ferreteria_5A->producto; // Obtener la colección de productos

// Recuperar productos
$resultado = $colproducto->find();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2 class="text-center">Lista de Productos</h2>

    <!-- Formulario de inserción de productos -->
    <h3>Agregar Producto</h3>
    <form method="POST" action="insertar.php">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
        </div>
        <div class="mb-3">
            <label for="costo" class="form-label">Costo</label>
            <input type="number" class="form-control" id="costo" name="costo" step="any" required>
        </div>
        <button type="submit" class="btn btn-primary">Insertar Producto</button>
    </form>

    <!-- Mostrar productos existentes -->
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Marca</th>
                <th>Costo</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $producto) {
                $codigo = (string)$producto['_id']; // Acceso directo a _id
                $nombre = $producto['nombProd']; // Nombre del producto
                $marca = $producto['marca']; // Marca del producto
                $costo = (float)$producto['costo']->__toString(); // Convertir Decimal128 a float
                $categoria = $producto['categoria']; // Categoría

                echo "<tr>";
                echo "<td>$codigo</td>";
                echo "<td>$nombre</td>";
                echo "<td>$marca</td>";
                echo "<td>$costo</td>";
                echo "<td>$categoria</td>";
                echo "<td>
                        <a href='actualizar.php?id=$codigo' class='btn btn-warning'>Actualizar</a>
                        <a href='eliminar.php?id=$codigo' class='btn btn-danger'>Eliminar</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
