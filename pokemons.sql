DROP DATABASE IF EXISTS pokemons;
CREATE DATABASE IF NOT EXISTS pokemons;
USE pokemons;

CREATE TABLE Categoria (
    CategoriaID INT AUTO_INCREMENT PRIMARY KEY,
    NombreCategoria VARCHAR(255)
);

CREATE TABLE Coleccion (
    ColeccionID INT AUTO_INCREMENT PRIMARY KEY,
    NombreColeccion VARCHAR(255)
);

CREATE TABLE Region (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion TEXT
);

CREATE TABLE Tipo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255)
);

CREATE TABLE Pokemon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion TEXT,
    imagen_url BLOB,
    region_id INT,
    FOREIGN KEY (region_id) REFERENCES Region(id)
);

CREATE TABLE Pokemon_Tipo (
    Pokemon_id INT,
    tipo_id INT,
    FOREIGN KEY (Pokemon_id) REFERENCES Pokemon(id),
    FOREIGN KEY (tipo_id) REFERENCES Tipo(id),
    PRIMARY KEY (Pokemon_id, tipo_id)
);

-- Insertar datos en la tabla 'Categoria'
INSERT INTO Categoria (NombreCategoria) VALUES
('Fuego'),
('Agua'),
('Planta'),
('Eléctrico'),
('Hielo');

-- Insertar datos en la tabla 'Coleccion'
INSERT INTO Coleccion (NombreColeccion) VALUES
('Colección de Pokémon'),
('Colección de Magic'),
('Colección de Fútbol');

-- Insertar datos en la tabla 'Region'
INSERT INTO Region (nombre, descripcion) VALUES
('Kanto', 'Región de Kanto con una descripción.'),
('Johto', 'Región de Johto con una descripción.'),
('Hoenn', 'Región de Hoenn con una descripción.'),
('Sinnoh', 'Región de Sinnoh con una descripción.'),
('Unova', 'Región de Unova con una descripción.');

-- Insertar datos en la tabla 'Tipo'
INSERT INTO Tipo (nombre) VALUES
('Normal'),
('Fuego'),
('Agua'),
('Eléctrico'),
('Planta'),
('Hielo'),
('Lucha'),
('Veneno'),
('Tierra'),
('Volador'),
('Psíquico'),
('Bicho'),
('Roca'),
('Fantasma'),
('Dragón'),
('Siniestro'),
('Acero'),
('Hada');

-- Insertar datos en la tabla 'Pokemon'
INSERT INTO Pokemon (nombre, descripcion, imagen_url, region_id) VALUES
('Charizard', 'Un poderoso Pokémon con la capacidad de lanzar llamas que funden casi cualquier cosa', '/collection/img/charizard.png', 1),
('Blastoise', 'Aumenta de peso deliberadamente para contrarrestar la fuerza de los chorros de agua que dispara', '/collection/img/blastoise.png', 3),
('Pikachu', 'La icónica mascota de Pokémon, famoso por sus ataques eléctricos y carácter amistoso', '/collection/img/pikachu.png', 1),
('Bulbasaur', 'Un Pokémon conocido por la planta en su espalda que crece con la energía solar', '/collection/img/bulbasaur.png', 1),
('Beedrill', 'Adorable y juguetón, Jigglypuff es un Pokémon de tipo Normal/Hada famoso por hacer dormir a sus oponentes con su canto', '/collection/img/beedrill.png', 1),
('Gengar', 'Un Pokémon que se esconde en las sombras y aterroriza a sus víctimas', '/collection/img/gengar.png', 2),
('Eevee', 'Eevee es un Pokémon conocido por su capacidad de evolucionar en múltiples formas', '/collection/img/eevee.png', 1),
('Snorlax', 'Conocido por su gran tamaño y tendencia a dormir en cualquier lugar, es un Pokémon extremadamente fuerte en combate', '/collection/img/snorlax.png', 1),
('Lucario', 'Lucario es un Pokémon de tipo Lucha/Acero famoso por su habilidad para sentir y manipular aura', '/collection/img/lucario.png', 4),
('Garchomp', 'Garchomp es un Pokémon de tipo Dragón/Tierra conocido por su velocidad y ferocidad en combate', '/collection/img/garchomp.png', 4);

-- Insertar datos en la tabla 'Pokemon_Tipo'
INSERT INTO Pokemon_Tipo (Pokemon_id, tipo_id) VALUES
(1, 2),  -- Charizard - Fuego
(2, 3),  -- Blastoise - Agua
(3, 4),  -- Pikachu - Eléctrico
(4, 5),  -- Bulbasaur - Planta
(5, 12), -- Beedrill - Bicho
(6, 14), -- Gengar - Fantasma
(7, 1),  -- Eevee - Normal
(8, 1),  -- Snorlax - Normal
(9, 7),  -- Lucario - Lucha
(9, 17), -- Lucario - Acero
(10, 15),-- Garchomp - Dragón
(10, 9); -- Garchomp - Tierra
