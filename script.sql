-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2015 a las 18:03:49
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.6.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica13`
--
CREATE DATABASE practica13;

USE practica13;

-- --------------------------------------------------------
--
-- Estructura para la tabla `usuarios`
--

CREATE TABLE usuarios (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  usuario varchar(32) not null,
  password varchar(32) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `categorias`
--

CREATE TABLE categorias (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(32) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `equipos`
--

CREATE TABLE equipos (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(32) not null,
  categoria int(11) REFERENCES categorias(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `jugadores`
--

CREATE TABLE jugadores (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  numero int(11) not null,
  nombre varchar(32) not null,
  apellidos varchar(32) not null,
  equipo int(11) REFERENCES equipo(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*----------------------------------------------------------------------------*/
        VOLCADO DE REGISTRO DE PRUEBA
/*----------------------------------------------------------------------------*/
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO usuarios (usuario, password) VALUES
('admin','admin'), ('luis','luis');

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO categorias (nombre) VALUES
('Futbol'), ('Basquetbol'), ('Voleybol');

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO equipos (nombre, categoria) VALUES
('Los Mininos',1), ('Los Jaguares',1), ('Los Coyones',2);

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO jugadores (numero, nombre, apellidos, equipo) VALUES
(27, 'Luis', 'Gomez',1),
(9, 'Yazmin', 'Roque',2);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
