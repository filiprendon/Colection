<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colecciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
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


    <?php
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $nombre = $_POST['txtNombre'];
        $tipos = $_POST['tip'];
        $regiones = $_POST['region']; 
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];
        
    
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
        echo '<div class="col">';
        echo '<div class="card h-100">';
        echo '<img src="..." class="card-img-top" alt="...">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $nombre . '</h5>';
        echo '<p class="card-text">' . $imagen . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
        
        
        
        ?>

  

</body>

</html>