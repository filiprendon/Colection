<?php
require_once('./db.php');

$pokemons = selectPokemons();
$region = selectRegion();
$tipos = selectTipo();

?>

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

<body style="overflow-x: hidden;">

    <ul class="nav justify-content-center">
        <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="pokemons.php">Ver Colección</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_card.php">Añadir Carta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="edit_card.php">Modificar Carta</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="delete_card.php">Eliminar Carta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pruebas.php">Pruebas</a>
        </li> -->
    </ul>



    <div class="row row-cols-md-3 g-4">
        <?php foreach ($pokemons as $pokemon) { ?>
            <div class="d-flex justify-content-center">
                <div class="card w-75" data-tilt>
                    <img src="<?php echo $pokemon['imagen_url']; ?>" class="card-img-top"
                        alt="<?php echo $pokemon['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title">
                            Nombre:
                            <?php echo ($pokemon['nombre']); ?>
                            <br>
                            <h5>ID:
                                <?php echo ($pokemon['id']); ?>
                            </h5>
                        </h5>
                        <h6 class="card-text">Tipo:
                            <?php foreach ($tipos as $tipo) {
                                echo ($tipo['nombre']);
                            } ?>
                        </h6>
                        <h6 class="card-text">Región:
                            <?php echo ($pokemon['nombre_region']) ?>
                        </h6>
                        <p class="card-text">
                            <?php echo ($pokemon['descripcion']) ?>
                        </p>
                        <form action="controller.php" method="post">
                            <div class="position-absolute bottom-0 end-0 p-2">
                                <input type="hidden" name="id" value="<?php echo $pokemon['id']; ?>">
                                <button type="submit" class="btn btn-dark" name="update">Editar</button>
                                <button type="submit" class="btn btn-danger" name="delete">Borrar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        <?php } ?>
    </div>





    <script src="vanilla-tilt.js"></script>
</body>

</html>