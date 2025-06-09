-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2025 a las 17:10:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tchat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen_url` text DEFAULT NULL,
  `enlace` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`id`, `titulo`, `descripcion`, `imagen_url`, `enlace`) VALUES
(1, 'AULA VIRTUAL', 'Accede a la plataforma educativa AULA VIRTUAL', '\\assets\\img\\aulavirtual.png', 'https://aulavirtual.murciaeduca.es/index.php'),
(2, 'MIRADOR XXI', 'Información Académica y seguimiento del alumno', 'assets\\img/plumier.png', 'https://mirador.murciaeduca.es/mirador/'),
(3, 'EDUCARM', 'Accede al portal educativo EDUCARM', 'assets\\img/educarm.png', 'https://www.educarm.es/home'),
(4, 'FP A DISTANCIA', 'Formación Profesional en modalidad online', 'assets\\img/distancia.jpg', 'https://ead.murciaeduca.es/login/index.php'),
(5, 'LLEGARÁS ALTO', 'Campaña regional de orientación y FP', 'assets\\img/llegaras alto.jpg', 'https://aulavirtual.murciaeduca.es/index.php'),
(6, 'ERASMUS+', 'Información sobre movilidades internacionales', '\\assets\\img/erasmus.jpg', 'https://iesgoya.com/erasmus/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clickuser`
--

