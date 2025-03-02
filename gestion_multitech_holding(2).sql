-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 02 mars 2025 à 19:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_multitech_holding`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

CREATE TABLE `chambres` (
  `id` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `prix_sieste` int(100) NOT NULL,
  `prix_nuitee` int(100) NOT NULL,
  `motel_id` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`id`, `numero`, `prix_sieste`, `prix_nuitee`, `motel_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
('3e2dd619-f771-11ef-a294-24418c1325d5', '104', 5000, 13000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:18:43', '2025-03-02 15:18:43'),
('3e2de40a-f771-11ef-a294-24418c1325d5', '104', 5000, 12500, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:18:43', '2025-03-02 15:18:43'),
('3e2de4c9-f771-11ef-a294-24418c1325d5', '104', 5000, 12000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:18:43', '2025-03-02 15:18:43'),
('61ddbff7-f771-11ef-a294-24418c1325d5', '105', 5000, 13000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:19:43', '2025-03-02 15:19:43'),
('61ddcd00-f771-11ef-a294-24418c1325d5', '105', 5000, 12500, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:19:43', '2025-03-02 15:19:43'),
('61ddcde4-f771-11ef-a294-24418c1325d5', '105', 5000, 12000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:19:43', '2025-03-02 15:19:43'),
('a6bb37ac-f771-11ef-a294-24418c1325d5', '106', 7000, 15000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:21:38', '2025-03-02 15:21:38'),
('a6bb5008-f771-11ef-a294-24418c1325d5', '106', 7000, 14000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:21:38', '2025-03-02 15:21:38'),
('a6bb508a-f771-11ef-a294-24418c1325d5', '106', 7000, 13500, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:21:38', '2025-03-02 15:21:38'),
('ad8deaed-f771-11ef-a294-24418c1325d5', '107', 10000, 25000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:21:50', '2025-03-02 15:21:50'),
('ad8e0ac7-f771-11ef-a294-24418c1325d5', '107', 10000, 22000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:21:50', '2025-03-02 15:21:50'),
('ad8e0b6e-f771-11ef-a294-24418c1325d5', '107', 10000, 23000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:21:50', '2025-03-02 15:21:50'),
('e488aa73-f770-11ef-a294-24418c1325d5', '103', 3000, 8000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:16:13', '2025-03-02 15:16:13'),
('e488bc41-f770-11ef-a294-24418c1325d5', '103', 3000, 7500, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:16:13', '2025-03-02 15:16:13'),
('e488bd4a-f770-11ef-a294-24418c1325d5', '103', 3000, 7000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-02 15:16:13', '2025-03-02 15:16:13'),
('edca3a58-f6c7-11ef-a294-24418c1325d5', '101', 5000, 10000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-01 19:06:42', '2025-03-01 19:06:42'),
('edca6553-f6c7-11ef-a294-24418c1325d5', '101', 5000, 9500, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-01 19:06:42', '2025-03-01 19:06:42'),
('edca667f-f6c7-11ef-a294-24418c1325d5', '101', 5000, 9000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-01 19:06:42', '2025-03-01 19:06:42'),
('edca66ce-f6c7-11ef-a294-24418c1325d5', '102', 5000, 10000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-01 19:06:42', '2025-03-01 19:06:42'),
('edca66f4-f6c7-11ef-a294-24418c1325d5', '102', 5000, 9500, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-01 19:06:42', '2025-03-01 19:06:42'),
('edca6716-f6c7-11ef-a294-24418c1325d5', '102', 5000, 9000, '3f22-ded3-02e0-4e3a-86d1', '0', '2025-03-01 19:06:42', '2025-03-01 19:06:42');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `num_cni` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `motel_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `num_cni`, `phone`, `address`, `added_by`, `motel_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
('49ce-cea5-17d2-49e4-873f', 'Lance Beach', '', 'CNI123456799', '+1 (724) 222-6765', '123 Rue de l\'Innovation', 'bb95-7bfb-133d-4396-8dab', '3f22-ded3-02e0-4e3a-86d1', '2025-02-28 18:52:27', '2025-02-28 18:52:27', 0),
('6700-df38-bcd6-4daf-818c', 'Joan Benson', '', 'CNI123456789', '+1 (521) 753-6129', '4567 Rue de l\'Exemple, Paris, 75001', 'bb95-7bfb-133d-4396-8dab', '3f22-ded3-02e0-4e3a-86d1', '2025-02-28 18:49:28', '2025-03-02 12:56:11', 0),
('f131-3755-c6ce-4af4-af37', 'Lavinia', 'Adkins', 'CNI345678901', '+1 (326) 253-8994', '4567 Rue de l\'Exempl', 'bb95-7bfb-133d-4396-8dab', '3f22-ded3-02e0-4e3a-86d1', '2025-02-28 19:05:22', '2025-02-28 19:05:22', 0);

-- --------------------------------------------------------

--
-- Structure de la table `motel`
--

CREATE TABLE `motel` (
  `id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `motel`
--

INSERT INTO `motel` (`id`, `name`, `address`, `contact_email`, `contact_phone`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
('3554-99e1-ba00-442a-bc72', 'Motel VI', 'tajomol@mailinator.com', 'qojyjepove@mailinator.com', 'qutu@mailinator.com', 'Cumque pariatur Dui', 'active', 1, '2025-02-28 17:09:43', '2025-02-28 17:16:40'),
('3f22-ded3-02e0-4e3a-86d1', 'Résidence Japonaise', 'wexyxoqowo@mailinator.com', 'fulyz@mailinator.com', 'risem@mailinator.com', 'Dolor consectetur e', 'active', 0, '2025-02-28 17:00:58', '2025-02-28 17:00:58'),
('5ffc-22ba-2f35-41ed-be5f', 'Motel La Fortune', 'wewyfe@mailinator.com', 'sepacyquw@mailinator.com', 'totepen@mailinator.c', 'Expedita ex perferen', 'active', 0, '2025-02-28 16:51:10', '2025-02-28 16:51:10'),
('90a1-8ed0-c427-416a-a6bf', 'Motel La fortune De Douala', 'tajomol@mailinator.com', 'qojyjepove@mailinator.com', 'qutu@mailinator.com', 'Cumque pariatur Dui', 'active', 0, '2025-02-28 17:00:01', '2025-02-28 17:00:01'),
('cc14-f5d3-4428-4478-9da3', 'Motel III', 'tajomol@mailinator.com', 'qojyjepove@mailinator.com', 'qutu@mailinator.com', 'Cumque pariatur Dui', 'active', 0, '2025-02-28 17:10:10', '2025-02-28 17:10:10'),
('ee70-8094-dc86-49ab-bfbb', 'Motel Gabonais', 'xebyrycad@mailinator.com', 'celazyry@mailinator.com', 'laxucovoz@mailinator', 'Fugit expedita modi', 'active', 0, '2025-03-01 20:29:37', '2025-03-01 20:37:26');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_nuitee`
--

CREATE TABLE `reservation_nuitee` (
  `id` varchar(255) NOT NULL,
  `type_chambre` varchar(255) NOT NULL,
  `type_service` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `id_motel` varchar(255) NOT NULL,
  `prix` varchar(100) DEFAULT NULL,
  `date_entre` datetime NOT NULL,
  `date_sortie` datetime DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) NOT NULL,
  `status` enum('en cours','terminée') NOT NULL DEFAULT 'en cours',
  `added_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_nuitee`
--

INSERT INTO `reservation_nuitee` (`id`, `type_chambre`, `type_service`, `numero`, `id_motel`, `prix`, `date_entre`, `date_sortie`, `client_id`, `is_deleted`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
('02ae-8cb1-affa-42cb-b4d8', 'Chambre VIP', 'NUITEE', '107', '3f22-ded3-02e0-4e3a-86d1', '25000', '2025-03-03 10:00:00', '2025-03-04 12:00:00', '6700-df38-bcd6-4daf-818c', '0', 'en cours', 'bb95-7bfb-133d-4396-8dab', '2025-03-02 16:08:37', '2025-03-02 16:08:37'),
('30a7-f048-3eaf-4687-8df2', 'Chambre standard', 'NUITEE', '102', '3f22-ded3-02e0-4e3a-86d1', '10000', '2025-03-02 17:03:00', '2025-03-03 12:00:00', 'f131-3755-c6ce-4af4-af37', '0', 'en cours', 'bb95-7bfb-133d-4396-8dab', '2025-03-02 16:04:28', '2025-03-02 16:04:28'),
('4369-6688-5094-4ba0-b99e', 'Chambre VIP', 'NUITEE', '105', '3f22-ded3-02e0-4e3a-86d1', '12000', '2025-03-02 20:12:00', '2025-03-03 12:00:00', '49ce-cea5-17d2-49e4-873f', '0', 'en cours', '719a-bec0-3b45-482c-a331', '2025-03-02 18:11:53', '2025-03-02 18:11:53');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_sieste`
--

CREATE TABLE `reservation_sieste` (
  `id` varchar(255) NOT NULL,
  `type_chambre` varchar(255) NOT NULL,
  `type_service` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `id_motel` varchar(255) NOT NULL,
  `prix` int(100) DEFAULT NULL,
  `date_entre` time NOT NULL,
  `date_sortie` time DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) NOT NULL,
  `status` enum('en cours','terminée') NOT NULL DEFAULT 'en cours',
  `added_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_sieste`
--

INSERT INTO `reservation_sieste` (`id`, `type_chambre`, `type_service`, `numero`, `id_motel`, `prix`, `date_entre`, `date_sortie`, `client_id`, `is_deleted`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
('2593-45c4-e15b-4b54-86e7', 'Chambre standard', 'SIESTE', '101', '3f22-ded3-02e0-4e3a-86d1', 5000, '15:46:00', '17:46:00', '6700-df38-bcd6-4daf-818c', '0', 'en cours', 'bb95-7bfb-133d-4396-8dab', '2025-03-02 14:48:59', '2025-03-02 15:17:47'),
('29d7-c607-c379-4297-be67', 'Chambre Simple', 'SIESTE', '102', '3f22-ded3-02e0-4e3a-86d1', 5000, '16:20:00', '18:20:00', '49ce-cea5-17d2-49e4-873f', '0', 'en cours', 'bb95-7bfb-133d-4396-8dab', '2025-03-02 15:20:47', '2025-03-02 15:20:47'),
('7484-0434-c128-4ea7-99bd', 'Chambre Simple', 'SIESTE', '103', '3f22-ded3-02e0-4e3a-86d1', 3000, '19:17:00', '21:17:00', '6700-df38-bcd6-4daf-818c', '0', 'en cours', '719a-bec0-3b45-482c-a331', '2025-03-02 18:17:43', '2025-03-02 18:17:43'),
('caa4-d074-0f19-4fd5-add5', 'Chambre VIP', 'SIESTE', '106', '3f22-ded3-02e0-4e3a-86d1', 7000, '17:22:00', '19:22:00', 'f131-3755-c6ce-4af4-af37', '0', 'en cours', 'bb95-7bfb-133d-4396-8dab', '2025-03-02 15:22:40', '2025-03-02 15:22:40');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `address`, `contact_email`, `contact_phone`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
('de5c11e1-f6cd-11ef-9cb8-d8cb8a12514d', 'Le Gourmet', '12 Avenue des Délices, Paris', 'contact@gourmet.fr', '+33123456789', 'Restaurant gastronomique offrant une cuisine raffinée.', 'active', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('de5e7979-f6cd-11ef-9cb8-d8cb8a12514d', 'La Brasserie Royale', '5 Rue du Palais, Lyon', 'contact@brasserieroyale.fr', '+33456781234', 'Brasserie traditionnelle avec une ambiance chaleureuse.', 'active', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('de5e7a77-f6cd-11ef-9cb8-d8cb8a12514d', 'Chez Luigi', '22 Piazza Roma, Milan', 'info@chezluigi.it', '+390212345678', 'Pizzeria italienne réputée pour ses pizzas au feu de bois.', 'active', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Sakura Sushi', '8 Chuo-ku, Tokyo', 'info@sakurasushi.jp', '+81398765432', 'Spécialiste des sushis et plats japonais authentiques.', 'inactive', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('de5e7ae7-f6cd-11ef-9cb8-d8cb8a12514d', 'The Steakhouse', '47 Downtown Street, New York', 'contact@steakhouse.com', '+12125551234', 'Steakhouse américain proposant des viandes de qualité.', 'active', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('f4d0-7e07-3f83-4bdd-9702', 'restau la fortune', 'yde', 'lafortune@gmail.com', '+123 678862852', 'jolie', 'active', 1, '2025-03-01 19:33:23', '2025-03-02 16:32:31');

-- --------------------------------------------------------

--
-- Structure de la table `types_chambres`
--

CREATE TABLE `types_chambres` (
  `id` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types_chambres`
--

INSERT INTO `types_chambres` (`id`, `name`, `description`, `is_deleted`, `created_at`, `updated_at`) VALUES
('23b4ec1a-f6c6-11ef-9cb8-d8cb8a12514d', 'Chambre VIP', 'Chambre de luxe avec services exclusifs', '0', '2025-03-01 18:53:53', '2025-03-01 18:53:53'),
('23b5dc59-f6c6-11ef-9cb8-d8cb8a12514d', 'Chambre Standard', 'Chambre classique avec équipements de base', '0', '2025-03-01 18:53:53', '2025-03-01 18:53:53'),
('23b5dd72-f6c6-11ef-9cb8-d8cb8a12514d', 'Chambre Simple', 'Chambre économique avec confort minimal', '0', '2025-03-01 18:53:53', '2025-03-01 18:53:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive','suspended') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `address`, `phone_number`, `password`, `photo`, `role`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
('34fa-6718-b5c8-4dcc-8449', 'Samson', 'Small', 'manekengsorelle99@gmail.com', 'Aliquip cum tempore', '+1 (904) 895-7703', '$2y$10$gcMW9cdXHY.rZJ2ypw6Fu./IuO76CIgTGMOqdWg3W.wYWIH5Pg1JO', '67c1cf93cbaa3_images.jpeg', 'admin', 0, 'active', '2025-02-28 15:00:35', '2025-02-28 19:50:47'),
('64d8-6c65-9a3a-4b27-9838', 'Unity', 'Kane', 'waxirefo@mailinator.com', 'Quod omnis veritatis', '+1 (882) 236-5024', '$2y$10$UjNGohmbQQNiwVXkAVVcEurlO2QJtln2L0aikobF2p1s1.unLEPBa', NULL, 'admin', 1, 'active', '2025-02-28 13:55:24', '2025-02-28 14:04:34'),
('6fbc-5e43-4760-4b57-ab4c', 'Cheryl', 'Rutledge', 'pizir@mailinator.com', 'Eum sint amet conse', '+1 (987) 706-3406', '$2y$10$6mTaMlNLvJx2yUOX/rOrHeY6lMhedHkm.YMTYMI1RMrKevuWgiW3W', NULL, 'admin', 0, 'active', '2025-02-28 13:55:37', '2025-02-28 13:55:37'),
('719a-bec0-3b45-482c-a331', 'Zephania', 'Steele', 'roosveltkuenkam237@gmail.com', 'Ratione nihil rerum ', '+1 (624) 812-4146', '$2y$10$DIBVORcNGW1aY7ifaNS0M.sVylzi7tiiCjyCLjin/hLYbDyz//F1C', NULL, 'admin', 0, 'active', '2025-02-28 14:54:19', '2025-03-02 17:56:45'),
('8226-7654-379e-454e-8459', 'Laurent ', 'Alphonse', 'admin@gmail.com', '123 Rue de Paris, Paris, France', '612891290', '$2y$10$s.DIfIFXIWesGeN6WkbKdeKNgmeIjcVQ1k3Ap/kquZJa5Il6JDUI6', '67c1bab443bf3_images.png', 'super_admin', 0, 'active', '2025-02-28 13:31:32', '2025-02-28 19:58:11'),
('9ba6-16fa-065b-4245-88e6', 'Kenyon', 'Estrada', 'bavetyfeke@mailinator.com', 'Aut est consequatur', '+1 (315) 609-5792', '$2y$10$QBOzUCh2fE7ieh8ofGirueldYeLmE/.vi/PFNWOPGknOW5pcemGMu', NULL, 'admin', 1, 'active', '2025-02-28 13:29:12', '2025-02-28 14:03:11'),
('a4d4-cdc8-c90b-4b82-a1bf', 'Lester', 'Farmer', 'wapumufy@mailinator.com', 'Doloremque recusanda', '+1 (467) 438-9514', '$2y$10$1xCDAvxdj/1Mti/NQxmxwewubqc0eIThEX12h/Pg8ZkcT1t4O2ZGG', NULL, 'admin', 0, 'inactive', '2025-02-28 13:55:32', '2025-02-28 15:14:33'),
('bb95-7bfb-133d-4396-8dab', 'Tanisha', 'Knight', 'manekengsorelle94@gmail.com', 'Ratione in Nam magna', '+1 (865) 967-6675', '$2y$10$gjfadqVkM2SKIRUkEUtFoOECMNeIJ7QIFe9I0ROOfBsGCQMp/7J2m', NULL, 'admin', 0, 'active', '2025-02-28 15:03:33', '2025-02-28 18:13:16'),
('e7a3-08e5-2ec5-454d-b19d', 'Reece', 'Austin', 'direnevami@mailinator.com', 'Reprehenderit ab ul', '+1 (126) 496-7742', '$2y$10$7Id3C0VnlDsLaqqFc/6O/.MXUoJwJiPPeqfedhcmxcFdGMv1hHs/O', NULL, 'admin', 1, 'active', '2025-02-28 13:53:12', '2025-02-28 14:03:38');

-- --------------------------------------------------------

--
-- Structure de la table `user_motel`
--

CREATE TABLE `user_motel` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `motel_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_motel`
--

INSERT INTO `user_motel` (`id`, `user_id`, `motel_id`, `created_at`, `updated_at`) VALUES
('15f8-3ad7-c97c-4677-8e01', 'bb95-7bfb-133d-4396-8dab', '3f22-ded3-02e0-4e3a-86d1', '2025-02-28 17:53:47', '2025-02-28 17:53:47'),
('5660-545a-cbf7-49b1-8ab7', '719a-bec0-3b45-482c-a331', '3f22-ded3-02e0-4e3a-86d1', '2025-02-28 17:53:01', '2025-02-28 17:53:01'),
('977b-16f5-abc2-4b77-8ca1', 'a4d4-cdc8-c90b-4b82-a1bf', '5ffc-22ba-2f35-41ed-be5f', '2025-02-28 19:51:23', '2025-02-28 19:51:23'),
('a50c-da44-235e-4bfb-905f', '34fa-6718-b5c8-4dcc-8449', '3f22-ded3-02e0-4e3a-86d1', '2025-02-28 17:53:54', '2025-02-28 17:53:54');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motel_id` (`motel_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num_cni` (`num_cni`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `motel_id` (`motel_id`);

--
-- Index pour la table `motel`
--
ALTER TABLE `motel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `reservation_nuitee`
--
ALTER TABLE `reservation_nuitee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `id_motel` (`id_motel`);

--
-- Index pour la table `reservation_sieste`
--
ALTER TABLE `reservation_sieste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_motel` (`id_motel`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `types_chambres`
--
ALTER TABLE `types_chambres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_motel`
--
ALTER TABLE `user_motel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motel_id` (`motel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD CONSTRAINT `chambres_ibfk_1` FOREIGN KEY (`motel_id`) REFERENCES `motel` (`id`);

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`motel_id`) REFERENCES `motel` (`id`);

--
-- Contraintes pour la table `reservation_nuitee`
--
ALTER TABLE `reservation_nuitee`
  ADD CONSTRAINT `reservation_nuitee_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservation_nuitee_ibfk_2` FOREIGN KEY (`id_motel`) REFERENCES `motel` (`id`);

--
-- Contraintes pour la table `reservation_sieste`
--
ALTER TABLE `reservation_sieste`
  ADD CONSTRAINT `reservation_sieste_ibfk_1` FOREIGN KEY (`id_motel`) REFERENCES `motel` (`id`),
  ADD CONSTRAINT `reservation_sieste_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservation_sieste_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Contraintes pour la table `user_motel`
--
ALTER TABLE `user_motel`
  ADD CONSTRAINT `user_motel_ibfk_1` FOREIGN KEY (`motel_id`) REFERENCES `motel` (`id`),
  ADD CONSTRAINT `user_motel_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
