<?php
session_start();
require_once ('./db.php');

if (isset($_POST['insert'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $region_id = $_POST['region_id'];
    $tipos = $_POST['tipo'];

    $targetDirectory = 'img/';
    $targetFileName = $targetDirectory . basename($_FILES['imagen_url']['name']);
    move_uploaded_file($_FILES['imagen_url']['tmp_name'], $targetFileName);

    // En vez de pasar imagen_url paso targetFileName
    insertPokemon($nombre, $descripcion, $targetFileName, $region_id, $tipos);


    if (isset($_SESSION['error'])) {
        header('Location: ./add_card.php');

    } else {
        header('Location: ./pokemons.php');

    }
    exit();
}



if (isset($_POST['delete'])) {
    deletePokemon($_POST['id']);

    header('Location: ./pokemons.php');
    exit();
}


if (isset($_POST['update'])) {
    $pokemon_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $region_id = $_POST['region_id'];

    // Solo se actualiza si hay una nueva imagen
    if ($_FILES['imagen_url']['size'] > 0) {
        $targetDirectory = 'img/';
        $targetFileName = $targetDirectory . basename($_FILES['imagen_url']['name']);
        move_uploaded_file($_FILES['imagen_url']['tmp_name'], $targetFileName);
        $imagen_url = $targetFileName;
    } else {
        $imagen_url = $_POST['imagen_url_existente'];
    }

    updatePokemon($pokemon_id, $nombre, $descripcion, $imagen_url, $region_id);

    header('Location: ./pokemons.php');
    exit();
}