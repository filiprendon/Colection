<?php

require_once('./db.php');

if (isset($_POST['insert'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $region_id = $_POST['region_id'];

    $targetDirectory = 'img/';
    $targetFileName = $targetDirectory . basename($_FILES['imagen_url']['name']);
    move_uploaded_file($_FILES['imagen_url']['tmp_name'], $targetFileName);

    insertPokemon($nombre, $descripcion, $targetFileName, $region_id);

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