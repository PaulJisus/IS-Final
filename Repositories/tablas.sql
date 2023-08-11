DROP DATABASE IF EXISTS mainDB;
CREATE DATABASE mainDB;
USE mainDB;

CREATE TABLE Organizador (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(25),
    apellidos VARCHAR(30),
    correo_electronico VARCHAR(30),
    nombre_de_usuario VARCHAR(20), 
    clave VARCHAR(30),
    telefono VARCHAR(9)
);
    
CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(25),
    apellidos VARCHAR(30),
    correo_electronico VARCHAR(30),
    nombre_de_usuario VARCHAR(20), 
    clave VARCHAR(30),
    telefono VARCHAR(9),
    cantidad_votacion INT
);
   
CREATE TABLE Candidato (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(25),
    apellidos VARCHAR(30),
    correo_electronico VARCHAR(30),
    telefono VARCHAR(9),
    nacionalidad VARCHAR(20)
);

CREATE TABLE Categoria(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(20)
);

CREATE TABLE Votacion(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30),
    id_categoria INT,
    descripcion VARCHAR (50),
    pais VARCHAR(20),
    cantidad_votantes INT,
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id)
);

CREATE TABLE Sesion(
	id INT PRIMARY KEY AUTO_INCREMENT,
	hora TIME,
    fecha DATE,
    informacionExtra VARCHAR(30),
    id_votacion INT,
    FOREIGN KEY (id_votacion) REFERENCES Votacion(id)
);


CREATE TABLE Votacion_Organizador(
	id_votacion INT,
    id_organizador INT,
    PRIMARY KEY(id_votacion,id_organizador),
    FOREIGN KEY (id_votacion) REFERENCES Votacion(id),
    FOREIGN KEY (id_organizador) REFERENCES Organizador(id)
);
    

CREATE TABLE Votacion_Sesion(
	id_votacion INT,
    id_sesion INT,
    PRIMARY KEY(id_votacion,id_sesion),
    FOREIGN KEY (id_votacion) REFERENCES Votacion(id),
    FOREIGN KEY (id_sesion) REFERENCES Sesion(id)
);

CREATE TABLE Sesion_Usuario(
	id_usuario INT,
    id_sesion INT,
    PRIMARY KEY(id_usuario,id_sesion),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    FOREIGN KEY (id_sesion) REFERENCES Sesion(id)
);
    