CREATE TABLE `clickuser` (
  `id` int(11) NOT NULL,
  `UserIdSession` int(11) DEFAULT NULL,
  `clickUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clickuser`
--

INSERT INTO `clickuser` (`id`, `UserIdSession`, `clickUser`) VALUES
(1, 11, 12),
(2, 12, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL,
  `fecha_agregado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `user_id`, `contacto_id`, `fecha_agregado`) VALUES
(1, 11, 12, '2025-05-11 20:28:56'),
(2, 11, 10, '2025-05-11 20:28:56'),
(5, 12, 11, '2025-05-11 20:39:09'),
(7, 12, 10, '2025-05-12 22:43:06'),
(8, 7, 11, '2025-05-31 19:21:20'),
(9, 11, 7, '2025-05-31 19:21:20'),
(10, 7, 12, '2025-05-31 20:20:50'),
(11, 12, 7, '2025-05-31 20:20:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `allDay` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `start`, `end`, `allDay`) VALUES
(1, 'mi cumple', '2025-05-07 00:00:00', '2025-05-08 00:00:00', 1),
(2, 'presentar mariajose', '2025-05-21 00:00:00', '2025-05-22 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friend_requests`
--

CREATE TABLE `friend_requests` (
  `requester_id` int(11) NOT NULL COMMENT 'Usuario que envía la solicitud',
  `requested_id` int(11) NOT NULL COMMENT 'Usuario que recibe la solicitud',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha/hora de envío',
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `friend_requests`
--

INSERT INTO `friend_requests` (`requester_id`, `requested_id`, `created_at`, `message`) VALUES
(7, 10, '2025-05-28 07:57:31', NULL),
(13, 12, '2025-06-01 11:22:27', 'Holaaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `creado_por` int(11) NOT NULL,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `descripcion`, `creado_por`, `creado_en`) VALUES
(1, 'Grupo1', 'Prueba 1', 12, '2025-05-15 17:44:50'),
(2, 'Grupo2', 'Grupo2', 12, '2025-05-15 17:59:07'),
(3, 'grupo3', 'Prueba3', 12, '2025-05-15 18:17:36'),
(4, 'GRUPO7', 'Pruebadigesimocuarta', 12, '2025-05-15 19:53:44'),
(5, 'GRUPO7', 'Pruebadigesimocuarta', 12, '2025-05-15 19:55:16'),
(6, 'PROYECTO', 'Lo que quieras', 11, '2025-05-23 13:10:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_mensajes`
--

CREATE TABLE `grupo_mensajes` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `enviado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_mensajes`
--

INSERT INTO `grupo_mensajes` (`id`, `grupo_id`, `usuario_id`, `mensaje`, `enviado_en`) VALUES
(1, 1, 11, 'hola', '2025-05-16 20:25:30'),
(2, 1, 11, 'alo', '2025-05-16 20:25:54'),
(3, 5, 10, 'hola', '2025-05-16 20:30:15'),
(4, 5, 10, 'AAAAAAAAAAAAAAAA', '2025-05-16 20:30:33'),
(5, 5, 12, 'a', '2025-05-16 20:30:40'),
(6, 5, 11, 'ijdawf', '2025-05-18 11:07:41'),
(7, 5, 11, 'awfawf', '2025-05-18 11:33:42'),
(8, 5, 11, 'fawfwafa', '2025-05-18 11:52:10'),
(9, 5, 11, 'awdwaawd', '2025-05-18 12:06:34'),
(10, 5, 11, 'daw', '2025-05-18 12:07:13'),
(11, 5, 11, 'dwadwa', '2025-05-18 12:07:14'),
(12, 5, 11, 'dwadaw', '2025-05-18 12:07:16'),
(13, 5, 11, 'a', '2025-05-18 12:19:31'),
(14, 5, 11, 'daw', '2025-05-18 21:24:01'),
(15, 5, 11, 'aaahh', '2025-05-18 21:25:03'),
(16, 5, 12, 'hola', '2025-05-19 16:42:43'),
(17, 5, 12, 'como tamos muchachos', '2025-05-19 16:43:08'),
(18, 5, 12, 'espero que bien porque aqui viene tu vieja', '2025-05-19 16:43:25'),
(19, 5, 12, 'a', '2025-05-19 16:44:23'),
(20, 5, 12, 'hola', '2025-05-19 16:46:05'),
(21, 5, 12, 'Amigos', '2025-05-19 16:51:46'),
(22, 5, 12, 'forever', '2025-05-19 16:51:49'),
(23, 5, 10, 'tu mama', '2025-05-19 16:51:53'),
(24, 5, 12, 'perro sancheee', '2025-05-21 07:58:03'),
(25, 5, 12, 'maracuya', '2025-05-21 07:58:08'),
(26, 5, 12, 'venezuela', '2025-05-21 07:58:48'),
(27, 5, 12, 'primo como te gusta lo que te encanta', '2025-05-21 07:58:57'),
(28, 5, 11, 'aver aver', '2025-05-21 12:01:57'),
(29, 5, 11, 'que paso', '2025-05-21 12:01:59'),
(30, 5, 11, 'porque tanto alboroto', '2025-05-21 12:02:03'),
(31, 5, 11, 'Me gusta la pepsi', '2025-05-21 12:02:56'),
(32, 5, 12, 'venezuela', '2025-05-21 12:03:07'),
(33, 5, 11, 'perico', '2025-05-21 12:05:32'),
(34, 5, 11, 'pero bueno', '2025-05-21 12:06:20'),
(35, 5, 11, 'pepe', '2025-05-21 12:07:02'),
(36, 5, 11, 'como tamos', '2025-05-21 12:08:27'),
(37, 5, 12, 'laos', '2025-05-21 12:08:44'),
(38, 5, 12, 'pepe', '2025-05-21 12:09:19'),
(39, 5, 12, 'loquesea', '2025-05-21 12:12:55'),
(40, 5, 12, 'pedrico', '2025-05-22 20:36:17'),
(41, 5, 12, 'como va antonia', '2025-05-22 20:36:26'),
(42, 5, 11, 'hola', '2025-05-22 20:36:52'),
(43, 5, 12, 'pepe', '2025-05-22 20:41:45'),
(44, 5, 12, 'pablo', '2025-05-22 20:41:59'),
(45, 5, 12, 'pepito', '2025-05-22 20:45:44'),
(46, 5, 12, 'leche', '2025-05-22 20:45:50'),
(47, 5, 11, 'caramba', '2025-05-22 20:45:55'),
(48, 5, 11, 'hola', '2025-05-22 20:50:10'),
(49, 5, 11, 'que tal', '2025-05-22 20:50:12'),
(50, 5, 12, 'pepito como estas?', '2025-05-22 20:50:28'),
(51, 5, 12, 'te gusta la pepsi', '2025-05-22 20:50:34'),
(52, 5, 10, 'yepaa', '2025-05-22 20:51:17'),
(53, 5, 10, 'que tal todos', '2025-05-22 20:51:20'),
(54, 2, 10, 'hola', '2025-05-22 20:51:39'),
(55, 2, 11, 'que tal', '2025-05-22 20:52:01'),
(56, 5, 11, 'bien', '2025-05-22 20:56:52'),
(57, 5, 11, 'y tu', '2025-05-22 20:56:55'),
(58, 2, 10, 'bien bien', '2025-05-22 20:57:26'),
(59, 2, 10, 'y que tal tu', '2025-05-22 20:57:31'),
(60, 2, 11, 'perfectamente', '2025-05-22 20:57:38'),
(61, 5, 11, 'jeje', '2025-05-23 07:24:45'),
(62, 5, 11, 'a', '2025-05-23 07:35:52'),
(63, 5, 11, 'a', '2025-05-23 11:30:06'),
(64, 5, 11, 'bjaifwfaw', '2025-05-23 11:30:11'),
(65, 5, 11, 'buenos dias', '2025-05-23 11:30:52'),
(66, 5, 11, 'que tal', '2025-05-23 11:30:57'),
(67, 5, 11, 'Holaaaa', '2025-05-23 13:06:28'),
(68, 5, 11, 'Holaaaa', '2025-05-23 13:06:28'),
(69, 5, 11, 'amigoo', '2025-05-23 13:07:05'),
(70, 5, 11, 'amigoo', '2025-05-23 13:07:05'),
(71, 5, 11, 'que tal te fue', '2025-05-23 13:07:09'),
(72, 5, 11, 'que tal te fue', '2025-05-23 13:07:09'),
(73, 6, 12, 'lol', '2025-05-23 13:11:10'),
(74, 5, 11, 'weaos', '2025-05-30 21:44:24'),
(75, 5, 12, 'lel', '2025-05-30 21:48:12'),
(76, 5, 12, 'waaaaa', '2025-05-30 21:48:19'),
(77, 5, 12, 'ifjawjifaw', '2025-05-31 20:21:37'),
(78, 5, 12, 'faw', '2025-05-31 20:21:37'),
(79, 5, 12, 'fw', '2025-05-31 20:21:37'),
(80, 5, 12, 'awf', '2025-05-31 20:21:40'),
(81, 5, 12, 'hola', '2025-05-31 20:22:43'),
(82, 5, 11, 'hey', '2025-06-01 16:02:36'),
(83, 5, 11, 'adawdwa', '2025-06-01 16:02:54'),
(84, 5, 11, 'lol', '2025-06-01 17:27:57'),
(85, 5, 11, 'lol', '2025-06-01 17:27:57'),
(86, 5, 11, 'loll', '2025-06-01 17:27:59'),
(87, 5, 11, 'loll', '2025-06-01 17:27:59'),
(88, 5, 11, 'le', '2025-06-01 17:28:22'),
(89, 5, 11, 'lol', '2025-06-01 17:28:28'),
(90, 5, 11, '123', '2025-06-01 17:28:41'),
(91, 5, 11, 'amigo', '2025-06-01 17:29:13'),
(92, 5, 11, 'wtf', '2025-06-01 17:29:15'),
(93, 5, 12, 'hola', '2025-06-01 17:29:50'),
(94, 5, 11, 'bro', '2025-06-01 17:30:02'),
(95, 5, 11, 'ta rara la wea', '2025-06-01 17:30:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuarios`
--

CREATE TABLE `grupo_usuarios` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `agregado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_usuarios`
--

INSERT INTO `grupo_usuarios` (`id`, `grupo_id`, `usuario_id`, `agregado_en`) VALUES
(1, 1, 11, '2025-05-15 17:44:50'),
(2, 2, 11, '2025-05-15 17:59:07'),
(3, 2, 10, '2025-05-15 17:59:07'),
(4, 3, 10, '2025-05-15 18:17:36'),
(5, 5, 11, '2025-05-15 19:55:16'),
(6, 5, 10, '2025-05-15 19:55:16'),
(7, 5, 12, '2025-05-15 19:55:16'),
(8, 6, 12, '2025-05-23 13:10:23'),
(9, 6, 11, '2025-05-23 13:10:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `msjs`
--

CREATE TABLE `msjs` (
  `id` int(11) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `to_user` varchar(250) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `nombre_equipo_user` varchar(250) DEFAULT NULL,
  `leido` varchar(100) DEFAULT NULL,
  `sonido` varchar(10) DEFAULT NULL,
  `archivos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `msjs`
--

INSERT INTO `msjs` (`id`, `user`, `user_id`, `to_user`, `to_id`, `message`, `fecha`, `nombre_equipo_user`, `leido`, `sonido`, `archivos`) VALUES
(128, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'hola', '2025-05-25 19:37:22', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(129, 'alejandroalvarado@gmail.com', 11, 'Alejandro ', 10, 'aa', '2025-05-28 07:48:13', 'LAPTOP-FD754G8J', 'NO', NULL, NULL),
(130, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'aaa', '2025-05-31 10:45:06', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(131, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'aaaa', '2025-05-31 10:45:17', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(132, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'adwadwadf', '2025-05-31 10:45:35', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(133, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'hola', '2025-05-31 20:21:51', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(134, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'hola', '2025-05-31 20:22:24', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(135, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'alooo', '2025-06-01 15:10:45', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(136, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'como ta', '2025-06-01 15:10:46', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(137, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'los platanos', '2025-06-01 15:10:51', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(138, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'jsjsjssj', '2025-06-01 15:10:54', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(139, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'dawfawfaw', '2025-06-01 15:10:57', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(140, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'broooo', '2025-06-01 15:11:02', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(141, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'que guay', '2025-06-01 15:11:05', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(142, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'funciona', '2025-06-01 15:11:11', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(143, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'o eso creo', '2025-06-01 15:29:25', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(144, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'biieeen', '2025-06-01 15:29:29', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(145, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'aaa', '2025-06-01 15:29:43', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(146, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'waka', '2025-06-01 15:29:56', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(147, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'waka', '2025-06-01 15:30:09', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(148, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 15:56:57', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(149, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'aa', '2025-06-01 15:57:09', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(150, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'ldawlflaf', '2025-06-01 15:57:29', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(151, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'jfnawjnafwfaw', '2025-06-01 15:57:39', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(152, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 16:29:01', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(153, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 16:29:20', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(154, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'holaaa', '2025-06-01 16:32:06', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(155, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'que tal', '2025-06-01 16:32:08', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(156, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'como vas', '2025-06-01 16:32:10', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(157, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'hola', '2025-06-01 17:26:27', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(158, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'hola', '2025-06-01 17:26:53', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(159, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'que tal', '2025-06-01 17:26:55', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(160, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'wat', '2025-06-01 17:27:00', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(161, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 17:27:18', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(162, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 17:27:33', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(163, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'lol', '2025-06-01 17:27:38', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(164, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'la', '2025-06-01 17:27:40', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(165, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'lel', '2025-06-01 17:27:45', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(166, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'bro', '2025-06-01 17:31:54', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(167, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'ta raro esto', '2025-06-01 17:32:01', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(168, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'hola', '2025-06-01 17:33:56', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(169, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'bro', '2025-06-01 17:34:24', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(170, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'funca', '2025-06-01 17:34:25', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(171, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'o que', '2025-06-01 17:34:27', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(172, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'lel', '2025-06-01 17:34:34', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(173, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'amigo', '2025-06-01 17:35:37', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(174, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'forever', '2025-06-01 17:35:39', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(175, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'broda', '2025-06-01 17:37:22', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(176, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'l', '2025-06-01 17:37:27', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(177, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'lol', '2025-06-01 17:37:51', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(178, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'l', '2025-06-01 17:37:53', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(179, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, NULL, '0000-00-00 00:00:00', 'LAPTOP-FD754G8J', 'SI', NULL, '522af50225.jpg'),
(180, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'hola', '2025-06-01 17:50:15', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(181, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'que tal', '2025-06-01 17:50:18', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(182, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 17:51:42', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(183, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 17:52:08', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(184, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'que tal', '2025-06-01 17:52:17', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(185, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'hola', '2025-06-01 18:06:34', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(186, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'oh', '2025-06-01 18:06:36', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(187, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'bien', '2025-06-01 18:06:37', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(188, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, NULL, '2025-06-01 18:51:45', 'LAPTOP-FD754G8J', 'SI', NULL, '9c309640a4.mp4'),
(189, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, NULL, '2025-06-01 19:23:40', 'LAPTOP-FD754G8J', 'SI', NULL, '4798a365ec.jpg'),
(190, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, NULL, '2025-06-01 19:59:27', 'LAPTOP-FD754G8J', 'SI', NULL, '2f0c28a336.mp4'),
(191, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'a', '2025-06-01 20:02:05', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(192, 'alejandro2@gmail.com', 12, 'Alejandro ', 11, 'jaja', '2025-06-01 20:26:40', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(193, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'lel', '2025-06-01 20:27:28', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(194, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'mmm', '2025-06-01 20:27:33', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(195, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'djawjdwa', '2025-06-01 20:27:47', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(196, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'lel', '2025-06-01 20:27:53', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(197, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'awfaw', '2025-06-01 20:28:31', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(198, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'dafwa', '2025-06-01 20:28:36', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(199, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'fwa', '2025-06-01 20:28:38', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(200, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'faw', '2025-06-01 20:28:39', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(201, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'afwfw', '2025-06-01 20:28:40', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(202, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'fw', '2025-06-01 20:28:40', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(203, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'awf', '2025-06-01 20:28:40', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(204, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'fwa', '2025-06-01 20:28:40', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(205, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'a', '2025-06-01 20:29:26', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(206, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'a', '2025-06-01 20:30:01', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(207, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'a', '2025-06-01 20:31:41', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(208, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'a', '2025-06-01 20:33:49', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(209, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'e', '2025-06-01 20:35:13', 'LAPTOP-FD754G8J', 'SI', NULL, NULL),
(210, 'alejandroalvarado@gmail.com', 11, 'Alejandro 2 ', 12, 'i', '2025-06-01 20:35:46', 'LAPTOP-FD754G8J', 'SI', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `imagen_url` text DEFAULT NULL,
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `fecha`, `imagen_url`, `contenido`) VALUES
(1, 'El IES Goya fue agraciado con material eléctrico en un sorteo de la empresa Tessai y la Fundación Excelem', '2025-05-05', '\\assets\\img\\automocion.jpg', 'El IES Goya fue agraciado con material eléctrico en un sorteo de la empresa Tessai y la Fundación Excelem. La Fundación Excelem (https://excelem.org/) junto con la empresa Tessai (https://www.tessai.es/) organizaron recientemente un sorteo entre numerosos centros de enseñanzas de FP en los que se imparten enseñanzas de Automatización y Robótica Industrial. Este sorteo consistía en un lote de más de 1500 referencias de material eléctrico. Tras la participación de nuestro Centro a través del Dpto. de Electricidad-Electrónica, fuimos agraciados con una parte de ese material. Roberto Sáez representante de la fundación Excelem, fue la persona encargada de hacernos entrega del material.'),
(2, 'Alumno de FP del IES Goya premiado en la Gala de la II Edición de los Premios de Excelencia Formación Profesional (curso 2023/2024)', '2025-02-06', '\\assets\\img\\gala.jpg', 'FELICITAMOS A JOSÉ MORALES, ALUMNO DE FP DEL IES GOYA. Celebramos y felicitamos a José Morales, antiguo alumno del ciclo de grado medio de Instalaciones Eléctricas y Automáticas en modalidad semipresencial-distancia del IES Francisco de Goya, premiado en la Gala de la II Edición de los Premios de Excelencia de FP 2023/2024 en el Auditorio Víctor Villegas de Murcia. Enlaces: https://www.carm.es/... y https://www.caixabankdualiza.es/...'),
(3, 'Alumnado del ciclo de FP de Automatización y Robótica visitan la empresa Marnys', '2025-01-29', '\\assets\\img\\robotica.jpg', 'Alumnado y profesorado de 1º y 2º del ciclo de grado superior de Automatización y Robótica visitan la empresa Marnys, especializada en complementos alimenticios, cosmética natural y aceites esenciales. Una experiencia muy interesante en una empresa tecnológica puntera.'),
(4, 'La empresa IMA Ingeniería Mecánica y Automática dona un potente autómata programable al IES Goya', '2025-02-14', '\\assets\\img\\ingenieria.png', 'IMA Ingeniería Mecánica y Automática dona un autómata SIEMENS S7 1500T al Dpto. de Electricidad y Electrónica del IES Goya. Permitirá prácticas avanzadas en el taller de automatización y robótica industrial. Agradecimientos al equipo de IMA y a Isidro Corbalán.'),
(5, 'Alumnos del IES Goya finalistas en el Garage Genious Cup', '2024-11-11', '\\assets\\img\\asmr.jpg', 'Nuestros alumnos quedaron finalistas en el primer campeonato de competencias emprendedoras e innovación “Garage Genious Cup”, celebrado en el CEEIC de Cartagena. Participaron 19 institutos, y los alumnos de 2º de Sistemas Microinformáticos y Redes obtuvieron el segundo puesto.'),
(6, 'VII Encuentro Nacional de Formación Profesional - Región de Murcia', '2025-05-06', 'https://www.llegarasalto.com/wp-content/uploads/2025/05/001-photocall-015-1024x683.webp', 'Hoy, el director del centro y varios profesores de FP han asistido al VII Encuentro Nacional de Formación Profesional de la Región de Murcia, celebrado en Alcantarilla. Una jornada dedicada a la actualización y formación sobre las últimas novedades en el ámbito de la FP. 🎓🤝📚⚙️');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre_apellido` varchar(250) DEFAULT NULL,
  `email_user` varchar(255) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `estatus` varchar(10) DEFAULT NULL,
  `fecha_registro` varchar(50) DEFAULT NULL,
  `fecha_session` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre_apellido`, `email_user`, `password`, `imagen`, `estatus`, `fecha_registro`, `fecha_session`) VALUES
(1, 'Urian', 'dev@gmail.com', '$2y$10$ysOZo2KGH4w/7CnHfnyf1OrlN7JkzMEv7JzFQCsh9ZlksOEvDYuv6', '6593d72014.jpeg', 'Inactiva', '09/09/2023 02:32 pm', '09/09/2023 02:51 pm'),
(2, 'Brenda', 'brenda@gmail.com', '$2y$10$KaytI.EMiwTaOE9pDTVMSeVy7foOKWsQaPBD8r3RU4OY2zml/SyR.', 'f0b0045e42.jpg', 'Inactiva', '09/09/2023 02:52 pm', '09/09/2023 02:53 pm'),
(3, 'Abelardo Perez', 'abelardo@gmail.com', '$2y$10$qil5sHQ8aRAgIxLH54ETUukHTHuWmJwSobFe4hoP6k4URyjEIrOG.', '6f842c4fe3.jpeg', 'Inactiva', '09/09/2023 02:53 pm', '09/09/2023 02:54 pm'),
(4, 'Cristian R.', 'cristian@hotmail.com', '$2y$10$xDZn40SPhfMagbYTsz4MZ.1L7XD.VN5OIcJCZzjrWWnvE5HjWtOci', '45d9649ddf.png', 'Activo', '09/09/2023 02:54 pm', NULL),
(5, 'Roxana D', 'roxana@gmail.com', '$2y$10$kxPmU9mvpCM.KZgKUH0houoIHfD2w.xD2KD5czjjZxo6L53uGBihW', 'da4808ea74.png', 'Activo', '09/09/2023 02:57 pm', NULL),
(6, 'Franco E.', 'franco@gmail.com', '$2y$10$5VLSB3NqFVjCOE.I8ooEY.kV9S1c96zDWDweaXH7RdG15v2p/RAIC', '17d760c7b0.jpeg', 'Activo', '09/09/2023 02:57 pm', NULL),
(7, 'Chica Mala', 'chica@gmail.com', '$2y$10$f6otTzetZ4Two1zcKowYxudasE.rD4CFXmVdn98zR5vHkMVtYNEe2', '2689136cbf.webp', 'Activo', '09/09/2023 02:59 pm', NULL),
(8, 'Deyna Castellano', 'deyna@gmail.com', '$2y$10$iHn2vpc.qc.eYPcE2aWsiOVm9gAyek4NeVZr/Qfvoo31e7JQsNF9S', 'c02d4a11e0.jpg', 'Activo', '09/09/2023 03:00 pm', NULL),
(9, 'Urian V.', 'urian@gmail.com', '$2y$10$Jw1IU3IGpSpMUHmr7jcdUOjc8OH0Mte0SpBUsfgGtm7GP7t2DEMze', '529a73c510.png', 'Activo', '09/09/2023 03:01 pm', NULL),
(10, 'Alejandro', 'alejandro@gmail.com', '$2y$10$wcy3wbX66RMrzcu0hNX04uhvpsvgb0aqluXQvZ1lH2ey/c2wVIWG2', 'fd04247842.png', 'Activo', '02/05/2025 12:32 pm', NULL),
(11, 'Alejandro', 'alejandroalvarado@gmail.com', '$2y$10$B0n38kTVhwMPIzBhnfzWzO5ugxMQaZ3KamdvzCpSfcT7vlUjtVARy', '14ea1ffea7.jpg', 'Activo', '05/05/2025 09:50 am', NULL),
(12, 'Alejandro 2', 'alejandro2@gmail.com', '$2y$10$X0ZbfObc0IjRIvW3dg199eWW2A9BSrmF08jJ9VKi/N9sv.FkcybvS', '1c6a58af4b.jpg', 'Activo', '10/05/2025 06:23 pm', NULL),
(13, 'Pepito Chocolatero', 'pepitochocolate@gmail.com', '$2y$10$kuwths2mh/Lgd9hd3pCMtuThCuIa4xbvYNJGO8.c411ExmRvIUYie', '77cb0af703.jpg', 'Activo', '29/05/2025 12:52 pm', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clickuser`
--
ALTER TABLE `clickuser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_session` (`UserIdSession`),
  ADD KEY `fk_user_clicked` (`clickUser`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_contacto` (`user_id`,`contacto_id`),
  ADD KEY `fk_contacto_contacto` (`contacto_id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`requester_id`,`requested_id`),
  ADD KEY `fk_fr_requested` (`requested_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `grupo_mensajes`
--
ALTER TABLE `grupo_mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `msjs`
--
ALTER TABLE `msjs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_msjs_sender` (`user_id`),
  ADD KEY `fk_msjs_receiver` (`to_id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_user` (`email_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clickuser`
--
ALTER TABLE `clickuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grupo_mensajes`
--
ALTER TABLE `grupo_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `msjs`
--
ALTER TABLE `msjs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clickuser`
--
ALTER TABLE `clickuser`
  ADD CONSTRAINT `fk_user_clicked` FOREIGN KEY (`clickUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_session` FOREIGN KEY (`UserIdSession`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `fk_contacto_contacto` FOREIGN KEY (`contacto_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contacto_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `fk_fr_requested` FOREIGN KEY (`requested_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fr_requester` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupo_mensajes`
--
ALTER TABLE `grupo_mensajes`
  ADD CONSTRAINT `grupo_mensajes_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grupo_mensajes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  ADD CONSTRAINT `grupo_usuarios_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grupo_usuarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `msjs`
--
ALTER TABLE `msjs`
  ADD CONSTRAINT `fk_msjs_receiver` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_msjs_sender` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
