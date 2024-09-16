-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 déc. 2023 à 12:58
-- Version du serveur : 5.7.26
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_appcsm`
--

-- --------------------------------------------------------

--
-- Structure de la table `csm_action_acces`
--

DROP TABLE IF EXISTS `csm_action_acces`;
CREATE TABLE IF NOT EXISTS `csm_action_acces` (
  `id_action` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `libelle_action` varchar(255) DEFAULT NULL,
  `dev_action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_action`),
  KEY `matierefp_action_acces_id_menu_foreign` (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `csm_action_acces`
--

INSERT INTO `csm_action_acces` (`id_action`, `id_menu`, `libelle_action`, `dev_action`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ajouter un menu', 'add_menu', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(2, 3, 'Modifier un menu', 'update_menu', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(3, 3, 'Supprimer un menu', 'delete_menu', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(4, 3, 'Ajouter une action', 'add_action', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(5, 3, 'Supprimer une action', 'delete_action', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(6, 4, 'Ajouter un rôle', 'add_role', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(7, 4, 'Modifier un rôle', 'update_role', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(8, 4, 'Supprimer un rôle', 'delete_role', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(9, 5, 'Ajouter un utilisateur', 'add_user', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(10, 5, 'Modifier un utilisateur', 'update_user', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(11, 5, 'Supprimer un utilisateur', 'delete_user', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(12, 5, 'Réinitialiser un mot de passe', 'reinitialiser_mdp', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(24, 6, 'Exporter trace', 'exporter_trace', '2022-07-20 13:43:03', '2022-07-20 13:43:03'),
(23, 5, 'testet', 'testet', '2022-07-20 09:03:18', '2022-07-20 09:03:18'),
(170, 19, 'Accéder à la colonne Initiateur', 'init_giwu', '2022-10-28 13:13:55', '2022-10-28 13:13:55'),
(210, 19, 'Accéder à la liste des entités dans les critères de recherche', 'combo_entite', '2022-12-11 04:21:17', '2022-12-11 04:21:17'),
(263, 172, 'Ajouter une direction', 'add_direction', '2023-10-18 15:27:00', '2023-10-18 15:27:00'),
(264, 172, 'Modifier une direction', 'update_direction', '2023-10-18 15:27:00', '2023-10-18 15:27:00'),
(265, 172, 'Supprimer une direction', 'delete_direction', '2023-10-18 15:27:00', '2023-10-18 15:27:00'),
(266, 172, 'Exporter direction', 'exporter_direction', '2023-10-18 15:27:00', '2023-10-18 15:27:00'),
(267, 175, 'Ajouter un service', 'add_service', '2023-10-18 18:53:30', '2023-10-18 18:53:30'),
(268, 175, 'Modifier un service', 'update_service', '2023-10-18 18:53:30', '2023-10-18 18:53:30'),
(269, 175, 'Supprimer un service', 'delete_service', '2023-10-18 18:53:30', '2023-10-18 18:53:30'),
(270, 175, 'Exporter service', 'exporter_service', '2023-10-18 18:53:30', '2023-10-18 18:53:30'),
(271, 178, 'Ajouter une division', 'add_division', '2023-10-18 19:33:14', '2023-10-18 19:33:14'),
(272, 178, 'Modifier une division', 'update_division', '2023-10-18 19:33:14', '2023-10-18 19:33:14'),
(273, 178, 'Supprimer une division', 'delete_division', '2023-10-18 19:33:14', '2023-10-18 19:33:14'),
(274, 178, 'Exporter division', 'exporter_division', '2023-10-18 19:33:14', '2023-10-18 19:33:14'),
(275, 182, 'Ajouter un expediteur', 'add_expediteur', '2023-10-19 08:48:55', '2023-10-19 08:48:55'),
(276, 182, 'Modifier un expediteur', 'update_expediteur', '2023-10-19 08:48:55', '2023-10-19 08:48:55'),
(277, 182, 'Supprimer un expediteur', 'delete_expediteur', '2023-10-19 08:48:55', '2023-10-19 08:48:55'),
(278, 182, 'Exporter expediteur', 'exporter_expediteur', '2023-10-19 08:48:55', '2023-10-19 08:48:55'),
(279, 185, 'Ajouter courrier', 'add_courrier', '2023-10-19 11:39:52', '2023-10-19 11:39:52'),
(280, 185, 'Modifier courrier', 'update_courrier', '2023-10-19 11:39:52', '2023-10-19 11:39:52'),
(281, 185, 'Supprimer courrier', 'delete_courrier', '2023-10-19 11:39:52', '2023-10-19 11:39:52'),
(282, 185, 'Exporter courrier', 'exporter_courrier', '2023-10-19 11:39:52', '2023-10-19 11:39:52'),
(283, 188, 'Exporter listcourrieratraiter', 'exporter_listcourrieratraiter', '2023-10-20 07:34:27', '2023-10-20 07:34:27'),
(284, 185, 'Consulter le courrier', 'consult_courrier', '2023-10-20 09:16:04', '2023-10-20 09:16:04'),
(285, 185, 'Transférer courrier', 'transfert_courrier', '2023-10-20 09:16:37', '2023-10-20 09:16:37'),
(288, 188, 'Consulter courrier', 'Consult_courriertraiter', '2023-10-20 09:18:21', '2023-10-20 09:18:21'),
(287, 188, 'Transférer courrier', 'transfert_courriertraiter', '2023-10-20 09:17:45', '2023-10-20 09:17:45'),
(289, 188, 'Traiter courrier', 'traiter_courriertraiter', '2023-10-20 12:52:43', '2023-10-20 12:52:43'),
(290, 188, 'Rejeter Courrier', 'rejet_courriertraiter', '2023-10-20 12:54:24', '2023-10-20 12:54:24'),
(291, 190, 'Ajouter courriersortant', 'add_courriersortant', '2023-10-21 09:36:30', '2023-10-21 09:36:30'),
(292, 190, 'Modifier courriersortant', 'update_courriersortant', '2023-10-21 09:36:30', '2023-10-21 09:36:30'),
(293, 190, 'Supprimer courriersortant', 'delete_courriersortant', '2023-10-21 09:36:30', '2023-10-21 09:36:30'),
(294, 190, 'Exporter courriersortant', 'exporter_courriersortant', '2023-10-21 09:36:30', '2023-10-21 09:36:30'),
(295, 194, 'Ajouter archive', 'add_archive', '2023-10-21 15:39:55', '2023-10-21 15:39:55'),
(296, 194, 'Modifier archive', 'update_archive', '2023-10-21 15:39:55', '2023-10-21 15:39:55'),
(297, 194, 'Supprimer archive', 'delete_archive', '2023-10-21 15:39:55', '2023-10-21 15:39:55'),
(298, 194, 'Exporter archive', 'exporter_archive', '2023-10-21 15:39:55', '2023-10-21 15:39:55'),
(299, 198, 'Ajouter carriere', 'add_carriere', '2023-10-21 20:00:42', '2023-10-21 20:00:42'),
(300, 198, 'Modifier carriere', 'update_carriere', '2023-10-21 20:00:42', '2023-10-21 20:00:42'),
(301, 198, 'Supprimer carriere', 'delete_carriere', '2023-10-21 20:00:42', '2023-10-21 20:00:42'),
(302, 198, 'Exporter carriere', 'exporter_carriere', '2023-10-21 20:00:42', '2023-10-21 20:00:42'),
(303, 202, 'Exporter listretraite', 'exporter_listretraite', '2023-10-24 13:44:01', '2023-10-24 13:44:01');

-- --------------------------------------------------------

--
-- Structure de la table `csm_action_menu_acces`
--

DROP TABLE IF EXISTS `csm_action_menu_acces`;
CREATE TABLE IF NOT EXISTS `csm_action_menu_acces` (
  `id_actionmenu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `statut_action` bigint(20) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_actionmenu`),
  KEY `emp_action_menu_acces_id_menu_foreign` (`id_menu`),
  KEY `emp_action_menu_acces_action_id_foreign` (`action_id`),
  KEY `emp_action_menu_acces_role_id_foreign` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1139 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `csm_action_menu_acces`
--

INSERT INTO `csm_action_menu_acces` (`id_actionmenu`, `id_menu`, `action_id`, `statut_action`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 1, '2022-06-20 14:10:01', '2023-10-21 19:02:14'),
(2, 3, 2, 1, 1, '2022-06-20 14:10:01', '2023-10-21 19:02:14'),
(3, 3, 3, 1, 1, '2022-06-20 14:10:01', '2023-10-21 19:02:14'),
(4, 3, 4, 1, 1, '2022-06-20 14:10:01', '2023-10-21 19:02:14'),
(5, 3, 5, 1, 1, '2022-06-20 14:10:01', '2023-10-21 19:02:14'),
(6, 4, 6, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(7, 4, 7, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(8, 4, 8, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(9, 5, 9, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(10, 5, 10, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(11, 5, 11, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(12, 5, 12, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(31, 5, 23, 1, 1, '2022-07-20 09:03:18', '2022-07-22 21:47:14'),
(59, 6, 24, 1, 1, '2022-07-20 13:43:03', '2022-07-22 21:47:14'),
(335, 19, 170, 1, 1, '2022-10-28 13:13:55', '2022-10-28 13:13:55'),
(398, 19, 210, 1, 1, '2022-12-11 04:21:17', '2022-12-11 04:21:17'),
(986, 172, 263, 1, 1, '2023-10-18 14:29:33', '2023-10-18 14:29:33'),
(987, 172, 264, 1, 1, '2023-10-18 14:29:33', '2023-10-18 14:29:33'),
(988, 172, 265, 1, 1, '2023-10-18 14:29:33', '2023-10-18 14:29:33'),
(989, 172, 266, 1, 1, '2023-10-18 14:29:33', '2023-10-18 14:29:33'),
(990, 3, 1, 0, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(991, 3, 2, 0, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(992, 3, 3, 0, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(993, 3, 4, 0, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(994, 3, 5, 0, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(995, 4, 6, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(996, 4, 7, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(997, 4, 8, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(998, 5, 9, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(999, 5, 10, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1000, 5, 11, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1001, 5, 12, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1002, 6, 24, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1003, 5, 23, 0, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1004, 19, 170, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1005, 19, 210, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1006, 172, 263, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1007, 172, 264, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1008, 172, 265, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1009, 172, 266, 1, 15, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1010, 175, 267, 1, 1, '2023-10-18 17:56:43', '2023-10-18 17:56:43'),
(1011, 175, 268, 1, 1, '2023-10-18 17:56:43', '2023-10-18 17:56:43'),
(1012, 175, 269, 1, 1, '2023-10-18 17:56:43', '2023-10-18 17:56:43'),
(1013, 175, 270, 1, 1, '2023-10-18 17:56:43', '2023-10-18 17:56:43'),
(1014, 178, 271, 1, 1, '2023-10-18 18:35:07', '2023-10-18 18:35:07'),
(1015, 178, 272, 1, 1, '2023-10-18 18:35:07', '2023-10-18 18:35:07'),
(1016, 178, 273, 1, 1, '2023-10-18 18:35:07', '2023-10-18 18:35:07'),
(1017, 178, 274, 1, 1, '2023-10-18 18:35:07', '2023-10-18 18:35:07'),
(1018, 182, 275, 1, 1, '2023-10-19 09:00:58', '2023-10-19 09:00:58'),
(1019, 182, 276, 1, 1, '2023-10-19 09:00:58', '2023-10-19 09:00:58'),
(1020, 182, 277, 1, 1, '2023-10-19 09:00:58', '2023-10-19 09:00:58'),
(1021, 182, 278, 1, 1, '2023-10-19 09:00:58', '2023-10-19 09:00:58'),
(1022, 185, 279, 1, 1, '2023-10-19 11:09:04', '2023-10-19 11:09:04'),
(1023, 185, 280, 1, 1, '2023-10-19 11:09:04', '2023-10-19 11:09:04'),
(1024, 185, 281, 1, 1, '2023-10-19 11:09:04', '2023-10-19 11:09:04'),
(1025, 185, 282, 1, 1, '2023-10-19 11:09:04', '2023-10-19 11:09:04'),
(1026, 175, 267, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1027, 175, 268, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1028, 175, 269, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1029, 175, 270, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1030, 178, 271, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1031, 178, 272, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1032, 178, 273, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1033, 178, 274, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1034, 182, 275, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1035, 182, 276, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1036, 182, 277, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1037, 182, 278, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1038, 185, 279, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1039, 185, 280, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1040, 185, 281, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1041, 185, 282, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1042, 188, 283, 1, 15, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1043, 185, 284, 1, 1, '2023-10-20 09:16:04', '2023-10-20 09:16:04'),
(1044, 185, 284, 1, 15, '2023-10-20 09:16:04', '2023-10-20 09:18:50'),
(1045, 185, 285, 1, 1, '2023-10-20 09:16:37', '2023-10-20 09:16:37'),
(1046, 185, 285, 1, 15, '2023-10-20 09:16:37', '2023-10-20 09:18:50'),
(1052, 188, 288, 1, 15, '2023-10-20 09:18:21', '2023-10-20 09:18:50'),
(1051, 188, 288, 1, 1, '2023-10-20 09:18:21', '2023-10-20 09:18:21'),
(1049, 188, 287, 1, 1, '2023-10-20 09:17:45', '2023-10-20 09:17:45'),
(1050, 188, 287, 1, 15, '2023-10-20 09:17:45', '2023-10-20 09:18:50'),
(1053, 188, 283, 1, 1, '2023-10-20 09:18:39', '2023-10-20 09:18:39'),
(1054, 188, 289, 1, 1, '2023-10-20 12:52:43', '2023-10-20 12:52:43'),
(1055, 188, 289, 1, 15, '2023-10-20 12:52:43', '2023-10-20 12:56:55'),
(1056, 188, 290, 1, 1, '2023-10-20 12:54:24', '2023-10-20 12:54:24'),
(1057, 188, 290, 1, 15, '2023-10-20 12:54:24', '2023-10-20 12:56:55'),
(1058, 190, 291, 1, 15, '2023-10-21 08:46:14', '2023-10-21 08:46:14'),
(1059, 190, 292, 1, 15, '2023-10-21 08:46:14', '2023-10-21 08:46:14'),
(1060, 190, 293, 1, 15, '2023-10-21 08:46:14', '2023-10-21 08:46:14'),
(1061, 190, 294, 1, 15, '2023-10-21 08:46:14', '2023-10-21 08:46:14'),
(1062, 190, 291, 1, 1, '2023-10-21 08:46:25', '2023-10-21 08:46:25'),
(1063, 190, 292, 1, 1, '2023-10-21 08:46:25', '2023-10-21 08:46:25'),
(1064, 190, 293, 1, 1, '2023-10-21 08:46:25', '2023-10-21 08:46:25'),
(1065, 190, 294, 1, 1, '2023-10-21 08:46:25', '2023-10-21 08:46:25'),
(1066, 194, 295, 1, 1, '2023-10-21 14:42:07', '2023-10-21 14:42:07'),
(1067, 194, 296, 1, 1, '2023-10-21 14:42:07', '2023-10-21 14:42:07'),
(1068, 194, 297, 1, 1, '2023-10-21 14:42:07', '2023-10-21 14:42:07'),
(1069, 194, 298, 1, 1, '2023-10-21 14:42:07', '2023-10-21 14:42:07'),
(1070, 194, 295, 1, 15, '2023-10-21 14:42:21', '2023-10-21 14:42:21'),
(1071, 194, 296, 1, 15, '2023-10-21 14:42:21', '2023-10-21 14:42:21'),
(1072, 194, 297, 1, 15, '2023-10-21 14:42:21', '2023-10-21 14:42:21'),
(1073, 194, 298, 1, 15, '2023-10-21 14:42:21', '2023-10-21 14:42:21'),
(1074, 198, 299, 1, 15, '2023-10-21 19:02:02', '2023-10-21 19:02:02'),
(1075, 198, 300, 1, 15, '2023-10-21 19:02:02', '2023-10-21 19:02:02'),
(1076, 198, 301, 1, 15, '2023-10-21 19:02:02', '2023-10-21 19:02:02'),
(1077, 198, 302, 1, 15, '2023-10-21 19:02:02', '2023-10-21 19:02:02'),
(1078, 198, 299, 1, 1, '2023-10-21 19:02:14', '2023-10-21 19:02:14'),
(1079, 198, 300, 1, 1, '2023-10-21 19:02:14', '2023-10-21 19:02:14'),
(1080, 198, 301, 1, 1, '2023-10-21 19:02:14', '2023-10-21 19:02:14'),
(1081, 198, 302, 1, 1, '2023-10-21 19:02:14', '2023-10-21 19:02:14'),
(1082, 202, 303, 1, 15, '2023-10-25 15:02:58', '2023-10-25 15:02:58'),
(1083, 3, 1, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1084, 3, 2, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1085, 3, 3, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1086, 3, 4, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1087, 3, 5, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1088, 4, 6, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1089, 4, 7, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1090, 4, 8, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1091, 5, 9, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1092, 5, 10, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1093, 5, 11, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1094, 5, 12, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1095, 6, 24, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1096, 5, 23, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1097, 19, 170, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1098, 19, 210, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1099, 172, 263, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1100, 172, 264, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1101, 172, 265, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1102, 172, 266, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1103, 175, 267, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1104, 175, 268, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1105, 175, 269, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1106, 175, 270, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1107, 178, 271, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1108, 178, 272, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1109, 178, 273, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1110, 178, 274, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1111, 182, 275, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1112, 182, 276, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1113, 182, 277, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1114, 182, 278, 0, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1115, 185, 279, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1116, 185, 280, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1117, 185, 281, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1118, 185, 282, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1119, 188, 283, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1120, 185, 284, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1121, 185, 285, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1122, 188, 288, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1123, 188, 287, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1124, 188, 289, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1125, 188, 290, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1126, 190, 291, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1127, 190, 292, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1128, 190, 293, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1129, 190, 294, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1130, 194, 295, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1131, 194, 296, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1132, 194, 297, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1133, 194, 298, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1134, 198, 299, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1135, 198, 300, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1136, 198, 301, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1137, 198, 302, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(1138, 202, 303, 1, 17, '2023-10-28 19:19:28', '2023-10-28 19:19:28');

-- --------------------------------------------------------

--
-- Structure de la table `csm_archive`
--

DROP TABLE IF EXISTS `csm_archive`;
CREATE TABLE IF NOT EXISTS `csm_archive` (
  `id_archive` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_doc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sujet_doc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `direc_id` bigint(20) UNSIGNED NOT NULL,
  `type_doc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `fichier_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut_doc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_doc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_archive`),
  KEY `csm_archive_direc_id_foreign` (`direc_id`),
  KEY `csm_archive_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_archive`
