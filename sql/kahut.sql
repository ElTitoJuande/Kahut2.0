-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2024 a las 04:46:18
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
-- Base de datos: `kahut`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `cod` int(11) NOT NULL,
  `enunciado` varchar(500) NOT NULL,
  `opcion_a` varchar(100) NOT NULL,
  `opcion_b` varchar(100) NOT NULL,
  `opcion_c` varchar(100) NOT NULL,
  `opcion_d` varchar(100) NOT NULL,
  `respuesta_correcta` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`cod`, `enunciado`, `opcion_a`, `opcion_b`, `opcion_c`, `opcion_d`, `respuesta_correcta`) VALUES
(1, '¿Qué selección ganó la Copa Mundial de la FIFA 2018?', 'Alemania', 'Brasil', 'Francia', 'Argentina', 'C'),
(2, '¿Quién es el máximo goleador en la historia de la Champions League?', 'Cristiano Ronaldo', 'Lionel Messi', 'Robert Lewandowski', 'Karim Benzema', 'A'),
(3, '¿En qué año se jugó el primer Mundial de fútbol?', '1928', '1930', '1934', '1938', 'B'),
(4, '¿Qué país ha ganado más Copas del Mundo?', 'Brasil', 'Italia', 'Alemania', 'Argentina', 'A'),
(5, '¿Quién marcó el famoso gol conocido como \"La Mano de Dios\"?', 'Pelé', 'Diego Maradona', 'Zinedine Zidane', 'Johan Cruyff', 'B'),
(6, '¿Qué jugador ganó el Balón de Oro en 2022?', 'Karim Benzema', 'Lionel Messi', 'Cristiano Ronaldo', 'Luka Modric', 'A'),
(7, '¿Qué equipo tiene más títulos de la Premier League?', 'Manchester United', 'Liverpool', 'Chelsea', 'Arsenal', 'A'),
(8, '¿Quién marcó el gol más rápido en la historia de los Mundiales?', 'Cristiano Ronaldo', 'Hakan Şükür', 'Pelé', 'Miroslav Klose', 'B'),
(9, '¿En qué país se jugará el Mundial de la FIFA 2026?', 'Canadá', 'Estados Unidos', 'México', 'Todos los anteriores', 'D'),
(10, '¿Qué equipo ganó la primera edición de la Copa Libertadores?', 'Peñarol', 'River Plate', 'Santos', 'Boca Juniors', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsu` varchar(50) NOT NULL,
  `tInicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `tFin` timestamp NULL DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreUsu`, `tInicio`, `tFin`, `puntaje`) VALUES
(1, 'Juande1', '2024-12-13 19:23:04', '2024-12-13 19:23:20', 4),
(2, 'Juande2', '2024-12-13 19:23:35', '2024-12-13 19:23:49', 4),
(4, 'Juande4', '2024-12-14 16:52:57', NULL, NULL),
(5, 'Juande4', '2024-12-14 16:52:58', NULL, NULL),
(6, 'Juande5', '2024-12-14 16:55:36', NULL, NULL),
(7, 'Juande7', '2024-12-14 17:00:05', '2024-12-14 17:00:16', 5),
(8, 'Juande8', '2024-12-14 17:00:28', '2024-12-14 17:00:42', 5),
(9, 'Fernando trujillo', '2024-12-14 17:14:52', '2024-12-14 17:15:59', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
