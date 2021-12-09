-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2021 a las 01:19:12
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `students`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id_courses` int(11) NOT NULL,
  `name_course` varchar(150) NOT NULL,
  `teacher` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id_courses`, `name_course`, `teacher`) VALUES
(51, 'Primero curso', 'Primer profesor'),
(52, 'Segundo curso', 'Segundo Profesor'),
(53, 'Tercer curso', 'Tercer profesor'),
(54, 'Ingles', 'victor'),
(55, 'historia', 'markes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id_inscriptions` int(11) NOT NULL,
  `name_course` varchar(150) NOT NULL,
  `name_pupil` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscriptions`
--

INSERT INTO `inscriptions` (`id_inscriptions`, `name_course`, `name_pupil`) VALUES
(1, '51', '3'),
(4, '54', '7'),
(9, '54', '3'),
(10, '55', 'undefined'),
(11, '51', 'undefined'),
(12, '51', '3'),
(13, '51', 'undefined'),
(14, '51', 'undefined'),
(15, '51', '3'),
(16, '51', 'undefined'),
(17, '51', 'undefined'),
(18, '51', 'undefined'),
(19, '51', 'undefined'),
(20, '51', 'undefined'),
(21, '51', 'undefined'),
(22, '51', 'undefined'),
(23, '51', 'undefined'),
(24, '51', 'undefined'),
(25, '54', 'undefined'),
(26, '54', 'undefined'),
(27, '55', 'undefined'),
(28, '51', 'undefined'),
(29, '51', 'undefined'),
(30, '51', 'undefined'),
(31, '51', 'undefined'),
(32, '51', 'undefined'),
(33, '51', 'undefined'),
(34, '51', 'undefined'),
(35, '51', 'undefined'),
(36, '51', 'undefined'),
(37, '54', 'undefined'),
(38, '54', '6'),
(39, '53', 'undefined'),
(40, '53', 'undefined'),
(41, '51', 'undefined'),
(42, '53', 'undefined'),
(43, '51', 'undefined'),
(44, '51', 'undefined'),
(45, '51', 'undefined'),
(46, '51', 'undefined'),
(47, '51', 'undefined'),
(48, '51', 'undefined'),
(49, '51', 'undefined'),
(50, '54', 'undefined');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pupil`
--

CREATE TABLE `pupil` (
  `id_pupil` int(11) NOT NULL,
  `name_of_alumno` varchar(150) NOT NULL,
  `sex` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pupil`
--

INSERT INTO `pupil` (`id_pupil`, `name_of_alumno`, `sex`) VALUES
(3, 'Primero alumno', 'Primer sexo'),
(4, 'Segundo alumno', 'Segundo sexo'),
(5, 'Tercer alumno', 'Tercer sexo'),
(6, 'victor', 'varon'),
(7, 'victor', 'varon');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_courses`);

--
-- Indices de la tabla `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id_inscriptions`);

--
-- Indices de la tabla `pupil`
--
ALTER TABLE `pupil`
  ADD PRIMARY KEY (`id_pupil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id_courses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id_inscriptions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `pupil`
--
ALTER TABLE `pupil`
  MODIFY `id_pupil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
