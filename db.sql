-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2013 a las 10:33:43
-- Versión del servidor: 5.5.31
-- Versión de PHP: 5.4.4-14+deb7u4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `c1_b2pdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigned_roles`
--

CREATE TABLE IF NOT EXISTS `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `assigned_roles`
--

INSERT INTO `assigned_roles` (`id`, `user_id`, `role_id`) VALUES
(5, 9, 1),
(43, 1, 2),
(45, 6, 1),
(47, 10, 0),
(48, 8, 3),
(52, 7, 4),
(57, 5, 3),
(58, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resolucion_id` int(10) unsigned NOT NULL,
  `hoja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `archivo` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `imagenes_resolucion_id_index` (`resolucion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_10_18_095417_create_resoluciones_table', 1),
('2013_10_18_110912_create_tweets_table', 1),
('2013_10_18_141259_create_resolucions_table', 2),
('2013_10_18_142244_create_tipos_table', 3),
('2013_10_21_093027_create_users_table', 4),
('2013_10_23_110120_confide_setup_users_table', 5),
('2013_10_23_130543_entrust_setup_tables', 6),
('2013_10_28_115816_create_persmisions_table', 7),
('2013_11_05_165752_create_tags_table', 8),
('2013_11_05_171144_pivot_resolucion_tag_table', 9),
('2013_11_14_092538_cabinet_setup_uploads_table', 10),
('2013_11_15_123838_create_imagenes_table', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombres`
--

CREATE TABLE IF NOT EXISTS `nombres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` enum('Resolución','Memorándum','Disposición') NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `nombres`
--

INSERT INTO `nombres` (`id`, `documento`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Resolución', 'ADMINISTRADOR', '0000-00-00 00:00:00', '2013-11-13 10:44:24'),
(2, 'Resolución', 'SUBADMINISTRADOR', '0000-00-00 00:00:00', '2013-11-13 10:44:29'),
(3, 'Resolución', 'INGENIERO JEFE', '0000-00-00 00:00:00', '2013-11-13 10:44:33'),
(5, 'Disposición', 'DISPISICIÓN-DIR O JEFE', '2013-11-12 12:53:32', '2013-11-13 10:44:53'),
(6, 'Memorándum', 'MEMO DIR O JEFE', '2013-11-12 12:53:45', '2013-11-13 10:44:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=74 ;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'restablecerbuscador', 'Restablecer buscador', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(2, 'resolucions.index', 'Resoluciones Index', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(3, 'resolucions.create', 'Agregar Resoluciones (Create)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(4, 'resolucions.store', 'Agregar Resoluciones (Store)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(5, 'resolucions.show', 'Detalle Resoluciones', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(6, 'resolucions.edit', 'Editar Resoluciones (Edit)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(7, 'resolucions.update', 'Editar Resoluciones (Update)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(8, 'resolucions/{resolucions}', 'Editar Resoluciones (PATCH)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(9, 'resolucions.destroy', 'Eliminar Resoluciones', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(10, 'tipos.index', 'Tipos Index', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(11, 'tipos.create', 'Agregar Tipos (Create)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(12, 'tipos.store', 'Agregar Tipos (Store)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(13, 'tipos.show', 'Detalle Tipos', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(14, 'tipos.edit', 'Editar Tipos (Edit)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(15, 'tipos.update', 'Editar Tipos (Update)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(16, 'tipos/{tipos}', 'Editar Tipos (PATCH)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(17, 'tipos.destroy', 'Eliminar Tipos', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(18, 'roles.index', 'Roles Index', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(19, 'roles.create', 'Agregar Roles (Create)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(20, 'roles.store', 'Agregar Roles (Store)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(21, 'roles.show', 'Detalle Roles', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(22, 'roles.edit', 'Editar Roles (Edit)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(23, 'roles.update', 'Editar Roles (Update)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(24, 'roles/{roles}', 'Editar Roles (PATCH)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(25, 'roles.destroy', 'Eliminar Roles', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(26, 'permissions.index', 'Permisos Index', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(27, 'permissions.create', 'Agregar Permisos (Create)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(28, 'permissions.store', 'Agregar Permisos (Update)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(29, 'permissions.show', 'Detalle Permisos', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(30, 'permissions.edit', 'Editar Permisos (Edit)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(31, 'permissions.update', 'Editar Permisos (Update)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(32, 'permissions/{permissions}', 'Editar Permisos (PATCH)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(33, 'permissions.destroy', 'Eliminar Permisos', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(34, 'users', 'Usuarios Index', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(35, 'user/index', 'Usuarios Index', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(36, 'user/create', 'Agregar Usuarios (Create)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(37, 'user', 'Agregar Usuarios (Store)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(38, 'user/login', 'LOGIN (PUBLICO)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(39, 'user/login', 'LOGIN (PUBLICO) (CHECK)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(40, 'user/forgot_password', 'Olvido contraseña', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(41, 'user/forgot_password', 'Olvido contraseña (POST)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(42, 'user/reset_password/{token}', 'Reset Contraseña (GET)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(43, 'user/reset_password', 'Reset Contraseña (POST)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(44, 'user/edit/{id}', 'Editar Usuario (Edit)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(45, 'user/edit/{id}', 'Editar Usuario (Update)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(46, 'user/logout', 'LOGOUT (PUBLICO)', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(47, 'user/confirm/{code}', 'Confirmación del Usuario', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(48, 'user/reset/{token}', 'Reset Contraseña', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(49, 'init', 'Init', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(50, 'resetpermisos', 'Resetpermisos', '2013-10-30 13:33:31', '2013-10-30 13:33:31'),
(51, 'users/index/{v1}/{v2}/{v3}/{v4}/{v5}', 'Usuarios Index', '2013-10-30 03:00:00', '2013-10-30 03:00:00'),
(52, 'users/habilitar/{v1}/{v2}/{v3}/{v4}/{v5}', 'Habilitar Usuario', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'descarga/{archivo}/{nombrearch}', 'Descargar Archivo', '2013-11-06 09:29:15', '2013-11-06 09:29:15'),
(54, 'users/nombres/{v1}/{v2}/{v3}/{v4}/{v5}', 'Nombres', '2013-11-06 09:29:15', '2013-11-06 09:29:15'),
(55, 'users/{_missing}', 'get|post|put|patch|delete users/{_missing}', '2013-11-06 09:29:15', '2013-11-06 09:29:15'),
(56, 'build_acl', 'get build_acl', '2013-11-06 09:29:15', '2013-11-06 09:29:15'),
(57, 'tags.index', 'Tags index', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(58, 'tags.create', 'Nuevo Tag (Create)', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(59, 'tags.store', 'Nuevo Tag (Store)', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(60, 'tags.show', 'Detalle Tag', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(61, 'tags.edit', 'Editar Tag (Edit)', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(62, 'tags.update', 'Editar Tag (Update)', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(63, 'tags/{tags}', 'Editar Tag (PATCH)', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(64, 'tags.destroy', 'Eliminar Tag', '2013-11-06 09:30:33', '2013-11-06 09:30:33'),
(65, 'nombres.index', 'Nombres Index', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(66, 'nombres.create', 'Nuevo Nombre (CREATE)', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(67, 'nombres.store', 'Nuevo Nombre (Store)', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(68, 'nombres.show', 'Detalle Nombre', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(69, 'nombres.edit', 'Editar Nombre (Edit)', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(70, 'nombres.update', 'Editar Nombre (Update)', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(71, 'nombres/{nombres}', 'Editar Nombre (PATCH)', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(72, 'nombres.destroy', 'Eliminar Nombre', '2013-11-12 14:39:15', '2013-11-12 14:39:15'),
(73, 'users/tags/{v1}/{v2}/{v3}/{v4}/{v5}', 'Tags index', '2013-11-12 14:39:15', '2013-11-12 14:39:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=335 ;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(115, 26, 4),
(116, 27, 4),
(117, 28, 4),
(118, 29, 4),
(119, 30, 4),
(120, 31, 4),
(121, 32, 4),
(122, 33, 4),
(140, 49, 4),
(141, 50, 4),
(153, 1, 4),
(154, 1, 2),
(155, 1, 1),
(156, 1, 6),
(157, 1, 3),
(158, 2, 4),
(159, 2, 2),
(160, 2, 1),
(161, 2, 6),
(162, 2, 3),
(163, 3, 4),
(164, 3, 6),
(165, 3, 3),
(166, 4, 4),
(167, 4, 6),
(168, 4, 3),
(172, 6, 4),
(173, 6, 6),
(174, 6, 3),
(175, 7, 4),
(176, 7, 6),
(177, 7, 3),
(178, 8, 4),
(179, 8, 6),
(180, 8, 3),
(181, 9, 4),
(182, 9, 6),
(183, 10, 4),
(184, 10, 6),
(185, 10, 3),
(186, 11, 4),
(187, 11, 6),
(188, 11, 3),
(189, 12, 4),
(190, 12, 6),
(191, 12, 3),
(192, 13, 4),
(193, 13, 6),
(194, 13, 3),
(195, 14, 4),
(196, 14, 6),
(197, 14, 3),
(198, 15, 4),
(199, 15, 6),
(200, 15, 3),
(201, 16, 4),
(202, 16, 6),
(203, 16, 3),
(204, 17, 4),
(205, 17, 6),
(222, 18, 4),
(223, 19, 4),
(224, 20, 4),
(225, 21, 4),
(226, 22, 4),
(227, 23, 4),
(228, 24, 4),
(229, 25, 4),
(230, 34, 4),
(231, 34, 6),
(232, 35, 4),
(233, 35, 6),
(234, 36, 4),
(235, 36, 6),
(236, 37, 4),
(237, 37, 6),
(238, 38, 4),
(239, 38, 6),
(240, 39, 4),
(241, 39, 6),
(242, 40, 4),
(243, 40, 6),
(244, 41, 4),
(245, 41, 6),
(246, 42, 4),
(247, 42, 6),
(248, 43, 4),
(249, 43, 6),
(250, 44, 4),
(251, 44, 6),
(252, 45, 4),
(253, 45, 6),
(254, 46, 4),
(255, 46, 6),
(256, 47, 4),
(257, 47, 6),
(258, 48, 4),
(259, 48, 6),
(260, 51, 4),
(261, 51, 6),
(262, 52, 4),
(263, 52, 6),
(264, 53, 4),
(265, 53, 2),
(266, 53, 1),
(267, 53, 6),
(268, 53, 3),
(269, 54, 4),
(270, 54, 2),
(271, 54, 1),
(272, 54, 6),
(273, 54, 3),
(274, 56, 4),
(275, 57, 4),
(276, 57, 2),
(277, 57, 1),
(278, 57, 6),
(279, 57, 3),
(280, 58, 4),
(281, 58, 6),
(282, 58, 3),
(283, 59, 4),
(284, 59, 6),
(285, 59, 3),
(294, 60, 4),
(295, 60, 6),
(296, 60, 3),
(297, 61, 4),
(298, 61, 6),
(299, 61, 3),
(300, 62, 4),
(301, 62, 6),
(302, 62, 3),
(303, 63, 4),
(304, 63, 6),
(305, 63, 3),
(306, 64, 4),
(307, 64, 6),
(308, 65, 4),
(309, 65, 6),
(310, 66, 4),
(311, 66, 6),
(314, 68, 4),
(315, 68, 6),
(316, 69, 4),
(317, 69, 6),
(318, 70, 4),
(319, 70, 6),
(320, 67, 4),
(321, 67, 6),
(322, 71, 4),
(323, 71, 6),
(324, 72, 4),
(325, 72, 6),
(326, 73, 4),
(327, 73, 2),
(328, 73, 1),
(329, 73, 6),
(330, 73, 3),
(331, 5, 4),
(332, 5, 2),
(333, 5, 6),
(334, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persmisions`
--

CREATE TABLE IF NOT EXISTS `persmisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resolucions`
--

CREATE TABLE IF NOT EXISTS `resolucions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `documento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iniciales` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `resuelve` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `archivo` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

--
-- Volcado de datos para la tabla `resolucions`
--

INSERT INTO `resolucions` (`id`, `numero`, `documento`, `iniciales`, `tipo_id`, `fecha`, `resuelve`, `observaciones`, `archivo`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Resolución', 'gmc', 1, '2013-10-18', 'ADMINISTRADOR', 'Observaciones', 'uploads/2013/10/201310220230171.pdf', 4, '2013-10-19 00:01:54', '2013-11-13 13:46:34'),
(2, 2, 'Disposición', 'gmc', 1, '2013-10-20', 'SUBADMINISTRADOR', 'Observaciones 2', 'uploads/2013/10/201310220230001.pdf', 4, '2013-10-19 00:39:50', '2013-10-22 17:30:01'),
(3, 3, 'Resolución', 'gmc', 1, '2013-10-18', 'ADMINISTRADOR', 'Observaciones 444', 'uploads/2013/10/201310221103191.pdf', 6, '2013-10-19 00:41:57', '2013-10-22 14:03:40'),
(5, 5, 'Resolución', 'gmc', 2, '2013-10-29', 'ADMINISTRADOR', 'Observaciones!', 'uploads/2013/10/201310210921331.pdf', 4, '2013-10-21 12:21:33', '2013-10-29 15:31:37'),
(20, 53465, 'Resolución', 'gmc', 4, '2013-10-31', 'SUBADMINISTRADOR', 'Descripción de la resolución', 'uploads/2013/10/201311050503151.pdf', 7, '2013-10-31 15:11:46', '2013-11-06 15:29:16'),
(21, 15947, 'Resolución', 'gar', 2, '2013-11-15', 'SUBADMINISTRADOR', 'Descripcion', 'uploads/2013/11/201311061054007.pdf', 7, '2013-11-06 13:54:00', '2013-11-13 13:46:27'),
(22, 15947, 'Memorándum', 'gar', 2, '2013-11-15', 'MEMO DIR O JEFE', 'Descripcion', 'uploads/2014/11/201311061057537.pdf', 7, '2013-11-06 13:57:53', '2013-11-13 13:50:34'),
(23, 15975, 'Resolución', 'gar', 2, '2013-11-07', 'SUBADMINISTRADOR', 'Descripción', 'uploads/2013/11/201311061118537.pdf', 7, '2013-11-06 14:18:53', '2013-11-13 13:46:20'),
(24, 15574, 'Disposición', 'gar', 2, '2013-11-06', 'DISPISICIÓN-DIR O JEFE', 'DDsda asd asd ', 'uploads/2013/11/201311061119537.pdf', 7, '2013-11-06 14:19:53', '2013-11-13 13:46:07'),
(25, 12379, 'Resolución', 'gar', 1, '2013-11-06', 'ADMINISTRADOR', 'Descripcion', 'uploads/2013/11/201311061121327.pdf', 7, '2013-11-06 14:21:32', '2013-11-13 13:45:52'),
(26, 25479, 'Resolución', 'gar', 2, '2013-11-06', 'ADMINISTRADOR', 'Desc', 'uploads/2013/11/201311061124317.pdf', 7, '2013-11-06 14:24:31', '2013-11-06 14:24:31'),
(27, 254793, 'Resolución', 'gar', 2, '2013-11-06', 'ADMINISTRADOR', 'Desc', 'uploads/2013/11/201311061125067.pdf', 7, '2013-11-06 14:25:06', '2013-11-06 14:25:06'),
(28, 7593, 'Resolución', 'gar', 1, '2013-11-06', 'INGENIERO JEFE', 'fhfglsk sdi dfs', 'uploads/2013/11/201311061129047.pdf', 7, '2013-11-06 14:29:04', '2013-11-06 14:29:04'),
(29, 98462, 'Resolución', 'gar', 1, '2013-11-06', 'ADMINISTRADOR', 'Descripcion', 'uploads/2013/11/201311061132127.pdf', 7, '2013-11-06 14:32:12', '2013-11-06 14:32:12'),
(30, 95426, 'Resolución', 'gar', 3, '2013-11-06', 'ADMINISTRADOR', 'Descripcion', 'uploads/2013/11/201311061152057.pdf', 7, '2013-11-06 14:52:05', '2013-11-06 14:52:05'),
(31, 9524, 'Resolución', 'gar', 1, '2013-11-06', 'SUBADMINISTRADOR', 'Descisdf sdf df', 'uploads/2013/11/201311061217057.pdf', 7, '2013-11-06 15:17:05', '2013-11-06 15:17:05'),
(32, 6571, 'Resolución', 'gar', 4, '2013-11-07', 'ADMINISTRADOR', 'Descripcion', 'uploads/2013/11/201311070759537.pdf', 7, '2013-11-07 10:59:53', '2013-11-07 10:59:53'),
(44, 954602, 'Resolución', 'gar', 2, '2013-11-18', 'SUBADMINISTRADOR', 'y', 'uploads/2013/11/201311181104117.pdf', 7, '2013-11-18 10:49:43', '2013-11-18 14:04:11'),
(45, 954302, 'Resolución', 'gar', 2, '2013-11-18', 'SUBADMINISTRADOR', 'y', 'uploads/2013/11/20131118110244_7.pdf', 7, '2013-11-18 11:00:11', '2013-11-18 14:02:44'),
(52, 325398, 'Resolución', 'gar', 2, '2013-11-18', 'SUBADMINISTRADOR', 'y', 'uploads/2013/11/20131118082923_7.pdf', 7, '2013-11-18 11:29:19', '2013-11-18 11:29:19'),
(53, 48254, 'Disposición', 'gar', 2, '2013-11-18', 'DISPISICIÓN-DIR O JEFE', '53', 'uploads/2013/11/201311181120027.pdf', 7, '2013-11-18 14:20:02', '2013-11-18 14:20:02'),
(54, 34567, 'Disposición', 'gar', 2, '2013-11-18', 'DISPISICIÓN-DIR O JEFE', 'sdg', 'uploads/2013/11/20131118112034_7.pdf', 7, '2013-11-18 14:20:30', '2013-11-18 14:20:30'),
(55, 456546, 'Memorándum', 'gar', 1, '2013-11-18', 'MEMO DIR O JEFE', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'uploads/2013/11/20131118115103_7.pdf', 7, '2013-11-18 14:50:56', '2013-11-19 11:22:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resolucion_tag`
--

CREATE TABLE IF NOT EXISTS `resolucion_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resolucion_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resolucion_tag_resolucion_id_index` (`resolucion_id`),
  KEY `resolucion_tag_tag_id_index` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `resolucion_tag`
--

INSERT INTO `resolucion_tag` (`id`, `resolucion_id`, `tag_id`) VALUES
(7, 27, 1),
(11, 29, 1),
(12, 29, 6),
(17, 20, 6),
(18, 30, 2),
(19, 30, 6),
(22, 32, 2),
(23, 32, 6),
(24, 28, 2),
(25, 28, 6),
(37, 25, 1),
(40, 24, 2),
(41, 24, 6),
(42, 23, 4),
(45, 22, 2),
(46, 22, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Inivitado', '', '2013-10-24 12:34:12', '2013-10-24 12:34:12'),
(2, 'Consultas', '', '2013-10-24 12:34:12', '2013-10-24 12:34:12'),
(3, 'Usuarios', '', '2013-10-24 12:34:12', '2013-10-24 12:34:12'),
(4, 'Administrador', '', '2013-10-24 12:34:12', '2013-10-24 12:34:12'),
(6, 'Jefe - Director', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Departamento Administrativo', '2013-11-06 09:57:04', '2013-11-06 09:57:19'),
(2, 'RRHH', '2013-11-06 10:03:00', '2013-11-06 10:03:00'),
(4, 'Nuevotag', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Nuevotag2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Tag4', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Viático', '2013-10-18 17:44:54', '2013-10-18 17:44:54'),
(2, 'Tipo 2', '2013-10-25 18:13:11', '2013-10-25 18:13:11'),
(3, 'Tipo 6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Campaña', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_y_apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nombre_y_apellido`, `confirmation_code`, `confirmed`, `created_at`, `updated_at`) VALUES
(1, 'consultas', 'guillerohde@msn.com', '$2y$08$LdhEGpFSRqQ5ER497mnT/.fO.erShEEBG.arAXfp/26Se8GLzmXQu', 'Consultor', '4781dca095bec70c6ace13822bf62566', 1, '2013-10-23 15:01:53', '2013-11-04 11:50:07'),
(4, 'director', 'guillerohde@gmail.com', '$2y$08$2yzmEU3tYp6Kew9ZqN0ck.BYQbSgTIFHRjiZOkbBkg3s4RaIIKTzm', 'Guillermo Adolfo Rohde', '7e21ab1b69322e2738cf61e117c00fd7', 1, '2013-10-23 15:38:54', '2013-11-04 14:35:34'),
(5, 'usuario', 'usuario@uno.com', '$2y$08$cSIRq6P/47FwMMd1dnjW3OHJ9uOV3HOf9ofMp2y.dIQGu..750pl.', 'Juan Perez', '57f6682cc4be500aaa9ca4871920adfa', 1, '2013-10-25 12:08:54', '2013-11-04 11:51:13'),
(6, 'invitado', 'usuario@dos.com', '$2y$08$V//CN36dV4XDe73A6FCH2ud9zMPjuJyY9XrA6mdG87CIFejnsS2R.', 'Esteban Quito', 'ef19f479d17c607164bd737f333d1546', 1, '2013-10-25 12:09:38', '2013-11-04 11:51:37'),
(7, 'admin', 'usuario@tres.com', '$2y$08$bWvTKwzAI.KVnKm4ysS8Wu7IjWZb3K/mB.q80IIYaIkMk3OxFqHsi', 'Guillermo Rohde', 'e25c757a39e9e27e5c752a5e0c7590cf', 1, '2013-10-25 12:12:13', '2013-11-04 11:51:54'),
(8, 'usuario4', 'usuario@cuatro.com', '$2y$08$2xFQ9D28LUY69AhMRwd6eeqesvjh051svABmF.oGusza4E0xFYEXq', 'Natalia Natalia', '387fd239f70317f6f99eb8b5d43911dc', 1, '2013-10-28 16:58:15', '2013-10-28 16:58:15'),
(10, 'test', 'test@test.com', '$2y$08$ujhf/0YNRra1O./hzRH8web9BCI/r54h1ddwS/RWJdxXTsS1cIqZu', 'test', '659b71083706731a2f8e4172b269e516', 0, '2013-10-31 14:20:09', '2013-10-31 14:20:09');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `resolucion_tag`
--
ALTER TABLE `resolucion_tag`
  ADD CONSTRAINT `resolucion_tag_resolucion_id_foreign` FOREIGN KEY (`resolucion_id`) REFERENCES `resolucions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resolucion_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
