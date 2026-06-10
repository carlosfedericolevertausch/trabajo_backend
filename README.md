# trabajo_backend
Trabajo colaborativo desarrollo backend grupo 1


-- Base de datos: `trabajo_backend`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL,
  `nombre_rol` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE IF NOT EXISTS `tareas` (
  `id_tarea` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb3_spanish_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_limite` date NOT NULL,
  `id_usuario_asignado` int NOT NULL,
  PRIMARY KEY (`id_tarea`),
  KEY `id_usuario_asignado` (`id_usuario_asignado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `titulo`, `descripcion`, `estado`, `fecha_creacion`, `fecha_limite`, `id_usuario_asignado`) VALUES
(1, 'Tarea de prueba', 'Texto de Tarea de prueba', 'Pendiente', '2026-06-10', '2026-06-10', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `id_rol`) VALUES
(1, 'Administrador', 'admin@cenco.cl', '123456', 1),
(2, 'carlos', 'carlos@carlos.cl', 'carlos', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_usuario_asignado`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;
