-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 23:29:50
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
  `titulo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagen_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enlace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`id`, `titulo`, `descripcion`, `imagen_url`, `enlace`) VALUES
(1, 'AULA VIRTUAL', 'Accede a la plataforma educativa AULA VIRTUAL', '\\assets\\img\\aulavirtual.png', 'https://aulavirtual.murciaeduca.es/index.php'),
(2, 'MIRADOR XXI', 'Información Académica y seguimiento del alumno', 'assets\\img/plumier.png', 'https://mirador.murciaeduca.es/mirador/'),
(3, 'EDUCARM', 'Accede al portal educativo EDUCARM', 'assets\\img/educarm.png', 'https://www.educarm.es/home'),
(4, 'FP A DISTANCIA', 'Formación Profesional en modalidad online', 'assets\\img/distancia.jpg', 'https://ead.murciaeduca.es/login/index.php'),
(5, 'LLEGARÁS ALTO', 'Campaña regional de orientación y FP', 'assets\\img/llegaras alto.jpg', 'https://aulavirtual.murciaeduca.es/index.php'),
(6, 'AMPA', 'Asociación de madres y padres del alumnado', '\\assets\\img/ampa.png', 'https://iesgoya.com/ampa/'),
(7, 'TRANSPORTE PÚBLICO', 'Horarios y rutas de autobuses escolares', 'assets\\img/transporte publico.jpg', 'https://drive.google.com/drive/folders/1VzyrHD26Ve2dWQY2sjh7dQZ-Yh3SeYDR'),
(8, 'ERASMUS+', 'Información sobre movilidades internacionales', '\\assets\\img/erasmus.jpg', 'https://iesgoya.com/erasmus/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clickuser`
--

CREATE TABLE `clickuser` (
  `id` int(11) NOT NULL,
  `UserIdSession` int(11) DEFAULT NULL,
  `clickUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clickuser`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL,
  `fecha_agregado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contactos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `allDay` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `friend_requests`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creado_por` int(11) NOT NULL,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_mensajes`
--

CREATE TABLE `grupo_mensajes` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `enviado_en` datetime DEFAULT current_timestamp(),
  `archivos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupo_mensajes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuarios`
--

CREATE TABLE `grupo_usuarios` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `agregado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupo_usuarios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `msjs`
--

CREATE TABLE `msjs` (
  `id` int(11) NOT NULL,
  `user` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `to_user` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `nombre_equipo_user` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `leido` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sonido` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `archivos` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `msjs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `imagen_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `nombre_apellido` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `imagen` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `estatus` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha_registro` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha_session` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--


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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `grupo_mensajes`
--
ALTER TABLE `grupo_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `msjs`
--
ALTER TABLE `msjs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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