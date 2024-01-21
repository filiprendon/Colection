<?php

require_once('./db.php');


if (isset($_POST['insert']))
{
    $imagen_url = $_FILES['imagen_url'];
    insertPokemon($_POST['nombre'], $_POST['descripcion'], $imagen_url, $_POST['region_id']);

    header('Location: ./pokemons.php');
    exit();
}

if (isset($_POST['delete']))
{
    deletePokemon($_POST['id']);

    header('Location: ./pokemons.php');
    exit();
}

if (isset($_POST['update']))
{
    $id = $_POST['id'];
    updatePokemon($id, $_POST['nombre'], $_POST['descripcion'], $_POST['imagen_url'], $_POST['region_id']);

    header('Location: ./pokemons.php');
    exit();
}