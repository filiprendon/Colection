<?php
require_once('./db.php');

$pokemons = selectPokemons();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pokémon</title>
</head>
<body>

<ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pokemons.php">Ver Colección</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_card.php">Añadir Carta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="edit_card.php">Modificar Carta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="delete_card.php">Eliminar Carta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pruebas.php">Pruebas</a>
        </li>
    </ul>

    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Región</th>                
            </tr>

            <?php foreach ($pokemons as $pokemon){ ?>
            <tr>
                <td><?php echo $pokemon['id']; ?></td>
                <td><?php echo $pokemon['nombre']; ?></td>
                <td><?php echo $pokemon['descripcion']; ?></td>
                <td><img src="img/<?php echo $pokemon['imagen_url']; ?>"></td>  
                <td><?php echo $pokemon['region_id']; ?></td>                
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
