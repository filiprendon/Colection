<?php
require_once('./db.php');

$tipos = selectTipo();
$regiones = selectRegion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <style>
        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 90vh;
        }
    </style>
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


    <div class="centered-container">
        <h1 class="mb-4">Añadir Pokémon</h1>
        <form action="pokemons.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre del Pokémon">
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo[]" class="form-select" id="tipo" multiple>
                    <?php foreach ($tipos as $tipo) { ?>
                        <option value="<?php echo $tipo['id']; ?>">
                            <?php echo $tipo['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="region" class="form-label">Región</label>
                <select name="region[]" class="form-select" id="region" multiple>
                    <?php foreach ($regiones as $region) { ?>
                        <option value="<?php echo $region['id']; ?>">
                            <?php echo $region['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Describe al Pokémon" id="descripcion"></textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Foto del Pokémon</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="imagen">
                    <label class="input-group-text" for="imagen">Subir foto</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Aceptar</button>
            <button type="submit" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>
</body>

</html>
