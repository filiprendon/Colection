<?php

require_once('./db.php');
if (isset($_POST['insert']))
{
    insertPokemon($_POST['nombre'], $_POST['descripcion'], $_POST['imagen_url'], $_POST['region_id']);

    header('Location: ./pokemons.php');
    exit();
}

if (isset($_POST['insert']))
{
    insertRegion($_POST['nombre']);

    header('Location: ./pokemons.php');
    exit();
}
