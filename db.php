<?php
function openBd()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";

    try {
        $conexion = new PDO("mysql:host=$servername;dbname=pokemons", $username, $password);
        // set the PDO error mode to exception
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->exec("set names utf8");

        return $conexion;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function closeDb()
{
    return null;
}


function selectPokemons()
{
    $conexion = openBd();


    $sentenciaText = "select * from Pokemon";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeDb();

    return $resultado;
}

function insertPokemon($nombre, $descripcion, $imagen_url, $region_id)
{
    $conexion = openBd();

    $sentenciaText = "INSERT INTO Pokemon (nombre, descripcion, imagen_url, region_id) VALUES (:nombre, :descripcion, :imagen_url, :region_id)";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':imagen_url', $imagen_url);
    $sentencia->bindParam(':region_id', $region_id);
    $sentencia->execute();

    $conexion = closeDb();
}

?>