--

INSERT INTO `csm_archive` (`id_archive`, `ref_doc`, `sujet_doc`, `direc_id`, `type_doc`, `init_id`, `fichier_doc`, `statut_doc`, `code_doc`, `created_at`, `updated_at`) VALUES
(1, 'Bryon Herzog', 'Voluptatum deserunt qui aut laudantium modi qui.', 5, 'att', 1, 'quia.pdf', 'pri', 'dacd3053-16c9-41bb-98f4-0a6bbeacf634', NULL, NULL),
(2, 'Leif Koch', 'Sapiente at aliquam impedit est architecto alias laboriosam.', 5, 'att', 1, 'sequi.pdf', 'pri', 'ae5bc849-dab4-4262-bd05-1fe1cbee9716', NULL, NULL),
(3, 'Katelynn Bayer', 'Veniam non id eum soluta consequatur.', 1, 'att', 1, 'voluptatem.pdf', 'pri', 'a1f934c6-da51-43b2-8469-b387da3bd83c', NULL, NULL),
(4, 'Prof. Ernie Marvin', 'Voluptatibus voluptates sunt odio consectetur rerum.', 2, 'att', 1, 'amet.pdf', 'pri', '7f7b7ef1-9a09-455c-8b04-6b90909a4358', NULL, NULL),
(5, 'Gaylord Blick', 'Ipsa distinctio illum ipsum dolorum beatae.', 8, 'att', 1, 'unde.pdf', 'pri', '5bd66e44-3ca8-44fb-878d-993634e5968a', NULL, NULL),
(6, 'Mr. Bryon Kemmer', 'Tenetur aut dolorem cupiditate eos molestias rem.', 1, 'att', 1, 'aut.pdf', 'pri', '33c06364-6e1c-4f13-bfaa-9d46bb926cc2', NULL, NULL),
(7, 'Reva Leannon', 'Eius placeat ex voluptates.', 5, 'att', 1, 'nihil.pdf', 'pri', 'daa6baa3-1aec-4ed3-8d9e-4ce8415a0d14', NULL, NULL),
(8, 'Perry Lueilwitz', 'Molestias ab ullam repellendus.', 7, 'att', 1, 'consequatur.pdf', 'pri', '5594571c-e5db-415b-a42d-4d7c8267abbb', NULL, NULL),
(9, 'Emery Dickens', 'Eos mollitia et assumenda et distinctio minus.', 2, 'att', 1, 'assumenda.pdf', 'pri', '6bb5f263-8b09-41e6-8dd1-2e485b4dca28', NULL, NULL),
(10, 'Prof. Vicente Adams PhD', 'Omnis aut quidem ab dolores deserunt minus.', 3, 'att', 1, 'aut.pdf', 'pri', '8e79e6ed-9bb2-45ee-ae7a-1b2a62f8b8fa', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `csm_carriere`
--

DROP TABLE IF EXISTS `csm_carriere`;
CREATE TABLE IF NOT EXISTS `csm_carriere` (
  `id_carr` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_fonct` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_fonct` bigint(20) NOT NULL,
  `date_debut_carr` date NOT NULL,
  `date_fin_carr` date NOT NULL,
  `salaire_carr` bigint(20) NOT NULL,
  `id_occupant` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_carr`),
  KEY `csm_carriere_id_occupant_foreign` (`id_occupant`),
  KEY `csm_carriere_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_carriere`
--

INSERT INTO `csm_carriere` (`id_carr`, `type_fonct`, `id_fonct`, `date_debut_carr`, `date_fin_carr`, `salaire_carr`, `id_occupant`, `init_id`, `created_at`, `updated_at`) VALUES
(1, 'dr', 2, '2021-02-06', '2021-12-09', 600000, 51, 1, '2023-10-21 20:15:29', '2023-10-21 19:19:15'),
(2, 'dr', 7, '2019-08-18', '2023-03-28', 782105, 47, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(3, 'se', 27, '2018-11-12', '2022-12-04', 381867, 44, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(4, 'se', 7, '2021-03-03', '2022-12-23', 673399, 48, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(5, 'dr', 7, '2021-05-21', '2022-03-19', 480815, 49, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(7, 'di', 38, '2021-06-15', '2021-10-11', 338950, 50, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(8, 'di', 10, '2022-01-06', '2023-06-07', 505096, 45, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(9, 'se', 33, '2020-11-11', '2023-07-30', 464628, 46, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(10, 'di', 5, '2019-03-15', '2021-12-26', 671221, 51, 1, '2023-10-21 20:15:29', '2023-10-21 20:15:29'),
(11, 'se', 21, '2023-10-22', '2023-10-22', 652000, 41, 1, '2023-10-22 05:51:28', '2023-10-22 05:51:28'),
(12, 'se', 41, '2023-10-01', '2023-10-31', 652000, 41, 1, '2023-10-22 05:59:25', '2023-10-22 06:22:53');

-- --------------------------------------------------------

--
-- Structure de la table `csm_courrier`
--

DROP TABLE IF EXISTS `csm_courrier`;
CREATE TABLE IF NOT EXISTS `csm_courrier` (
  `id_cour` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_rece` timestamp NOT NULL,
  `expe_id` bigint(20) UNSIGNED NOT NULL,
  `sujet_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priorite_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `direc_id` bigint(20) UNSIGNED NOT NULL,
  `date_limite` date DEFAULT NULL,
  `commentaire_cour` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_jointe_cour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichier_reponse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `code_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_check` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cour`),
  KEY `csm_courrier_expe_id_foreign` (`expe_id`),
  KEY `csm_courrier_direc_id_foreign` (`direc_id`),
  KEY `csm_courrier_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_courrier`
--

INSERT INTO `csm_courrier` (`id_cour`, `ref_cour`, `date_rece`, `expe_id`, `sujet_cour`, `type_cour`, `statut_cour`, `priorite_cour`, `direc_id`, `date_limite`, `commentaire_cour`, `piece_jointe_cour`, `fichier_reponse`, `init_id`, `code_cour`, `code_check`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Xzavier Abbott Jr.', '2023-10-18 23:00:00', 20, 'Facere quibusdam quo aut sint.', 'e', 'en', 'h', 2, '2023-10-30', 'Est numquam ut amet eum.', 'atque.pdf', NULL, 1, '8bd26fe5-b901-44f8-b0aa-d2eecdb9ee2d', 6787626, '2023-10-25 10:26:51', '2023-10-25 14:50:37'),
(2, 'Donnell Kreiger', '2023-10-18 23:00:00', 3, 'Quod necessitatibus alias architecto dolorum.', 'e', 'tf', 'h', 2, '2023-10-30', 'Laboriosam aut quia molestias.', 'ducimus.pdf', NULL, 1, 'fc2a5587-d25d-4e13-88d3-ea9f15206423', 5032102, '2023-10-25 10:26:51', '2023-10-25 10:06:09'),
(3, 'Ms. Yadira McClure DVM', '2023-10-18 23:00:00', 14, 'Consequatur vero labore totam modi.', 'e', 'ec', 'h', 2, '2023-10-30', 'Sit non molestiae laborum natus ipsa non.', 'inventore.pdf', NULL, 1, 'f7f499ae-ccec-4400-854e-832741b2270e', 6812976, '2023-10-25 10:26:51', '2023-10-25 10:26:51'),
(4, 'Vincenza Johns', '2023-10-18 23:00:00', 13, 'Quia enim est id expedita inventore sed sed.', 'e', 'ec', 'h', 4, '2023-10-30', 'Et id enim modi.', 'temporibus.pdf', NULL, 1, 'eb73b70e-f6ac-48f4-865a-f7cc59869ec1', 9218426, '2023-10-25 10:26:51', '2023-10-25 10:26:51'),
(5, 'Thora Boyle', '2023-10-18 23:00:00', 8, 'Omnis quas eum libero sit et ut.', 'e', 'ec', 'h', 5, '2023-10-30', 'Ipsam blanditiis cumque dicta est.', 'magnam.pdf', NULL, 1, '7a0bc468-4900-466f-8845-36ade78196ad', 6533982, '2023-10-25 10:26:51', '2023-10-25 10:26:51'),
(6, 'Magnolia Koepp', '2023-10-18 23:00:00', 9, 'Quasi aut itaque nemo unde qui.', 'e', 'ec', 'h', 6, '2023-10-30', 'Consequatur commodi explicabo minima autem et.', 'eaque.pdf', NULL, 1, 'e91e1623-39a9-4fcd-8214-5a6eab8404f9', 4030582, '2023-10-25 10:26:51', '2023-10-25 10:26:51'),
(7, 'Mr. Eleazar Krajcik Sr.', '2023-10-18 23:00:00', 12, 'Vitae porro aliquid ut asperiores.', 'e', 'ec', 'h', 8, '2023-10-30', 'Odit cumque aspernatur a distinctio et.', 'sed.pdf', NULL, 1, '8d61cd22-e40c-45ce-9494-e91fb0c87ab2', 1187552, '2023-10-25 10:26:51', '2023-10-25 10:26:51'),
(8, 'Mrs. Nya Daugherty IV', '2023-10-18 23:00:00', 16, 'Facere rerum aspernatur consequatur quae officiis beatae rerum.', 'e', 'ec', 'h', 2, '2023-10-30', 'Est voluptatem harum hic saepe aspernatur.', 'iusto.pdf', NULL, 1, 'd15d96ca-e846-438b-99c0-35b8a82f90f2', 1890445, '2023-10-25 10:26:51', '2023-10-25 10:26:51'),
(9, 'Virginie Torp', '2023-10-18 23:00:00', 19, 'Itaque tempora id sint ut.', 'e', 'ec', 'h', 7, '2023-10-30', 'Qui facere in odio iste harum.', 'sit.pdf', NULL, 1, '753db402-c830-4e2c-9003-9a7f5885707a', 2989712, '2023-10-25 10:26:51', '2023-10-25 10:26:51'),
(10, 'Dr. Alexander Bayer', '2023-10-18 23:00:00', 13, 'Iusto deserunt aliquam consequatur voluptatum alias dolorum.', 'e', 'ec', 'h', 5, '2023-10-30', 'Sunt est in facilis error.', 'saepe.pdf', NULL, 1, '236e7e5e-d3a3-4f21-b1df-f760fbe00996', 1862967, '2023-10-25 10:26:51', '2023-10-25 10:26:51');

-- --------------------------------------------------------

--
-- Structure de la table `csm_courrier_sortant`
--

DROP TABLE IF EXISTS `csm_courrier_sortant`;
CREATE TABLE IF NOT EXISTS `csm_courrier_sortant` (
  `id_cours` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_envoi` date NOT NULL,
  `dest_id` bigint(20) UNSIGNED NOT NULL,
  `sujet_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `direc_id` bigint(20) UNSIGNED NOT NULL,
  `code_cour` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_jointe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_id` bigint(20) NOT NULL,
  `note_cour` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cours`),
  KEY `csm_courrier_sortant_dest_id_foreign` (`dest_id`),
  KEY `csm_courrier_sortant_direc_id_foreign` (`direc_id`),
  KEY `csm_courrier_sortant_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_courrier_sortant`
--

INSERT INTO `csm_courrier_sortant` (`id_cours`, `ref_cour`, `date_envoi`, `dest_id`, `sujet_cour`, `direc_id`, `code_cour`, `piece_jointe`, `init_id`, `note_cour`, `created_at`, `updated_at`) VALUES
(1, 'Lia Bednar', '2023-10-06', 10, 'Error voluptas cumque sint repellat.', 2, '35656e6b-0508-494d-a611-50d6ca10d438', 'perferendis.pdf', 1, 'Sapiente ex nihil ut consequatur voluptatem eos.', '2023-10-21 10:06:50', '2023-10-21 09:09:59'),
(2, 'Jorge Pacocha', '2023-10-18', 7, 'Amet iure sit iure ipsum.', 6, '9b89650b-239d-4a77-b96c-be039ff4b5d1', 'cumque.pdf', 1, 'Laborum architecto eligendi nemo in.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(3, 'Josue Brown Jr.', '2023-10-18', 5, 'Laboriosam quibusdam iste suscipit at ipsam dolores maxime totam.', 8, 'a5a44116-840a-4947-84c1-ddee4eb5f304', 'et.pdf', 1, 'Aut laudantium quia ducimus aspernatur omnis.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(4, 'Heidi Rath', '2023-10-18', 20, 'Et neque a odio iste est numquam iste.', 4, 'af34c305-f0d1-4dfa-9099-3febd6ea3ab0', 'ab.pdf', 1, 'Doloremque libero vero est harum nulla ipsa architecto.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(5, 'Eldon Skiles', '2023-10-18', 5, 'Nulla expedita facere neque.', 2, '769ee11a-d8fe-4a5b-9318-85a32144ce00', 'blanditiis.pdf', 1, 'Repellat nisi sint voluptatem quos eius nihil maiores.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(6, 'Mrs. Lorna Mraz IV', '2023-10-18', 14, 'Odio libero accusantium in aspernatur et maiores.', 1, '03cb5726-07cb-4f00-95db-3daa04b7ba17', 'ducimus.pdf', 1, 'Voluptatibus ut distinctio et et consequatur corrupti.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(7, 'Rossie Conn', '2023-10-18', 9, 'Ut non qui adipisci rerum veniam.', 8, '949c6bdf-c383-4f61-a494-c92fc85cc573', 'iusto.pdf', 1, 'Reiciendis esse eius vitae assumenda.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(8, 'Fabiola Grimes', '2023-10-18', 6, 'Hic voluptates quia aliquid eveniet nostrum eum.', 8, '639976f5-2253-4836-8541-2d2b140c729d', 'optio.pdf', 1, 'Voluptatem voluptatum recusandae similique animi placeat.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(9, 'Elmo Harber', '2023-10-18', 18, 'Nostrum nesciunt et cumque amet quod quis.', 3, '43e2bf74-61c3-4fc3-b79c-4fae18df3d87', 'qui.pdf', 1, 'Dicta optio aut id voluptate enim.', '2023-10-21 10:06:50', '2023-10-21 10:06:50'),
(10, 'Emilio Lynch', '2023-10-18', 20, 'Accusantium facilis non veniam distinctio saepe.', 1, 'ebe1979e-5ffb-4588-b7c5-3acadaf7f47f', 'fugiat.pdf', 1, 'Rem perspiciatis sint est rem porro est dolorum.', '2023-10-21 10:06:50', '2023-10-21 10:06:50');

-- --------------------------------------------------------

--
-- Structure de la table `csm_direction`
--

DROP TABLE IF EXISTS `csm_direction`;
CREATE TABLE IF NOT EXISTS `csm_direction` (
  `id_direc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_direc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lib_direc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `respo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_direc`),
  KEY `csm_direction_init_id_foreign` (`init_id`),
  KEY `csm_direction_respo_id_foreign` (`respo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_direction`
--

INSERT INTO `csm_direction` (`id_direc`, `code_direc`, `lib_direc`, `init_id`, `respo_id`, `created_at`, `updated_at`) VALUES
(1, 'DG', 'Direction Générale', 1, 47, '2023-10-18 18:24:02', '2023-10-18 18:24:02'),
(2, 'DSI', 'Direction Système Information', 1, 1, '2023-10-18 18:24:02', '2023-10-18 18:24:02'),
(3, 'DPAF', 'Direction Planification A. Finance', 1, 1, '2023-10-18 18:24:02', '2023-10-18 18:24:02'),
(4, 'Greta Stark', 'Sed ipsum assumenda omnis inventore enim.', 1, 45, '2023-10-18 18:24:02', '2023-10-18 18:24:02'),
(5, 'Citlalli Howell', 'Suscipit non voluptates cumque sit ut quis earum.', 1, 49, '2023-10-18 18:24:02', '2023-10-18 18:24:02'),
(6, 'Ms. Gabrielle Nienow III', 'Natus reiciendis rem numquam voluptas nihil deleniti beatae.', 1, 1, '2023-10-18 18:24:02', '2023-10-18 18:24:02'),
(7, 'Sierra Parker', 'Voluptatum cumque laborum molestiae esse.', 1, 50, '2023-10-18 18:24:02', '2023-10-18 18:24:02'),
(8, 'Miss Jana Paucek II', 'Similique ut voluptas corporis quaerat ea reiciendis quidem necessitatibus.', 1, 41, '2023-10-18 18:24:02', '2023-10-18 18:24:02');

-- --------------------------------------------------------

--
-- Structure de la table `csm_division`
--

DROP TABLE IF EXISTS `csm_division`;
CREATE TABLE IF NOT EXISTS `csm_division` (
  `id_divi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_divi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lib_divi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_serv` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `respo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_divi`),
  KEY `csm_division_id_serv_foreign` (`id_serv`),
  KEY `csm_division_init_id_foreign` (`init_id`),
  KEY `csm_division_respo_id_foreign` (`respo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_division`
--

INSERT INTO `csm_division` (`id_divi`, `code_divi`, `lib_divi`, `id_serv`, `init_id`, `respo_id`, `created_at`, `updated_at`) VALUES
(1, 'Opal Yost Jr.', 'Occaecati perferendis quia labore est.', 45, 1, 48, NULL, NULL),
(2, 'Gudrun Haag', 'Ut deserunt velit ab et exercitationem quo.', 14, 1, 1, NULL, NULL),
(3, 'Kane Smith', 'Dolorem quia molestias dignissimos quidem quia.', 43, 1, 48, NULL, NULL),
(4, 'Elfrieda Bednar III', 'Exercitationem doloremque sed modi minima dolor.', 37, 1, 50, NULL, NULL),
(5, 'Prof. Casimer Feeney PhD', 'Vel eligendi sit odio neque similique sit at.', 23, 1, 44, NULL, NULL),
(6, 'Dr. Emelia Little PhD', 'Nihil ut rerum error aut similique quod dolor.', 25, 1, 50, NULL, NULL),
(7, 'Rylee Cummings', 'Sapiente aut molestiae deserunt.', 10, 1, 43, NULL, NULL),
(8, 'Cleo Parker Sr.', 'Incidunt consequatur rerum quia in voluptatem.', 44, 1, 49, NULL, NULL),
(9, 'Mrs. Shayna Pfeffer', 'Doloremque sunt illo officiis.', 50, 1, 47, NULL, NULL),
(10, 'CD', 'Chef division', 3, 1, 50, NULL, '2023-10-20 12:30:07'),
(11, 'Marshall Abernathy', 'Unde atque et beatae explicabo quia veritatis aperiam.', 25, 1, 45, NULL, NULL),
(12, 'Viva Haag', 'Nostrum eligendi asperiores ullam autem nihil.', 22, 1, 1, NULL, NULL),
(13, 'Giovanna Turcotte', 'Non quam minus nihil ducimus quis ipsam deserunt non.', 31, 1, 44, NULL, NULL),
(14, 'Prof. Arielle Kling V', 'Sunt dolore provident eligendi aliquam.', 10, 1, 20, NULL, NULL),
(15, 'Ashlee Legros', 'Magni amet exercitationem sed.', 7, 1, 46, NULL, NULL),
(16, 'Ulices Mertz', 'Sit sit laboriosam qui hic animi aut.', 2, 1, 47, NULL, NULL),
(17, 'Alexandrine Abshire', 'Delectus saepe aliquid debitis quo ut ullam atque atque.', 42, 1, 41, NULL, NULL),
(18, 'Jasper Bahringer IV', 'Repellendus earum natus omnis voluptatibus nulla sapiente autem aut.', 41, 1, 49, NULL, NULL),
(19, 'Eleonore Dach', 'Fugiat quia illo et sint quia.', 34, 1, 50, NULL, NULL),
(20, 'Frida Becker II', 'Voluptates iure laborum suscipit odio modi qui nihil.', 41, 1, 48, NULL, NULL),
(21, 'Kelvin O\'Connell', 'Est ullam enim omnis at ut ipsam consequatur excepturi.', 10, 1, 41, NULL, NULL),
(22, 'Kaylah Stroman', 'Odio sed et enim vel magni dolorem ipsum.', 34, 1, 46, NULL, NULL),
(23, 'Prof. Yvette Lynch DVM', 'Eaque et illo nihil praesentium explicabo.', 21, 1, 47, NULL, NULL),
(24, 'Samanta Swaniawski', 'Deleniti sint perspiciatis tempore possimus rerum nisi ea non.', 20, 1, 41, NULL, NULL),
(25, 'Mr. Humberto Nicolas', 'Illo natus pariatur velit explicabo praesentium.', 2, 1, 43, NULL, NULL),
(26, 'Kevon Wintheiser', 'Sunt vitae qui est eos et velit.', 35, 1, 46, NULL, NULL),
(27, 'Friedrich Batz III', 'Amet sed aperiam et est et blanditiis eligendi.', 38, 1, 42, NULL, NULL),
(28, 'Rigoberto Greenholt', 'Temporibus vero cupiditate reiciendis odit.', 28, 1, 49, NULL, NULL),
(29, 'Leanna Wilderman V', 'Perferendis error illo aut ea aspernatur.', 21, 1, 1, NULL, NULL),
(30, 'Nyasia O\'Conner', 'Corporis distinctio fugiat amet repellendus ut veritatis est dignissimos.', 39, 1, 43, NULL, NULL),
(31, 'Amy Wyman', 'Quibusdam saepe molestias eum excepturi omnis aspernatur et.', 6, 1, 44, NULL, NULL),
(32, 'Delphia Witting', 'Non nesciunt sed et velit doloribus voluptas hic.', 22, 1, 49, NULL, NULL),
(33, 'Bo Ullrich', 'Molestiae ab excepturi voluptatem cumque deleniti laudantium.', 16, 1, 43, NULL, NULL),
(34, 'Dr. Veronica Schowalter', 'Blanditiis aut delectus aut necessitatibus amet.', 40, 1, 47, NULL, NULL),
(35, 'Oliver Monahan', 'Qui aut dolor dolorem pariatur.', 13, 1, 48, NULL, NULL),
(36, 'Dr. Kristofer Feest IV', 'Architecto et eaque tenetur illo voluptas perspiciatis nihil sed.', 19, 1, 41, NULL, NULL),
(37, 'Prof. Una Morar', 'Atque velit molestiae officia maxime placeat adipisci possimus.', 22, 1, 43, NULL, NULL),
(38, 'Rashad Hirthe', 'Maxime aliquam deserunt repudiandae soluta est.', 9, 1, 1, NULL, NULL),
(39, 'Gino Keeling', 'Voluptatem quibusdam voluptas laboriosam eum quia velit.', 18, 1, 44, NULL, NULL),
(40, 'Prof. Matilde Breitenberg V', 'Alias reprehenderit est eius possimus itaque corporis.', 22, 1, 45, NULL, NULL),
(41, 'Serenity Schroeder', 'Possimus aut maxime aliquam quam.', 20, 1, 43, NULL, NULL),
(42, 'Philip Baumbach', 'Dolor ab corrupti sit nihil.', 16, 1, 48, NULL, NULL),
(43, 'Dr. Raphaelle Bergstrom', 'Praesentium eaque quasi ad sit nobis ipsam ex.', 29, 1, 48, NULL, NULL),
(44, 'Lily Paucek', 'Exercitationem aut quae recusandae sed.', 46, 1, 46, NULL, NULL),
(45, 'Johnathan Wiza IV', 'Iusto qui qui qui eos.', 43, 1, 50, NULL, NULL),
(46, 'Dr. Cooper Runte', 'Ullam aliquid recusandae officiis in quibusdam tempore.', 49, 1, 48, NULL, NULL),
(47, 'Rosetta Morar', 'Ut tenetur dolorem et est aliquid.', 45, 1, 49, NULL, NULL),
(48, 'Fritz Daugherty', 'Saepe rem ut autem porro assumenda.', 27, 1, 49, NULL, NULL),
(49, 'Wilmer Wolff', 'Alias nulla dolor rem sed iste.', 38, 1, 1, NULL, NULL),
(50, 'Miss Lucinda Koelpin', 'Expedita quis maiores deserunt architecto.', 36, 1, 50, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `csm_expediteur`
--

DROP TABLE IF EXISTS `csm_expediteur`;
CREATE TABLE IF NOT EXISTS `csm_expediteur` (
  `id_expe` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_expe` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_expe` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adres_expe` text COLLATE utf8mb4_unicode_ci,
  `email_expe` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_expe`),
  KEY `csm_expediteur_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_expediteur`
--

INSERT INTO `csm_expediteur` (`id_expe`, `nom_expe`, `type_expe`, `adres_expe`, `email_expe`, `init_id`, `created_at`, `updated_at`) VALUES
(2, 'Abigayle Lang', 'pm', 'Suscipit natus nemo officia qui.', 'loy.schimmel@example.com', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(3, 'Dr. Alene Fritsch III', 'pp', 'Laborum occaecati nostrum dolore et.', 'darion.sauer@example.com', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(4, 'Lexi Kub', 'pm', 'Ut in dolor ipsa assumenda ut non.', 'susanna.walter@example.org', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(5, 'Noelia O\'Kon', 'pp', 'Veritatis ratione quos dolorem nobis recusandae sit iusto sit.', 'elda66@example.org', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(6, 'Ally Schultz', 'pm', 'Ut eaque asperiores voluptas aut ut et impedit praesentium.', 'yundt.lorenzo@example.org', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(7, 'Carrie Romaguera', 'pm', 'Eveniet eos repellendus magnam dolor in.', 'schaefer.breanne@example.com', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(8, 'Miss Marguerite Block DDS', 'pm', 'Repellat excepturi similique eaque explicabo nihil fugit molestiae blanditiis.', 'igibson@example.org', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(9, 'Cassie Mann DDS', 'pm', 'Est quisquam ex quae.', 'eloy.bednar@example.com', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(10, 'Luis Wisozk', 'pp', 'Fugiat porro nobis non molestiae.', 'vonrueden.ethan@example.org', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(11, 'Cruz Effertz', 'pm', 'Sapiente vel est ipsam autem nihil omnis totam.', 'bhowe@example.com', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(12, 'Judah Mertz IV', 'pm', 'Amet nihil quibusdam reiciendis illo minima.', 'arnold29@example.com', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(13, 'Fermin Price', 'pm', 'Voluptatum nemo odio qui eum odio quae sit.', 'lysanne76@example.net', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(14, 'Prof. Verdie Flatley', 'pm', 'Aut omnis rerum dicta molestiae ratione.', 'emmitt.hammes@example.com', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(15, 'Efrain Langworth', 'pm', 'Maxime dolorem nihil eum et.', 'zorn@example.net', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(16, 'Mr. Eladio Crona DVM', 'pp', 'Nihil optio voluptatem sit repellat sint est qui consequatur.', 'easton.borer@example.org', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(17, 'Camylle Larson III', 'pm', 'Perspiciatis eveniet nam est a fugit.', 'genesis63@example.net', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(18, 'Mellie Fay', 'pm', 'Enim dicta voluptatum a dignissimos cum corrupti ut.', 'dicki.cooper@example.org', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(19, 'Mallory Quigley', 'pm', 'Voluptatem eaque quisquam distinctio sit non nostrum libero.', 'grady.rosalyn@example.net', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42'),
(20, 'Madonna Koepp', 'pp', 'Commodi mollitia et sit velit iste.', 'hhaag@example.net', 1, '2023-10-19 10:22:42', '2023-10-19 10:22:42');

-- --------------------------------------------------------

--
-- Structure de la table `csm_failed_jobs`
--

DROP TABLE IF EXISTS `csm_failed_jobs`;
CREATE TABLE IF NOT EXISTS `csm_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `csm_menu`
--

DROP TABLE IF EXISTS `csm_menu`;
CREATE TABLE IF NOT EXISTS `csm_menu` (
  `id_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_menu` varchar(255) DEFAULT NULL,
  `titre_page` varchar(255) DEFAULT NULL,
  `controler` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `topmenu_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `num_ordre` bigint(20) DEFAULT NULL,
  `order_ss` bigint(20) DEFAULT NULL,
  `architecture` varchar(255) DEFAULT NULL,
  `elmt_menu` varchar(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_menu`),
  KEY `matierefp_menu_topmenu_id_foreign` (`topmenu_id`),
  KEY `matierefp_menu_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=191920 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `csm_menu`
--

INSERT INTO `csm_menu` (`id_menu`, `libelle_menu`, `titre_page`, `controler`, `route`, `topmenu_id`, `user_id`, `menu_icon`, `num_ordre`, `order_ss`, `architecture`, `elmt_menu`, `created_at`, `updated_at`) VALUES
(1, 'Accueil', 'Bienvenu à la page d\'accueil', '', 'home', 0, 1, 'ri-home-4-line', 1, 0, '/', 'oui', '2022-06-20 14:10:01', '2022-10-18 17:40:50'),
(2, 'Administrations', 'Bienvenu à la page d\'administrateur', '', 'admin', 0, 1, 'ri-settings-2-line', 6, 0, '/admin', 'oui', '2022-06-20 14:10:01', '2023-10-21 18:58:11'),
(3, 'Menu', 'Liste des menus', 'GiwuMenuController', 'menu', 2, 1, 'ri-menu-fill', 1, 2, '/admin/menu', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:02:48'),
(4, 'Définir les rôles', 'Liste des rôles', 'RoleController', 'role', 2, 1, 'ri-shield-user-line', 2, 0, '/admin/role', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:20:17'),
(5, 'Utilisateurs', 'Gestion des utilisateurs', 'PlaUserappController', 'users', 2, 1, 'ri-user-settings-fill', 3, 0, '/admin/user', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:21:14'),
(6, 'Suivi des mouvements', 'Suivi des mouvements', 'IndexController', 'trace', 2, 1, 'ri-file-list-2-fill', 6, 0, '/admin/trace', 'oui', '2022-06-20 14:10:01', '2022-11-21 13:36:37'),
(7, 'Aide', 'Aide sur l\'application', '', 'aide', 0, 1, 'ri-information-line', 7, 0, '/aide', 'oui', '2022-06-20 14:10:01', '2023-10-21 18:58:23'),
(8, 'Manuel d\'utilisation', 'Manuel d\'utilisation', '', 'manuel', 7, 1, 'ri-book-2-fill', 1, 0, '/aide/manuel', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:23:03'),
(9, 'Détails profil', 'Mon profil', '', 'myprofile', 0, 1, 'ri-group-line', 1, 0, '/profil', 'non', '2022-06-20 14:10:01', '2022-07-25 08:24:07'),
(10, 'Création d\'un utilisateur', 'Création d\'un utilisateur', 'PlaUserappController', 'users/create', 5, 1, 'ri-user-add-line', 1, 0, '/admin/user/create', 'non', '2022-06-20 14:10:01', '2022-07-25 08:23:49'),
(18, 'Modification d\'un menu', 'Modification d\'un menu', NULL, 'menu/edit', 0, 1, 'ri-menu-add-fill', 1, NULL, '/admin/menu/edit', 'non', '2022-07-25 08:07:26', '2022-07-25 08:07:26'),
(19, 'Paramètres', 'Paramètres', NULL, 'param', 0, 1, 'ri-chat-settings-line', 1, NULL, '/param', 'oui', '2022-07-25 10:12:48', '2023-10-18 10:13:11'),
(17, 'Création d\'un menu', 'Création d\'un menu', NULL, 'menu/create', 3, 1, 'ri-menu-add-line', 1, NULL, '/admin/menu/create', 'non', '2022-07-22 18:51:01', '2022-07-25 08:03:10'),
(20, 'Modification d\'un rôle', 'Modification d\'un rôle', NULL, 'role/edit', 0, 1, 'ri-shield-user-line', 1, NULL, '/admin/role/edit', 'non', '2022-07-25 10:16:06', '2022-07-25 10:16:37'),
(24, 'Consultation', 'Consultation', NULL, 'cons', 0, 1, 'ri-file-list-2-line', 3, NULL, '/cons', 'non', '2022-07-26 15:06:45', '2022-12-30 18:55:39'),
(74, 'Société', 'Société', NULL, 'mysociety', 2, 1, 'ri-home-4-line', 2, NULL, '/admin/societe', 'oui', '2022-10-07 16:26:14', '2022-11-09 19:50:58'),
(172, 'Directions', 'Directions', 'DirectionController', 'direction', 19, 1, 'ri-bill-line', 1, NULL, '/param/direction', 'oui', '2023-10-18 15:27:00', '2023-10-18 14:27:31'),
(173, 'Ajouter une direction', 'Ajouter une direction', 'DirectionController', 'direction/create', 172, 1, 'ri-bill-line', 1, NULL, '/param/direction/create', 'non', '2023-10-18 15:27:00', '2023-10-18 15:27:00'),
(174, 'Modifier une direction', 'Modifier une direction', 'DirectionController', 'direction/edit', 172, 1, 'ri-bill-line', 1, NULL, '/param/direction/edit', 'non', '2023-10-18 15:27:00', '2023-10-18 15:27:00'),
(175, 'Services', 'Services', 'ServiceController', 'service', 19, 1, 'ri-bill-line', 2, NULL, '/param/service', 'oui', '2023-10-18 18:53:30', '2023-10-18 18:34:40'),
(176, 'Ajouter un service', 'Ajouter un service', 'ServiceController', 'service/create', 175, 1, 'ri-bill-line', 1, NULL, '/param/service/create', 'non', '2023-10-18 18:53:30', '2023-10-18 18:53:30'),
(177, 'Modifier un service', 'Modifier un service', 'ServiceController', 'service/edit', 175, 1, 'ri-bill-line', 1, NULL, '/param/service/edit', 'non', '2023-10-18 18:53:30', '2023-10-18 18:53:30'),
(178, 'Divisions', 'Divisions', 'DivisionController', 'division', 19, 1, 'ri-bill-line', 3, NULL, '/param/division', 'oui', '2023-10-18 19:33:14', '2023-10-18 18:34:33'),
(179, 'Ajouter une division', 'Ajouter une division', 'DivisionController', 'division/create', 178, 1, 'ri-bill-line', 1, NULL, '/param/division/create', 'non', '2023-10-18 19:33:14', '2023-10-18 19:33:14'),
(180, 'Modifier une division', 'Modifier une division', 'DivisionController', 'division/edit', 178, 1, 'ri-bill-line', 1, NULL, '/param/division/edit', 'non', '2023-10-18 19:33:14', '2023-10-18 19:33:14'),
(181, 'Gestion des courriers', 'Gestion des courriers', NULL, 'cour', 0, 1, 'ri-file-line', 2, NULL, '/cour', 'oui', '2023-10-18 19:41:41', '2023-10-19 07:01:09'),
(182, 'Expéditeurs', 'Expéditeurs', 'ExpediteurController', 'expediteur', 181, 1, 'ri-bill-line', 1, NULL, '/cour/expediteur', 'oui', '2023-10-19 08:48:55', '2023-10-19 07:49:27'),
(183, 'Ajouter un expéditeur', 'Ajouter un expéditeur', 'ExpediteurController', 'expediteur/create', 182, 1, 'ri-bill-line', 1, NULL, '/cour/expediteur/create', 'non', '2023-10-19 08:48:55', '2023-10-19 07:49:47'),
(184, 'Modifier un expéditeur', 'Modifier un expéditeur', 'ExpediteurController', 'expediteur/edit', 182, 1, 'ri-bill-line', 1, NULL, '/cour/expediteur/edit', 'non', '2023-10-19 08:48:55', '2023-10-19 07:50:00'),
(185, 'Courrier Entrant', 'Courrier Entrant', 'CourrierController', 'courrier', 181, 1, 'ri-file-line', 2, NULL, '/cour/courrier', 'oui', '2023-10-19 11:39:52', '2023-10-19 11:47:30'),
(186, 'Ajouter un courrier entrant', 'Ajout de Courrier entrant', 'CourrierController', 'courrier/create', 185, 1, 'ri-file-line', 1, NULL, '/cour/courrier/create', 'non', '2023-10-19 11:39:52', '2023-10-19 11:48:39'),
(187, 'Modifier un courrier entrant', 'Modification de Courrier entrant', 'CourrierController', 'courrier/edit', 185, 1, 'ri-file-line', 1, NULL, '/cour/courrier/edit', 'non', '2023-10-19 11:39:52', '2023-10-19 11:48:56'),
(188, 'Courrier à traiter', 'Courrier à traiter', 'listcourrieratraiterController', 'listcourrieratraiter', 181, 1, 'ri-file-line', 3, NULL, '/cour/listcourrieratraiter', 'oui', '2023-10-20 07:34:27', '2023-10-20 06:38:07'),
(189, 'Consultation du courrier', 'Consultation du courrier', NULL, 'courrier/consulter', 181, 1, 'ri-eye-line', 1, NULL, '/cour/courrier/consulter', 'non', '2023-10-21 05:28:03', '2023-10-21 06:00:26'),
(190, 'Courrier sortant', 'Courrier sortant', 'CourriersortantController', 'courriersortant', 181, 1, 'ri-file-line', 4, NULL, '/cour/courriersortant', 'oui', '2023-10-21 09:36:30', '2023-10-21 08:45:30'),
(191, 'Ajouter un courrier sortant', 'Ajout de courrier sortant', 'CourriersortantController', 'courriersortant/create', 190, 1, 'ri-file-line', 1, NULL, '/cour/courriersortant/create', 'non', '2023-10-21 09:36:30', '2023-10-21 08:50:08'),
(192, 'Modifier un courrier sortant', 'Modification d\'un courrier sortant', 'CourriersortantController', 'courriersortant/edit', 190, 1, 'ri-file-line', 1, NULL, '/cour/courriersortant/edit', 'non', '2023-10-21 09:36:30', '2023-10-21 08:46:57'),
(193, 'Gestion des archives', 'Gestion des archives', NULL, 'archive', 0, 1, 'ri-archive-drawer-line', 3, NULL, '/archive', 'oui', '2023-10-21 09:20:18', '2023-10-21 19:21:23'),
(194, 'Document archivé', 'Document archivé', 'ArchiveController', 'archive', 193, 1, 'ri-archive-drawer-line', 1, NULL, '/archive/archive', 'oui', '2023-10-21 15:39:55', '2023-10-21 19:21:05'),
(195, 'Ajouter une archive', 'Ajouter une archive', 'ArchiveController', 'archive/create', 194, 1, 'ri-archive-drawer-line', 1, NULL, '/archive/archive/create', 'non', '2023-10-21 15:39:55', '2023-10-21 19:21:12'),
(196, 'Modifier une archive', 'Modifier une archive', 'ArchiveController', 'archive/edit', 194, 1, 'ri-archive-drawer-line', 1, NULL, '/archive/archive/edit', 'non', '2023-10-21 15:39:55', '2023-10-21 19:21:19'),
(197, 'Gestion des carrières', 'Gestion des carrières', NULL, 'carriere', 0, 1, 'ri-honour-line', 4, NULL, '/carriere', 'oui', '2023-10-21 18:57:47', '2023-10-21 19:22:14'),
(198, 'Edition des carrières', 'Edition des carrières', 'CarriereController', 'carriere', 197, 1, 'ri-honour-line', 1, NULL, '/carriere/carriere', 'oui', '2023-10-21 20:00:42', '2023-10-21 19:22:31'),
(199, 'Ajouter une carriere', 'Ajout de Carriere', 'CarriereController', 'carriere/create', 198, 1, 'ri-honour-line', 1, NULL, '/carriere/carriere/create', 'non', '2023-10-21 20:00:42', '2023-10-21 19:22:25'),
(200, 'Modifier une carriere', 'Modification de Carriere', 'CarriereController', 'carriere/edit', 198, 1, 'ri-honour-line', 1, NULL, '/carriere/carriere/edit', 'non', '2023-10-21 20:00:42', '2023-10-21 19:22:20'),
(201, 'Gestion des retraites', 'Gestion des retraites', NULL, 'retraite', 0, 1, 'ri-home-4-line', 5, NULL, '/retraite', 'oui', '2023-10-24 12:33:55', '2023-10-24 12:35:30'),
(202, 'Consulter', 'Consulter', 'listretraiteController', 'listretraite', 201, 1, 'ri-bill-line', 1, NULL, '/retraite/listretraite', 'oui', '2023-10-24 13:44:01', '2023-10-24 12:44:50');

-- --------------------------------------------------------

--
-- Structure de la table `csm_migrations`
--

DROP TABLE IF EXISTS `csm_migrations`;
CREATE TABLE IF NOT EXISTS `csm_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_migrations`
--

INSERT INTO `csm_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `csm_password_resets`
--

DROP TABLE IF EXISTS `csm_password_resets`;
CREATE TABLE IF NOT EXISTS `csm_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `csm_personal_access_tokens`
--

DROP TABLE IF EXISTS `csm_personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `csm_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `csm_role`
--

DROP TABLE IF EXISTS `csm_role`;
CREATE TABLE IF NOT EXISTS `csm_role` (
  `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_role` varchar(255) NOT NULL,
  `user_save_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  KEY `matierefp_role_user_save_id_foreign` (`user_save_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `csm_role`
--

INSERT INTO `csm_role` (`id_role`, `libelle_role`, `user_save_id`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur inputer', 1, '2022-06-20 14:10:01', '2023-10-21 19:02:13'),
(15, 'Administrateur Système', 1, '2023-10-18 14:39:34', '2023-10-25 15:02:58'),
(17, 'Magistrat', 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28');

-- --------------------------------------------------------

--
-- Structure de la table `csm_role_acces`
--

DROP TABLE IF EXISTS `csm_role_acces`;
CREATE TABLE IF NOT EXISTS `csm_role_acces` (
  `role_id` bigint(20) NOT NULL,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `id_roleacces` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `statut_role` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_roleacces`),
  KEY `matierefp_role_acces_role_id_foreign` (`role_id`),
  KEY `matierefp_role_acces_id_menu_foreign` (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=797 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `csm_role_acces`
--

INSERT INTO `csm_role_acces` (`role_id`, `id_menu`, `id_roleacces`, `statut_role`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 2, 2, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 5, 3, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 6, 4, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 3, 5, 1, '2022-06-20 14:10:01', '2023-10-21 19:02:13'),
(1, 4, 6, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 7, 7, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 8, 8, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 24, 49, 1, '2022-07-26 15:06:45', '2022-07-26 15:06:45'),
(1, 17, 31, 1, '2022-07-22 21:43:07', '2022-07-22 21:43:15'),
(1, 10, 30, 1, '2022-07-22 21:43:07', '2022-07-22 21:43:07'),
(1, 9, 29, 1, '2022-07-22 21:43:07', '2022-07-22 21:43:07'),
(1, 20, 45, 1, '2022-07-25 10:18:59', '2022-07-25 10:18:59'),
(1, 19, 44, 1, '2022-07-25 10:18:59', '2022-07-25 10:18:59'),
(1, 18, 43, 1, '2022-07-25 08:30:53', '2022-07-25 08:30:53'),
(1, 74, 142, 1, '2022-10-07 16:26:14', '2022-10-07 16:26:14'),
(1, 172, 672, 1, NULL, NULL),
(1, 173, 673, 1, NULL, NULL),
(1, 174, 674, 1, NULL, NULL),
(15, 1, 675, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 2, 676, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 3, 677, 0, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 4, 678, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 5, 679, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 6, 680, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 7, 681, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 8, 682, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 9, 683, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 10, 684, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 18, 685, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 19, 686, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 17, 687, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 20, 688, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 24, 689, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 74, 690, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 172, 691, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 173, 692, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(15, 174, 693, 1, '2023-10-18 14:39:34', '2023-10-18 14:39:34'),
(1, 175, 694, 1, NULL, NULL),
(1, 176, 695, 1, NULL, NULL),
(1, 177, 696, 1, NULL, NULL),
(1, 178, 697, 1, NULL, NULL),
(1, 179, 698, 1, NULL, NULL),
(1, 180, 699, 1, NULL, NULL),
(1, 181, 700, 1, '2023-10-18 19:41:41', '2023-10-18 19:41:41'),
(1, 182, 701, 1, NULL, NULL),
(1, 183, 702, 1, NULL, NULL),
(1, 184, 703, 1, NULL, NULL),
(1, 185, 704, 1, NULL, NULL),
(1, 186, 705, 1, NULL, NULL),
(1, 187, 706, 1, NULL, NULL),
(1, 188, 707, 1, NULL, NULL),
(15, 175, 708, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 176, 709, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 177, 710, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 178, 711, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 179, 712, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 180, 713, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 181, 714, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 182, 715, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 183, 716, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 184, 717, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 185, 718, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 186, 719, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 187, 720, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(15, 188, 721, 1, '2023-10-20 09:02:30', '2023-10-20 09:02:30'),
(1, 189, 722, 1, '2023-10-21 05:28:03', '2023-10-21 05:28:03'),
(15, 189, 723, 1, '2023-10-21 05:30:39', '2023-10-21 05:30:39'),
(1, 190, 724, 1, NULL, NULL),
(1, 191, 725, 1, NULL, NULL),
(1, 192, 726, 1, NULL, NULL),
(15, 190, 727, 1, '2023-10-21 08:46:14', '2023-10-21 08:46:14'),
(15, 191, 728, 1, '2023-10-21 08:46:14', '2023-10-21 08:46:14'),
(15, 192, 729, 1, '2023-10-21 08:46:14', '2023-10-21 08:46:14'),
(1, 193, 730, 1, '2023-10-21 09:20:18', '2023-10-21 09:20:18'),
(1, 194, 731, 1, NULL, NULL),
(1, 195, 732, 1, NULL, NULL),
(1, 196, 733, 1, NULL, NULL),
(15, 193, 734, 1, '2023-10-21 14:42:20', '2023-10-21 14:42:20'),
(15, 194, 735, 1, '2023-10-21 14:42:20', '2023-10-21 14:42:20'),
(15, 195, 736, 1, '2023-10-21 14:42:20', '2023-10-21 14:42:20'),
(15, 196, 737, 1, '2023-10-21 14:42:20', '2023-10-21 14:42:20'),
(1, 197, 738, 1, '2023-10-21 18:57:47', '2023-10-21 18:57:47'),
(1, 198, 739, 1, NULL, NULL),
(1, 199, 740, 1, NULL, NULL),
(1, 200, 741, 1, NULL, NULL),
(15, 197, 742, 1, '2023-10-21 19:02:01', '2023-10-21 19:02:01'),
(15, 198, 743, 1, '2023-10-21 19:02:01', '2023-10-21 19:02:01'),
(15, 199, 744, 1, '2023-10-21 19:02:01', '2023-10-21 19:02:01'),
(15, 200, 745, 1, '2023-10-21 19:02:01', '2023-10-21 19:02:01'),
(1, 201, 746, 1, '2023-10-24 12:33:55', '2023-10-24 12:33:55'),
(1, 202, 747, 1, NULL, NULL),
(15, 201, 748, 1, '2023-10-25 15:02:58', '2023-10-25 15:02:58'),
(15, 202, 749, 1, '2023-10-25 15:02:58', '2023-10-25 15:02:58'),
(17, 1, 750, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 2, 751, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 3, 752, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 4, 753, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 5, 754, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 6, 755, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 7, 756, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 8, 757, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 9, 758, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 10, 759, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 18, 760, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 19, 761, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 17, 762, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 20, 763, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 24, 764, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 74, 765, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 172, 766, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 173, 767, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 174, 768, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 175, 769, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 176, 770, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 177, 771, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 178, 772, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 179, 773, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 180, 774, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 181, 775, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 182, 776, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 183, 777, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 184, 778, 0, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 185, 779, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 186, 780, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 187, 781, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 188, 782, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 189, 783, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 190, 784, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 191, 785, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 192, 786, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 193, 787, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 194, 788, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 195, 789, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 196, 790, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 197, 791, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 198, 792, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 199, 793, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 200, 794, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 201, 795, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28'),
(17, 202, 796, 1, '2023-10-28 19:19:28', '2023-10-28 19:19:28');

-- --------------------------------------------------------

--
-- Structure de la table `csm_save_trace`
--

DROP TABLE IF EXISTS `csm_save_trace`;
CREATE TABLE IF NOT EXISTS `csm_save_trace` (
  `id_trace` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_trace` varchar(13000) NOT NULL,
  `naviguateur` varchar(255) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trace`),
  KEY `matierefp_save_trace_id_user_foreign` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `csm_service`
--

DROP TABLE IF EXISTS `csm_service`;
CREATE TABLE IF NOT EXISTS `csm_service` (
  `id_serv` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_serv` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lib_serv` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_direc` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `respo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_serv`),
  KEY `csm_service_id_direc_foreign` (`id_direc`),
  KEY `csm_service_init_id_foreign` (`init_id`),
  KEY `csm_service_respo_id_foreign` (`respo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_service`
--

INSERT INTO `csm_service` (`id_serv`, `code_serv`, `lib_serv`, `id_direc`, `init_id`, `respo_id`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Geovanni Legros V', 'Sed ducimus officia officiis est.', 6, 1, 49, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(2, 'SG', 'Sécretaire Générale', 1, 1, 41, '2023-10-18 19:10:33', '2023-10-20 12:28:53'),
(3, 'CSI', 'Chef Service Informatique', 2, 1, 48, '2023-10-18 19:10:33', '2023-10-20 12:29:33'),
(4, 'Olga Lind', 'Fugit quaerat sed doloremque velit ut dolor autem facere.', 7, 1, 44, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(5, 'Prof. Dexter Mayer', 'Iusto nesciunt tempore saepe et soluta corporis aut.', 3, 1, 20, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(6, 'Damaris Steuber', 'Et delectus et id sed est ut aliquam fugiat.', 2, 1, 43, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(7, 'Mrs. Era Hartmann', 'Delectus deleniti aut voluptatum iste excepturi.', 5, 1, 46, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(8, 'SG 1', 'Sécretaire Générale 1', 1, 1, 48, '2023-10-18 19:10:33', '2023-10-20 12:29:10'),
(9, 'Mr. Tad Durgan', 'Rem eum possimus ut nihil.', 3, 1, 20, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(10, 'Conner Heathcote', 'Dolor tempore pariatur cupiditate distinctio.', 2, 1, 1, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(11, 'Roma Stracke', 'Praesentium architecto repellat neque officiis.', 7, 1, 44, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(12, 'Hattie Corkery', 'Optio aut eius blanditiis et eum nulla sunt voluptas.', 6, 1, 50, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(13, 'Delilah Jerde', 'Qui modi laudantium accusamus fugiat.', 5, 1, 44, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(14, 'Keagan Bashirian', 'Sint vel ut qui itaque.', 6, 1, 1, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(15, 'Dr. Alyson Schowalter DDS', 'Nihil aut sit ad tenetur sunt.', 4, 1, 47, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(16, 'David Cormier', 'Nesciunt laboriosam molestiae consequatur.', 4, 1, 1, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(17, 'Keira Williamson', 'Assumenda sunt soluta est non labore.', 5, 1, 48, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(18, 'Erwin Stark', 'Explicabo corrupti voluptates illum cum qui distinctio provident.', 6, 1, 49, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(19, 'Santos Littel I', 'Dolorem sunt sunt qui voluptates vero adipisci sapiente consequuntur.', 1, 1, 42, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(20, 'Pierce Shanahan', 'Facilis quo veniam aut ad eligendi dolorum.', 1, 1, 44, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(21, 'Vivienne Feest', 'Accusamus placeat omnis praesentium rerum dolor praesentium.', 7, 1, 47, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(22, 'Koby Kessler', 'Eos provident illum veniam provident facilis consequuntur voluptatem.', 3, 1, 44, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(23, 'Elda Dooley', 'Vitae et aperiam qui.', 1, 1, 42, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(24, 'Rollin Braun', 'Minima sapiente perferendis consectetur voluptas eaque.', 5, 1, 42, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(25, 'Declan Zulauf', 'Dolor culpa quasi dolorum fugit occaecati ad consectetur omnis.', 1, 1, 49, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(26, 'Christina Quitzon Jr.', 'Esse incidunt beatae veniam.', 7, 1, 49, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(27, 'Sabina Auer', 'Nam et omnis qui et accusamus blanditiis.', 2, 1, 50, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(28, 'Dr. Matteo Frami', 'Suscipit voluptates nemo ut hic assumenda.', 4, 1, 48, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(29, 'Laney Marks', 'Ut id consequuntur temporibus est nemo.', 1, 1, 46, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(30, 'Judson Steuber', 'Earum maxime quia non nemo occaecati dolores ut non.', 5, 1, 1, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(31, 'Prof. Aida Cruickshank I', 'Sint facilis excepturi aut magnam voluptas cupiditate expedita.', 3, 1, 46, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(32, 'Gerda Hahn', 'Qui sit rerum nostrum vero deserunt aspernatur eos.', 7, 1, 47, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(33, 'Mr. Louisa Corwin DDS', 'Quidem praesentium ipsa eius modi tenetur.', 3, 1, 44, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(34, 'Mr. Osborne Robel', 'Ea est inventore autem ipsa est.', 8, 1, 43, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(35, 'Hermina Erdman', 'Ipsam nobis vitae est est.', 1, 1, 41, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(36, 'Bulah Beahan', 'Enim fugiat autem et ut.', 8, 1, 45, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(37, 'Judge Breitenberg', 'Fugit aperiam numquam minima ea qui.', 8, 1, 45, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(38, 'Jamir Turcotte', 'Quia nulla voluptatum assumenda eum.', 2, 1, 49, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(39, 'Miss Ludie Carter', 'Aliquam earum pariatur ut ea.', 4, 1, 43, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(40, 'Mrs. Effie Botsford Jr.', 'Totam culpa deserunt iure commodi dicta rerum perspiciatis.', 7, 1, 46, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(41, 'Miss Dannie Wilkinson Jr.', 'Accusantium a dolorem a voluptatem illum.', 4, 1, 50, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(42, 'Gretchen McLaughlin', 'Repellat et ipsa illo eos.', 3, 1, 42, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(43, 'Dr. Torey VonRueden PhD', 'Ut qui exercitationem omnis.', 1, 1, 41, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(44, 'Prof. Brennan Labadie', 'Quasi aspernatur omnis esse aut.', 7, 1, 50, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(45, 'Blanca Kuhic', 'Repellat sed voluptatibus alias nisi quos.', 8, 1, 48, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(46, 'Jarrett Walter', 'Voluptates provident autem id iste iure omnis libero.', 5, 1, 47, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(47, 'Keegan Orn PhD', 'Aut voluptatibus id totam non eos sint.', 4, 1, 20, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(48, 'Celestine Hilpert', 'Quibusdam laudantium qui quis sapiente rerum quasi rerum.', 4, 1, 1, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(49, 'Sharon Heaney IV', 'Nostrum nostrum quo velit voluptatem rem enim quia voluptatem.', 2, 1, 41, '2023-10-18 19:10:33', '2023-10-18 19:10:33'),
(50, 'Adonis Osinski', 'Et et molestias quis nobis magni.', 3, 1, 41, '2023-10-18 19:10:33', '2023-10-18 19:10:33');

-- --------------------------------------------------------

--
-- Structure de la table `csm_societe`
--

DROP TABLE IF EXISTS `csm_societe`;
CREATE TABLE IF NOT EXISTS `csm_societe` (
  `id_societe` int(2) NOT NULL,
  `nom_soc` varchar(255) DEFAULT NULL,
  `contact_soc` varchar(50) DEFAULT NULL,
  `mail_soc` varchar(100) DEFAULT NULL,
  `adres_soc` longtext,
  `logo_soc` varchar(255) DEFAULT NULL,
  `pdf_aide` varchar(255) DEFAULT NULL,
  `pied_page_soc` longtext,
  `anneretraite` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `csm_societe`
--

INSERT INTO `csm_societe` (`id_societe`, `nom_soc`, `contact_soc`, `mail_soc`, `adres_soc`, `logo_soc`, `pdf_aide`, `pied_page_soc`, `anneretraite`, `created_at`, `updated_at`) VALUES
(1, 'GIWU-SOFT', '(229) 95 xx xx xx', 'giwudev@gmail.com', 'Cotonou - Bénin', 'Logo-2023-10-27-105103.jpeg', 'Aide-2022-11-22-025901.pdf', NULL, 60, NULL, '2023-10-27 09:51:03');

-- --------------------------------------------------------

--
-- Structure de la table `csm_transfert_courrierentrant`
--

DROP TABLE IF EXISTS `csm_transfert_courrierentrant`;
CREATE TABLE IF NOT EXISTS `csm_transfert_courrierentrant` (
  `id_trce` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_destina` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_desti` bigint(20) NOT NULL,
  `note_trce` text COLLATE utf8mb4_unicode_ci,
  `etat_trce` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_copie` text COLLATE utf8mb4_unicode_ci,
  `id_initi` bigint(20) UNSIGNED NOT NULL,
  `courier_id` bigint(20) UNSIGNED NOT NULL,
  `fichier_reponse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trce`),
  KEY `csm_transfert_courrierentrant_id_initi_foreign` (`id_initi`),
  KEY `csm_transfert_courrierentrant_courier_id_foreign` (`courier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_transfert_courrierentrant`
--

INSERT INTO `csm_transfert_courrierentrant` (`id_trce`, `type_destina`, `id_desti`, `note_trce`, `etat_trce`, `en_copie`, `id_initi`, `courier_id`, `fichier_reponse`, `created_at`, `updated_at`) VALUES
(1, 'dr', 2, 'DSI bonne réception', 'en', 'non', 1, 1, NULL, '2023-10-25 09:54:17', '2023-10-25 14:50:37'),
(2, 'se', 3, 'CSI bonne réception de la part du DSI', 'ec', 'non', 42, 1, NULL, '2023-10-25 09:55:27', '2023-10-25 09:55:27'),
(3, 'dr', 2, 'voila la réponse DSI... je suis le CSI', 'en', 'non', 41, 1, 'php413.tmp.pdf', '2023-10-25 10:00:44', '2023-10-25 14:50:37'),
(4, 'dr', 2, 'Pour traitement DSI', 'ec', 'non', 1, 2, NULL, '2023-10-25 10:06:09', '2023-10-25 10:06:09');

-- --------------------------------------------------------

--
-- Structure de la table `csm_users`
--

DROP TABLE IF EXISTS `csm_users`;
CREATE TABLE IF NOT EXISTS `csm_users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_infos_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_ini` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `image_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `type_fonct` text COLLATE utf8mb4_unicode_ci COMMENT 'dr=direction se=service di=Division\r\n',
  `id_fonct` bigint(20) DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_nais` date DEFAULT NULL,
  `date_embauche` date DEFAULT NULL,
  `date_retraite` date DEFAULT NULL,
  `echellon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `init_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csm_users`
--

INSERT INTO `csm_users` (`id`, `code`, `name`, `prenom`, `email`, `email_verified_at`, `password`, `remember_token`, `tel_user`, `other_infos_user`, `id_ini`, `id_role`, `image_profil`, `is_active`, `type_fonct`, `id_fonct`, `grade`, `matricule`, `date_nais`, `date_embauche`, `date_retraite`, `echellon`, `created_at`, `updated_at`, `init_id`) VALUES
(1, 'a40d4493-c471-462e-80ed-2bcdd2365c09', 'GIWU1', 'Richard1', 'richardtohon@gmail.com', NULL, '$2y$10$6QUE1GIJXGAd1NmEZtXAie/zMMih2hdA1RSKLhVJ6W8kjs04LU5AW', NULL, '9566179566', 'test', 1, 1, 'php1627.tmp.png', 1, 'se', 8, '9566666', NULL, '1998-05-02', '2000-01-19', '2060-01-19', 'ECHELLON TEST', '2022-06-20 14:06:09', '2023-10-26 10:53:35', NULL),
(20, '3a610854-2409-4858-a5dc-43dc6c38478e', 'Touré', 'Amara', 'amaratoure@gmail.com', NULL, '$2y$10$DrwHm6kegCceGtDfFyNwaeESst2k9RvtIIHGU3mYpL34xy3eITFY6', NULL, '-', NULL, 1, 15, 'defaut.jpg', 1, 'dr', 2, NULL, NULL, '1998-05-02', '2022-05-20', '2065-05-20', NULL, '2023-10-18 14:40:47', '2023-10-18 14:40:47', NULL),
(50, 'd4f50fd4-ccdd-461c-be14-9db6dafcc334', 'Fatai', 'ABDOU', 'cd@gmail.com', NULL, '$2y$10$5iMFMOjinO9uqonfdHzu5OZJRcYosWDuu.mwj7AW4yZI6cu0yOqNO', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'di', 10, 'GRADE', '956612', '1998-10-10', '2022-05-20', '2082-05-20', 'Echellon', NULL, '2023-10-24 15:03:56', 1),
(49, '64b3c125-24c3-4ef2-aff3-dcbd391ee0f3', 'Nom9', 'Prénom9', 'email9@example.com', NULL, '$2y$10$avBDoFQE334Y7CezXnVTv.IlGkycUBc0SViznzIRWcZ4NUEFQEgC6', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'se', NULL, NULL, NULL, '1998-05-02', '2022-05-20', '2082-05-20', NULL, NULL, NULL, 1),
(48, '82dbd2de-ab48-4224-ba7c-918bc7b7b3b6', 'Nom8', 'Prénom8', 'email8@example.com', NULL, '$2y$10$W/h3ZswDSRYs858601fyoehOSjo/j5p0C32qL3LbwblXLsDm0Rwzq', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'se', NULL, NULL, NULL, '1998-05-02', '2022-05-20', '2082-05-20', NULL, NULL, NULL, 1),
(47, 'f56db764-2d8e-4a91-850f-ef47c79e2004', 'Nom7', 'Prénom7', 'email7@example.com', NULL, '$2y$10$u8G7iVh19dAS0DVzz9RssOdCmlCxWnGOJbaHXKubHi.G7N37tAvkS', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'di', NULL, NULL, NULL, '1998-05-02', '2022-05-20', '2082-05-20', NULL, NULL, NULL, 1),
(46, '2aca93b6-7ed0-4bdd-850b-dda17d80c295', 'Nom6', 'Prénom6', 'email6@example.com', NULL, '$2y$10$HWaewTSxJJ2MbSl8hNU0SenKMTOTIwNngGAGCdLAoqL19oLMzoBeW', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'dr', NULL, NULL, NULL, '1998-05-02', '2022-05-20', '2082-05-20', NULL, NULL, NULL, 1),
(44, '481209ff-3c2b-4f8f-9eb2-1dc90bd8e10a', 'Nom4', 'Prénom4', 'email4@example.com', NULL, '$2y$10$Wa/xfCusJhnjDj8YWLHbMeym3taJPuosU7.Eg7ZYH7TrFrnkPfpRO', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'di', NULL, NULL, NULL, '1998-05-02', '2022-05-20', '2082-05-20', NULL, NULL, NULL, 1),
(45, '53659557-08aa-4d00-8fda-244c043c5157', 'Nom5', 'Prénom5', 'email5@example.com', NULL, '$2y$10$upmx/xwvpXkca5jsQ4mWL.FzorYUb6ECVrZMoLKI7sm36c2v6/PtC', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'se', NULL, NULL, NULL, '1998-05-02', '2020-10-20', '2082-05-20', NULL, NULL, NULL, 1),
(43, '58245fbd-3a74-448f-b7bc-f9e14ed7edba', 'Nom3', 'Prénom3', 'email3@example.com', NULL, '$2y$10$mUs0u3cZ3Ojo/xCc8BFEbO53x4hnSU12KqFN.hY4kOT4PFJdw2yBq', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'di', NULL, NULL, NULL, '1998-05-02', '2022-05-20', '2082-05-20', NULL, NULL, NULL, 1),
(42, '6ff386f9-0b9d-42ef-af0b-f31380c2b824', 'TOSSOU', 'Wilfried', 'dsi@gmail.com', NULL, '$2y$10$j/9DREssVWJVzOmPoTpY3eReSKJazqusTxqJ3wy4gycLhVITzqX.i', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'dr', 2, NULL, NULL, '1998-05-02', '2022-05-20', '2082-05-20', NULL, NULL, '2023-10-20 12:34:02', 1),
(41, 'a17f9c8d-1af1-4cae-925b-a084639f5e68', 'Maurille', 'AGBO', 'csi@gmail.com', NULL, '$2y$10$lbR6/Ivh.odgyUwPwTuq/.zSSrTkVGnNGJvqnWWOi59BdF2aiUBwO', NULL, '94 xx xx xx', NULL, 1, 15, NULL, 1, 'se', 3, 'frerr', '45666', '1998-05-02', '2022-05-20', '2082-05-20', 'eche', NULL, '2023-10-24 15:05:50', 1),
(51, 'bb3e7841-d657-4cfd-a1e9-205efb38303b', 'richard', 'Rich', 'richard@gmail.com', NULL, '$2y$10$11ukkuMWYl2T3EgCMMXezub3QsvoZJFAnaFThIY0Ygt/jAZHoR2BS', NULL, '-', NULL, 1, 15, 'defaut.jpg', 1, 'se', 41, NULL, NULL, '1998-05-02', '2021-04-12', '2082-05-20', NULL, '2023-10-20 10:13:07', '2023-10-20 10:13:07', NULL),
(52, '27890881-b848-497d-acc4-a1e977579910', 'TOHON', 'richard', 'richard123@gmail.com', NULL, '$2y$10$AJ9Aanst8RkMG877UQZCZuO.zhJqwBWNqRRefE8TyNf9DEyWw8j5S', NULL, '95666624', 'test636', 1, 15, 'defaut.jpg', 1, 'dr', 2, 'GRADE12', '9566', '1998-05-02', '2000-08-04', '2082-05-20', 'ECHELLON', '2023-10-24 11:30:48', '2023-10-24 11:47:43', NULL),
(53, NULL, 'Richard', NULL, 'dsqdqsdq@gmail.com', NULL, '$2y$10$AsaC062CRyALoVF2Y3S13OONxVDucWpt0G1UB4pv0FyvAkn5.aYX2', NULL, NULL, NULL, 1, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-28 19:12:04', '2023-10-28 19:12:04', NULL),
(54, NULL, 'Richard', NULL, 'dsqdqsdq@gmail.com', NULL, '$2y$10$aa.GVOHiMsN9zRCwiI1cBuvUlgKn4iag9/zLpjdjOzPzxay4jx1N6', NULL, NULL, NULL, 1, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-28 19:12:24', '2023-10-28 19:12:24', NULL),
(55, NULL, 'Richard', NULL, 'richard@gmail.com', NULL, '$2y$10$zqedSrOn/LSx0MsU9UcmQujWYTnN.UmoHyhrVWTpreMLxK7ZvlyDK', NULL, NULL, NULL, 1, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-28 19:20:43', '2023-10-28 19:20:43', NULL),
(56, NULL, 'Richard', NULL, 'richard@gmail.com', NULL, '$2y$10$iBirNkDGdwQfBstzUsIHeOwpr6RAsdftAmMjhKyRoTJV9eecfUBk.', NULL, NULL, NULL, 1, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-28 19:21:20', '2023-10-28 19:21:20', NULL),
(57, NULL, 'richard', NULL, 'richard1@gmail.com', NULL, '$2y$10$m.J2bNKIGM/rgORh1JAYrO.U9pSIk.GrByh2gA1Mn2C9JWBQFNKWO', NULL, NULL, NULL, 1, 17, NULL, NULL, NULL, NULL, NULL, '95661754', NULL, NULL, '2083-10-28', NULL, '2023-10-28 21:12:58', '2023-10-28 21:13:14', NULL),
(58, NULL, 'azazaza', NULL, 'ririri@gmail.com', NULL, '$2y$10$7I77uK6gNj0WpJp4nwLB9.Ttof4fhq.97OfMG42/k79N7lEbQDaXe', NULL, NULL, NULL, 1, 17, NULL, NULL, NULL, NULL, NULL, '789456', NULL, NULL, NULL, NULL, '2023-10-28 21:15:23', '2023-10-28 21:15:23', NULL),
(59, NULL, 'aaa', NULL, 'yuyuy@gmail.com', NULL, '$2y$10$gbum5wHJFX8w7B./k/uPx.AI4fc/sowO79r6.opJB1V454rdIK74y', NULL, NULL, NULL, 1, 17, NULL, 1, NULL, NULL, NULL, 'hffhfg', NULL, NULL, NULL, NULL, '2023-11-01 08:36:46', '2023-11-01 08:36:46', NULL),
(60, NULL, 'TOHO', NULL, 'giwusdfsfsdfds@gmail.com', NULL, '$2y$10$nAtavThcnC9E/WGcgCHwiuVDHwByvJgI2xD2doXbqa/TFVESIuoU6', NULL, NULL, NULL, 1, 17, NULL, 1, NULL, NULL, NULL, '798998', NULL, NULL, NULL, NULL, '2023-12-11 09:58:55', '2023-12-11 09:58:55', NULL),
(61, NULL, 'tohono', NULL, 'azazazazaz@gmail.com', NULL, '$2y$10$pwalRap38iD5ty1CKRHibu3KQaRPgJnuxr9BnNRMluDcvKA1ZVc2m', NULL, NULL, NULL, 1, 17, 'defaut.jpg', 1, NULL, NULL, NULL, '159632', NULL, NULL, NULL, NULL, '2023-12-11 10:05:37', '2023-12-11 10:05:37', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `formation_migrations`
--

DROP TABLE IF EXISTS `formation_migrations`;
CREATE TABLE IF NOT EXISTS `formation_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation_migrations`
--

INSERT INTO `formation_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_10_18_171_CreerCsmdirectionTable', 1),
(5, '2023_10_18_172_CreerCsmserviceTable', 4),
(3, '2023_10_18_173_CreerCsmdivisionTable', 3),
(6, '2023_10_18_175_CreerCsmexpediteurTable', 5),
(7, '2023_10_18_174_CreerCsmcourrierTable', 6),
(10, '2023_10_18_176_CreerCsmtransfertcourrierentrantTable', 7),
(12, '2023_10_18_177_CreerCsmcourriersortantTable', 8),
(14, '2023_10_18_178_CreerCsmarchiveTable', 9),
(15, '2023_10_18_179_CreerCsmcarriereTable', 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
