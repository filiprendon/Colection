<?php
function openDb()
{
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    // $password = "root";

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
    $conexion = openDb();
    $sentenciaText = "
        SELECT 
            Pokemon.*, 
            Region.nombre AS nombre_region, 
            GROUP_CONCAT(Tipo.nombre SEPARATOR ', ') AS tipos
        FROM 
            Pokemon
        INNER JOIN 
            Region ON Pokemon.region_id = Region.id
        LEFT JOIN 
            Pokemon_Tipo ON Pokemon.id = Pokemon_Tipo.Pokemon_id
        LEFT JOIN 
            Tipo ON Pokemon_Tipo.tipo_id = Tipo.id
        GROUP BY 
            Pokemon.id, Region.nombre
    ";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = closeDb();

    return $resultado;
}



function selectTipo()
{
    $conexion = openDb();


    $sentenciaText = "select * from Tipo";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeDb();

    return $resultado;
}

function tipoConcreto($id)
{
    $conexion = openDb();


    $sentenciaText = `select * from Tipo WHERE id = $id`;

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeDb();

    return $resultado;
}

function selectRegion()
{
    $conexion = openDb();


    $sentenciaText = "select * from Region";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeDb();

    return $resultado;
}

function insertPokemon($nombre, $descripcion, $imagen_url, $region_id)
{
    $conexion = openDb();

    $sentenciaText = "INSERT INTO Pokemon (nombre, descripcion, imagen_url, region_id) VALUES (:nombre, :descripcion, :imagen_url, :region_id)";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':imagen_url', $imagen_url);
    $sentencia->bindParam(':region_id', $region_id);
    $sentencia->execute();

    $conexion = closeDb();
}


function insertRegion($nombre)
{
    $conexion = openDb();

    $sentenciaText = "INSERT INTO Region (nombre) VALUES (:nombre)";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->execute();

    $conexion = closeDb();
}
function deletePokemon($id){
    $conexion = openDb();

    $sentenciaText = "DELETE FROM Pokemon where id = :id";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();

    $conexion = closeDb();

}
function updatePokemon($pokemon_id, $nombre, $descripcion, $imagen_url, $region_id)
{
    $conexion = openDb();
    if ($imagen_url) {
        $sentenciaText = "UPDATE Pokemon SET nombre = :nombre, descripcion = :descripcion, imagen_url = :imagen_url, region_id = :region_id WHERE id = :pokemon_id";
    } else {
        $sentenciaText = "UPDATE Pokemon SET nombre = :nombre, descripcion = :descripcion, region_id = :region_id WHERE id = :pokemon_id";
    }
    
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':pokemon_id', $pokemon_id);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':descripcion', $descripcion);
    if ($imagen_url) {
        $sentencia->bindParam(':imagen_url', $imagen_url);
    }
    $sentencia->bindParam(':region_id', $region_id);
    $sentencia->execute();

    $conexion = closeDb();
}

function getPokemonById($pokemon_id)
{
    $conexion = openDb();

    $sentenciaText = "SELECT * FROM Pokemon WHERE id = :pokemon_id";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':pokemon_id', $pokemon_id);
    $sentencia->execute();

    $pokemon = $sentencia->fetch(PDO::FETCH_ASSOC);

    $conexion = closeDb();

    return $pokemon;
}
