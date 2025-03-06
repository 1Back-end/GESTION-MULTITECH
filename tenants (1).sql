-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 mars 2025 à 17:48
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
-- Structure de la table `tenants`
--

CREATE TABLE `tenants` (
  `id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `num_cni` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `property_type` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tenants`
--

INSERT INTO `tenants` (`id`, `first_name`, `last_name`, `num_cni`, `phone`, `address`, `added_by`, `owner_id`, `created_at`, `property_type`, `is_deleted`) VALUES
('14df-2c69-9743-4742-b59d', 'Laurent 44', 'jean', 'cni123456521', '652478950', 'yde', 'bb95-7bfb-133d-4396-8dab', NULL, '2025-03-06 09:46:56', 'DUPLEX', 0),
('6622-3ea4-a640-4d97-88b1', 'rooso', 'jean', 'cni1234528541', '678862852', 'yde', 'bb95-7bfb-133d-4396-8dab', NULL, '2025-03-06 14:12:32', 'Camp', 0),
('6938-675f-f721-47ee-b1b6', 'Laurent 44', 'jean', 'cni123452589', '678862852', 'yde', 'bb95-7bfb-133d-4396-8dab', NULL, '2025-03-06 10:51:07', 'DUPLEX', 0),
('aea4-a750-8aab-492a-adc3', 'Laurent 5', 'jean', 'cni123456789', '652478950', 'yde', 'bb95-7bfb-133d-4396-8dab', NULL, '2025-03-06 09:32:58', 'DUPLEX', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num_cni` (`num_cni`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
