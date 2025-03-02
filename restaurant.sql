-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 02 mars 2025 à 17:28
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

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
('de5c11e1-f6cd-11ef-9cb8-d8cb8a12514d', 'Le Gourmet', '12 Avenue des Délices, Paris', 'contact@gourmet.fr', '+33123456789', 'Restaurant gastronomique offrant une cuisine raffinée.', 'active', 0, '2025-03-01 18:49:12', '2025-03-01 18:49:12'),
('de5e7979-f6cd-11ef-9cb8-d8cb8a12514d', 'La Brasserie Royale', '5 Rue du Palais, Lyon', 'contact@brasserieroyale.fr', '+33456781234', 'Brasserie traditionnelle avec une ambiance chaleureuse.', 'active', 0, '2025-03-01 18:49:12', '2025-03-01 18:49:12'),
('de5e7a77-f6cd-11ef-9cb8-d8cb8a12514d', 'Chez Luigi', '22 Piazza Roma, Milan', 'info@chezluigi.it', '+390212345678', 'Pizzeria italienne réputée pour ses pizzas au feu de bois.', 'active', 0, '2025-03-01 18:49:12', '2025-03-01 18:49:12'),
('de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Sakura Sushi', '8 Chuo-ku, Tokyo', 'info@sakurasushi.jp', '+81398765432', 'Spécialiste des sushis et plats japonais authentiques.', 'inactive', 0, '2025-03-01 18:49:12', '2025-03-01 18:49:12'),
('de5e7ae7-f6cd-11ef-9cb8-d8cb8a12514d', 'The Steakhouse', '47 Downtown Street, New York', 'contact@steakhouse.com', '+12125551234', 'Steakhouse américain proposant des viandes de qualité.', 'active', 0, '2025-03-01 18:49:12', '2025-03-01 18:49:12'),
('f4d0-7e07-3f83-4bdd-9702', 'restau la fortune', 'yde', 'lafortune@gmail.com', '+123 678862852', 'jolie', 'active', 0, '2025-03-01 20:33:23', '2025-03-01 20:33:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
