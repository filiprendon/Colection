drop database pokemons;
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
    imagen_url VARCHAR(255),
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
('Fuego'),
('Agua'),
('Planta'),
('Eléctrico'),
('Hielo');

-- Insertar datos en la tabla 'Pokemon'
INSERT INTO Pokemon (nombre, descripcion, imagen_url, region_id) VALUES
('Charizard', 'Descripción de Charizard.', '/jp.jpeg', 1),
('Blastoise', 'Descripción de Blastoise.', 'imagen_blastoise.jpg', 1),
('Venusaur', 'Descripción de Venusaur.', 'imagen_venusaur.jpg', 1),
('Pikachu', 'Descripción de Pikachu.', 'imagen_pikachu.jpg', 2),
('Lapras', 'Descripción de Lapras.', 'imagen_lapras.jpg', 2);

-- Insertar datos en la tabla 'Pokemon_Tipo'
INSERT INTO Pokemon_Tipo (Pokemon_id, tipo_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

