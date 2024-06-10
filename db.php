<?php

session_start();
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

function errorMessage($e)
{
    if (!empty($e->errorInfo[1])) {
        switch ($e->errorInfo[1]) {
            case 1062:
                $mensaje = 'Registro duplicado';
                break;
            case 1451:
                $mensaje = 'Registro con elementos relacionados';
                break;
            case 1406:
                $mensaje = 'Registro demasiado largo';
                break;
            default:
                $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                break;
        }
    } else {
        switch ($e->getCode()) {
            case 1044:
                $mensaje = 'Usuario y/o password incorrecto';
                break;
            case 1049:
                $mensaje = 'Base de datos desconocida';
                break;
            case 2002:
                $mensaje = 'No se encuentra el servidor';
                break;
            default:
                $mensaje = $e->getCode() . ' - ' . $e->getMessage();
                break;
        }
    }

    return $mensaje;
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

function insertPokemon($nombre, $descripcion, $imagen_url, $region_id, $tipos)
{
    try {
        $conexion = openDb();

        // Iniciar la transacción
        $conexion->beginTransaction();

        // Insertar el Pokémon
        $sentenciaText = "INSERT INTO Pokemon (nombre, descripcion, imagen_url, region_id) VALUES (:nombre, :descripcion, :imagen_url, :region_id)";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':imagen_url', $imagen_url);
        $sentencia->bindParam(':region_id', $region_id);
        $sentencia->execute();

        // Obtener el ID del Pokémon insertado
        $pokemon_id = $conexion->lastInsertId();

        // Insertar los tipos del Pokémon
        foreach ($tipos as $tipo_id) {
            $sentenciaText = "INSERT INTO Pokemon_Tipo (Pokemon_id, tipo_id) VALUES (:pokemon_id, :tipo_id)";
            $sentencia = $conexion->prepare($sentenciaText);
            $sentencia->bindParam(':pokemon_id', $pokemon_id);
            $sentencia->bindParam(':tipo_id', $tipo_id);
            $sentencia->execute();
        }

        // Commit de la transacción
        $conexion->commit();

        $_SESSION['mensaje'] = "Registro insertado correctamente";

    } catch (PDOException $e) {
        // Rollback de la transacción en caso de error
        $conexion->rollBack();
        $_SESSION['error'] = errorMessage($e);

        // Guardar datos en sesión para repoblación del formulario
        $pokemon['nombre'] = $nombre;
        $pokemon['descripcion'] = $descripcion;
        $pokemon['imagen_url'] = $imagen_url;
        $pokemon['region_id'] = $region_id;
        $_SESSION['pokemon'] = $pokemon;
    }

    $conexion = closeDb();

}


function getTiposByPokemonId($pokemon_id)
{
    $conexion = openDb();
    $sentenciaText = "SELECT t.nombre FROM Tipo t INNER JOIN Pokemon_Tipo pt ON t.id = pt.tipo_id WHERE pt.Pokemon_id = :pokemon_id";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':pokemon_id', $pokemon_id);
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
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
function deletePokemon($id)
{
    $conexion = openDb();

    try {
        // Iniciar la transacción
        $conexion->beginTransaction();

        // Eliminar los registros asociados en Pokemon_Tipo
        $sentenciaText = "DELETE FROM Pokemon_Tipo WHERE Pokemon_id = :pokemon_id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':pokemon_id', $id);
        $sentencia->execute();

        // Luego eliminar el Pokémon
        $sentenciaText = "DELETE FROM Pokemon WHERE id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();

        // Commit de la transacción
        $conexion->commit();

        $_SESSION['mensaje'] = 'Pokemon eliminado correctamente!';
    } catch (PDOException $e) {
        // Rollback de la transacción en caso de error
        $conexion->rollBack();
        $_SESSION['error'] = errorMessage($e);
    }

    $conexion = closeDb();
}


function updatePokemon($pokemon_id, $nombre, $descripcion, $imagen_url, $region_id)
{
    $conexion = openDb();

    try {
        // Iniciar la transacción
        $conexion->beginTransaction();

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

        // Commit de la transacción
        $conexion->commit();

        $_SESSION['mensaje'] = 'Pokemon modificado correctamente!';
    } catch (PDOException $e) {
        // Rollback de la transacción en caso de error
        $conexion->rollBack();
        $_SESSION['error'] = errorMessage($e);
    }

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