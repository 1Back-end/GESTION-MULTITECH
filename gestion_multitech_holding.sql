-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 juin 2025 à 20:56
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
-- Structure de la table `agents_for_agency`
--

CREATE TABLE `agents_for_agency` (
  `uuid` varchar(100) NOT NULL,
  `agency_uuid` varchar(100) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone_2` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` varchar(100) DEFAULT NULL,
  `cni_number` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agents_for_agency`
--

INSERT INTO `agents_for_agency` (`uuid`, `agency_uuid`, `fullname`, `email`, `phone`, `phone_2`, `position`, `photo`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `added_by`, `cni_number`, `address`) VALUES
('457c-fa6f-07ed-4802-8b92', 'c0cc-1ef0-0933-4374-8085', 'Laurent Alphonse', 'test@gmail.com', '65423776889', '', 'Livreur', 'agent_68499e520ab965.47403404.jpeg', 1, 0, '2025-06-11 15:18:42', '2025-06-11 17:49:52', '8ca1-ff26-3de6-4279-af58', 'CNI8765345467', '90 Place des Marchés'),
('8f5d-4151-e86a-4f45-9e00', 'c0cc-1ef0-0933-4374-8085', 'ETOUDI BODO', 'partenaire1@gmail.com', '6542378765', '653890913', 'Ramasseur', '1bec-4f15-1694-464d-813b.png', 1, 0, '2025-06-11 15:24:25', '2025-06-11 18:03:12', '8ca1-ff26-3de6-4279-af58', 'CNI876534587', '123 Rue Principale, YaoundéII'),
('c962-25ee-1fdc-4a15-bac0', 'c0cc-1ef0-0933-4374-8085', 'cifu@mailinator.com', 'purojezyve@mailinator.com', '678536865', '+1 (706) 695-4988', 'Ramasseur', NULL, 1, 0, '2025-06-11 15:47:12', '2025-06-11 19:50:54', '8ca1-ff26-3de6-4279-af58', 'CNI8765345765253', '123 Rue Principale, Yaoundé');

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
('b801-f18d-9ab0-406e-85fb', 'MacKensie', 'Calhoun', 'CNI456789012', '+1 (267) 668-3189', '4567 Rue de l\'Exempl', 'bb95-7bfb-133d-4396-8dab', '3f22-ded3-02e0-4e3a-86d1', '2025-03-04 10:39:42', '2025-03-04 10:39:42', 0),
('ca29-5cef-c65d-40cf-b867', 'Althea', 'Morgan', '+1 (657) 278-4224', '+1 (325) 991-4382', '+1 (685) 962-6416', 'bb95-7bfb-133d-4396-8dab', '3f22-ded3-02e0-4e3a-86d1', '2025-03-07 18:11:25', '2025-03-07 18:11:25', 0),
('f131-3755-c6ce-4af4-af37', 'Lavinia', 'Adkins', 'CNI345678901', '+1 (326) 253-8994', '4567 Rue de l\'Exempl', 'bb95-7bfb-133d-4396-8dab', '3f22-ded3-02e0-4e3a-86d1', '2025-02-28 19:05:22', '2025-02-28 19:05:22', 0);

-- --------------------------------------------------------

--
-- Structure de la table `clients_abonnes`
--

CREATE TABLE `clients_abonnes` (
  `uuid` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel1` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel2` varchar(255) DEFAULT NULL,
  `cni_number` varchar(255) NOT NULL,
  `price_for_abonnement` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `stock_total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients_abonnes`
--

INSERT INTO `clients_abonnes` (`uuid`, `firstname`, `lastname`, `email`, `tel1`, `address`, `tel2`, `cni_number`, `price_for_abonnement`, `created_at`, `updated_at`, `added_by`, `is_deleted`, `is_active`, `stock_total`) VALUES
('24bc-09eb-7241-4338-bd25', 'Laurent', 'Alphonse', 'luis@example123.com', '678536884', '90 Place des Marchés', '689095423', 'CNI8765345E', '25000', '2025-06-08 15:43:06', NULL, '8226-7654-379e-454e-8459', 0, 1, 0),
('290e-13d1-ad10-47a7-8c2c', 'Zacharie', 'Dogo', 'maneuh@gmail.com', '678096543', 'Limbé , Cameroun', '689095420', 'CNI8765345E', '50000', '2025-06-08 15:44:10', '2025-06-09 02:17:52', '8226-7654-379e-454e-8459', 0, 1, 17),
('438d-803b-f72c-44e5-85e9', 'Tinto', 'Fabiona', 'chouchou@gmail.com', '6780965434', 'Yaoundé,Cameroun', '689095420', 'CNI8765345787', '75000', '2025-06-08 16:02:45', '2025-06-09 01:59:51', '8226-7654-379e-454e-8459', 0, 1, 50),
('5469-3903-0dad-4f8d-ae16', 'Paula', 'Norris', 'bihico@mailinator.com', '6780965434', 'Edéa Cameroun', '689095400', 'CNI8765345467', '76000', '2025-06-09 00:10:07', '2025-06-11 19:49:40', '8226-7654-379e-454e-8459', 0, 1, 40),
('eade-08ce-91a7-4c67-88a8', 'William', 'Dev', 'williamdev@gmail.com', '678127812', '15 Avenue Portuaire, Douala', '689095499', 'CNI8765345467', '54000', '2025-06-08 16:21:18', '2025-06-08 23:21:44', '8226-7654-379e-454e-8459', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `client_products`
--

CREATE TABLE `client_products` (
  `uuid` varchar(255) NOT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `client_uuid` char(36) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(12,2) NOT NULL,
  `weight` decimal(8,3) DEFAULT NULL,
  `declared_value` decimal(12,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `added_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client_products`
--

INSERT INTO `client_products` (`uuid`, `ref`, `client_uuid`, `product_name`, `category`, `quantity`, `price`, `weight`, `declared_value`, `description`, `product_image`, `created_at`, `updated_at`, `is_deleted`, `added_by`) VALUES
('530b-9848-0497-42ab-864b', 'PR-20250609-BE3DA3', '5469-3903-0dad-4f8d-ae16', 'Iphone 11', 'Electronique', 40, 3500.00, 2.700, NULL, 'n addition to our border-radius utilities, you can use .img-thumbnail to give an image a rounded 1px border appearance.', '4fd5-c1e7-8c95-4a63-b159.jpeg', '2025-06-09 09:16:02', '2025-06-11 13:58:43', 0, '8226-7654-379e-454e-8459'),
('68461702-4f14-8003-bc92-e5adb9ab3c3b', 'PR-20250609-A1B2C3  ', '438d-803b-f72c-44e5-85e9', 'Montre Connectée', 'Electronique', 5, 199.99, 0.250, 180.00, 'Montre connectée avec écran OLED, Bluetooth et cardiofréquencemètre.', '645b-a63c-2f2d-4eb8-a8f5.png', '2025-06-09 00:49:35', '2025-06-09 19:00:38', 0, '8226-7654-379e-454e-8459'),
('b7ce-c8d7-6a9a-4f43-9414', 'PR-20250609-4F6D9E', '290e-13d1-ad10-47a7-8c2c', 'Cahier', 'Papeterie', 17, 3.00, NULL, NULL, 'Cahier format A4, 100 pages', 'f1c3-1e76-e907-4816-9ecd.jpeg', '2025-06-09 01:01:07', '2025-06-09 19:02:53', 0, '8226-7654-379e-454e-8459'),
('ca64-793a-b165-4a51-a5f9', 'PR-20250609-C7E1A8', '438d-803b-f72c-44e5-85e9', 'Papeterie', 'Papeterie', 45, 1.25, 0.010, 0.50, 'Stylo bille à encre bleue.', 'bee9-2052-aae4-435f-b352.jpeg', '2025-06-09 00:57:26', '2025-06-09 19:02:12', 0, '8226-7654-379e-454e-8459');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `uuid` varchar(36) NOT NULL,
  `prefixe` varchar(10) DEFAULT NULL,
  `nom_complet` varchar(100) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `cni` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `condition_visite` varchar(20) DEFAULT NULL,
  `option_visite` varchar(50) DEFAULT NULL,
  `date_soumission` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customers_dossiers`
--

CREATE TABLE `customers_dossiers` (
  `uuid` varchar(36) NOT NULL,
  `code_dossier` varchar(255) DEFAULT NULL,
  `prefixe` varchar(10) DEFAULT NULL,
  `nom_complet` varchar(100) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `cni` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `condition_visite` varchar(20) DEFAULT NULL,
  `option_visite` varchar(50) DEFAULT NULL,
  `date_soumission` datetime DEFAULT current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'En cours',
  `frais_ouverture` int(255) NOT NULL DEFAULT 5000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `customers_dossiers`
--

INSERT INTO `customers_dossiers` (`uuid`, `code_dossier`, `prefixe`, `nom_complet`, `profession`, `cni`, `telephone`, `email`, `description`, `condition_visite`, `option_visite`, `date_soumission`, `added_by`, `created_at`, `updated_at`, `is_deleted`, `status`, `frais_ouverture`) VALUES
('0ace-c95d-cffc-4218-b372', 'DOSS20250529112918144', 'Mme', 'Velit architecto fug', 'Cumque dolore itaque', 'Recusandae Earum qu', '+1 (945) 616-5757', 'gaxolacoru@mailinator.com', 'Sint et sit consequ', 'Autres prestations', 'Sur négociation', '2025-05-29 10:29:18', '8226-7654-379e-454e-8459', '2025-05-29 09:29:18', NULL, 0, 'En cours', 45000),
('260d-61d5-7502-4e9e-9a1a', 'DOSS20250529120359895', 'Mlle', 'Ad dolore omnis dolo', 'Deserunt dolorem vel', 'Sit enim in autem d', '+1 (923) 351-8465', 'dyxaxiboce@mailinator.com', 'Earum odio ea eius d', 'Autres prestations', 'Sur négociation', '2025-05-29 11:03:59', '8226-7654-379e-454e-8459', '2025-05-29 10:03:59', '2025-05-29 10:05:03', 0, 'Finalisé', 25000),
('3a8c-fb60-3e93-42ef-b1ed', 'DOSS20250526012428768', NULL, 'Sint sapiente quisqu', 'Illum libero repreh', 'Mollit veniam vel i', '+1 (241) 827-2759', 'wabyzedizi@mailinator.com', 'Fugiat laudantium s', 'Autres', 'Sur négociation', '2025-05-26 00:24:28', '1a0f-1f19-89a1-4931-bc88', '2025-05-25 23:24:28', '2025-05-26 01:27:53', 0, 'Finalisé', 450000),
('4810-cd12-9c96-4689-a742', 'DOSS20250529114123263', 'Mme', 'Et saepe sunt volupt', 'Nulla assumenda nost', 'Consectetur ex reru', '+1 (649) 849-9062', 'fanodaqa@mailinator.com', 'Ut do commodo molest', 'Location', 'Appartement', '2025-05-29 10:41:23', '8226-7654-379e-454e-8459', '2025-05-29 09:41:23', '2025-05-29 09:43:16', 0, 'En cours', 10000),
('490c-2196-8200-487f-a757', 'DOSS20250602151535542', 'Mlle', 'Et sunt explicabo Q', 'Cupidatat commodo ex', 'Proident sit cumqu', '+1 (657) 214-6905', 'coxocyre@mailinator.com', 'Reprehenderit omnis ', 'Achat Maison', 'Milieu urbain', '2025-06-02 14:15:35', '8226-7654-379e-454e-8459', '2025-06-02 13:15:35', '2025-06-02 13:20:05', 0, 'En cours', 150000),
('55f0-3603-9907-491f-980d', 'DOSS20250529114649018', 'Mme', 'Error qui ut eum pos', 'Esse quidem rem amet', 'Et voluptatibus cons', '+1 (546) 435-1142', 'likij@mailinator.com', 'Et et et dolorum est', 'Location', 'Studio', '2025-05-29 10:46:49', '8226-7654-379e-454e-8459', '2025-05-29 09:46:49', '2025-05-29 09:51:51', 0, 'En cours', 10000),
('9129-f551-dbf8-48ea-b3b1', 'DOSS20250526011253468', 'M', 'Eu ad voluptatum min', 'Rerum ullamco explic', 'Laborum Deserunt ne', '+1 (426) 926-2719', 'vuwyqo@mailinator.com', 'Cumque possimus in ', 'Achat Terrain', 'Milieu urbain', '2025-05-26 00:12:53', '1a0f-1f19-89a1-4931-bc88', '2025-05-25 23:12:53', '2025-05-26 01:26:32', 0, 'Finalisé', 5000),
('94e9-ce41-6cb2-4717-a09d', 'DOSS20250525230522936', 'Mlle', 'Marie Louise', 'Commercante', 'CNI4567890234', '+331234567824', 'admin@gmail.com', 'Below is a static modal example (meaning its position and display have been overridden). Included are the modal header, modal body (required for padding), and modal footer (optional). We ask that you include modal headers with dismiss actions whenever possible, or provide another explicit dismiss action.', 'Autres', 'Sur négociation', '2025-05-25 22:05:22', '8226-7654-379e-454e-8459', '2025-05-25 21:05:22', NULL, 0, 'En cours', 5000),
('a8f3-39a2-beb9-408b-9721', 'DOSS20250524153732123', 'M', 'Jean Marie', 'Bureautique', 'CNI3456789016', '+331234567890', 'adminuser@gmail.com', 'Progressively enhance your switches for mobile Safari (iOS 17.4+) by adding a switch attribute to your input to enable haptic feedback when toggling switches, just like native iOS switches. There are no style changes attached to using this attribute in Bootstrap as all our switches use custom styles.', 'Achat Maison', 'Milieu urbain', '2025-05-24 17:27:41', '8226-7654-379e-454e-8459', '2025-05-24 16:27:41', '2025-05-25 23:42:52', 1, 'En cours', 5000),
('b951-668c-dafc-4e41-a6b8', 'DOSS20250524153732456', 'Mme', 'Sharonne Mila', 'Manager', 'CNI345678901', '+33123456789', 'partenaire1@gmail.com', 'Progressively enhance your switches for mobile Safari (iOS 17.4+) by adding a switch attribute to your input to enable haptic feedback when toggling switches, just like native iOS switches. There are no style changes attached to using this attribute in Bootstrap as all our switches use custom styles.', 'Location', 'Chambre / Studio', '2025-05-24 17:20:13', '8226-7654-379e-454e-8459', '2025-05-24 16:20:13', '2025-05-25 23:43:12', 0, 'Finalisé', 5000),
('c2fd-8ee0-6e0d-45db-8d25', 'DOSS20250529112541329', 'Mlle', 'Esse quas qui ut nes', 'Blanditiis excepteur', 'Corrupti numquam el', '+1 (421) 876-9807', 'calyvuma@mailinator.com', 'Cumque autem est fu', 'Autres prestations', 'Négociations', '2025-05-29 10:25:41', '8226-7654-379e-454e-8459', '2025-05-29 09:25:41', '2025-05-29 09:43:09', 0, 'En cours', 10000),
('d51a-3344-5ba3-41af-a2fd', 'DOSS20250524153732987', 'Mlle', 'Ophelie Lynn', 'Dévéloppeuse', 'CNI456789000', '+237650654328', 'sharonne@gmail.com', 'Progressively enhance your switches for mobile Safari (iOS 17.4+) by adding a switch attribute to your input to enable haptic feedback when toggling switches, just like native iOS switches. There are no style changes attached to using this attribute in Bootstrap as all our switches use custom styles.', 'Achat Maison', 'Milieu urbain', '2025-05-24 17:06:18', '8226-7654-379e-454e-8459', '2025-05-24 16:06:18', '2025-05-25 23:43:20', 0, 'Finalisé', 5000),
('d851-220f-08a9-409c-a4c0', 'DOSS20250529120622890', 'M', 'Nam consequatur vel', 'Officia quam necessi', 'Sint eos esse vero', '+1 (131) 701-9082', 'togisyk@mailinator.com', 'Iste ut obcaecati an', 'Autres prestations', 'Sur négociation', '2025-05-29 11:06:22', '8226-7654-379e-454e-8459', '2025-05-29 10:06:22', '2025-05-29 10:07:16', 0, 'Finalisé', 40000),
('dba2-eada-fda0-4c6f-b632', 'DOSS20250526042833463', 'M', 'In aut veniam error', 'Nihil pariatur Inci', 'Enim similique natus', '+1 (695) 906-3724', 'vysuhipen@mailinator.com', 'Mollitia non officia', 'Achat Maison', 'Milieu rural', '2025-05-26 03:28:33', '1a0f-1f19-89a1-4931-bc88', '2025-05-26 02:28:33', '2025-05-29 09:52:02', 0, 'En cours', 10000),
('e5d7-3f14-3e68-4c0d-9102', 'DOSS20250524153732401', 'M', 'Jean Luis', 'Analyste', 'CNI123456789', '+33123456788', 'fournisseurb@gmail.com', 'Progressively enhance your switches for mobile Safari (iOS 17.4+) by adding a switch attribute to your input to enable haptic feedback when toggling switches, just like native iOS switches. There are no style changes attached to using this attribute in Bootstrap as all our switches use custom styles.', 'Location', 'Chambre / Studio', '2025-05-24 17:23:27', '8226-7654-379e-454e-8459', '2025-05-24 16:23:27', '2025-05-25 23:43:25', 0, 'Finalisé', 5000),
('e9e5-1857-4dd1-4bb6-b1dd', 'DOSS20250529110844840', 'M', 'At eaque totam dolor', 'Reiciendis voluptate', 'Consequuntur recusan', '+1 (435) 378-4359', 'hafatep@mailinator.com', 'Ut sed exercitation ', 'Location', 'Duplex', '2025-05-29 10:08:44', '8226-7654-379e-454e-8459', '2025-05-29 09:08:44', '2025-05-29 09:43:22', 0, 'Finalisé', 10000),
('f609-a928-e689-4a3e-a3a7', 'DOSS20250529115133304', 'Mme', 'Repellendus Cillum ', 'Quasi tempor dolor o', 'Voluptas nesciunt a', '+1 (654) 549-4157', 'hiwi@mailinator.com', 'Quos est natus cum a', 'Achat Terrain', 'Milieu urbain', '2025-05-29 10:51:33', '8226-7654-379e-454e-8459', '2025-05-29 09:51:33', '2025-05-29 09:51:56', 0, 'En cours', 10000),
('fbcb-8e84-84c7-4b4a-9e0e', 'DOSS20250524153732159\n', 'M', 'Laurent Alphonse', 'Dévéloppeur Fullstack', 'CNI123456799', '+237650654321', 'test@gmail.com', 'Progressively enhance your switches for mobile Safari (iOS 17.4+) by adding a switch attribute to your input to enable haptic feedback when toggling switches, just like native iOS switches. There are no style changes attached to using this attribute in Bootstrap as all our switches use custom styles.', 'Achat Maison', 'Milieu rural', '2025-05-24 17:04:16', '8226-7654-379e-454e-8459', '2025-05-24 16:04:16', '2025-05-29 09:43:27', 0, 'En cours', 10000);

-- --------------------------------------------------------

--
-- Structure de la table `finalisations_dossiers`
--

CREATE TABLE `finalisations_dossiers` (
  `uuid` varchar(36) NOT NULL,
  `dossier_uuid` char(36) NOT NULL,
  `montant_verse` int(11) NOT NULL,
  `references_personnes` text NOT NULL,
  `date_finalisation` datetime DEFAULT current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `finalisations_dossiers`
--

INSERT INTO `finalisations_dossiers` (`uuid`, `dossier_uuid`, `montant_verse`, `references_personnes`, `date_finalisation`, `added_by`, `is_deleted`, `created_at`, `updated_at`) VALUES
('0a5d-db8e-eca8-41a7-ab54', 'e5d7-3f14-3e68-4c0d-9102', 50000, 'Jean Marie,Alain Paul', '2025-05-24 19:26:29', '8226-7654-379e-454e-8459', 0, '2025-05-24 18:26:29', NULL),
('0fde-1f6c-83b6-4659-b8d9', 'd51a-3344-5ba3-41af-a2fd', 77000, 'Velit tempora delen', '2025-05-24 19:32:05', '8226-7654-379e-454e-8459', 0, '2025-05-24 18:32:05', NULL),
('30ab-911b-8c2d-4cbf-9b0a', 'd851-220f-08a9-409c-a4c0', 50000, 'Id labore voluptates', '2025-05-29 11:07:16', '8226-7654-379e-454e-8459', 0, '2025-05-29 10:07:16', NULL),
('60a9-30f1-60a2-4079-834e', 'b951-668c-dafc-4e41-a6b8', 94000, 'Sed provident sint ', '2025-05-24 19:28:09', '8226-7654-379e-454e-8459', 0, '2025-05-24 18:28:09', NULL),
('6fb1-9e95-d8d1-4b9c-8cec', 'e9e5-1857-4dd1-4bb6-b1dd', 250000, 'Mr Laurent', '2025-05-29 10:10:41', '8226-7654-379e-454e-8459', 0, '2025-05-29 09:10:41', NULL),
('c2d8-fd17-6539-4702-8cb6', '9129-f551-dbf8-48ea-b3b1', 34000, 'Aspernatur voluptas ', '2025-05-26 02:26:32', '1a0f-1f19-89a1-4931-bc88', 0, '2025-05-26 01:26:32', NULL),
('f0eb-ed75-8198-4333-9022', '3a8c-fb60-3e93-42ef-b1ed', 20000, 'Quae excepteur deser', '2025-05-26 02:27:53', '1a0f-1f19-89a1-4931-bc88', 0, '2025-05-26 01:27:53', NULL),
('fe54-a3ce-aeff-4a02-a70d', '260d-61d5-7502-4e9e-9a1a', 27000, 'Enim consectetur aut', '2025-05-29 11:05:03', '8226-7654-379e-454e-8459', 0, '2025-05-29 10:05:03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `immo`
--

CREATE TABLE `immo` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `immo`
--

INSERT INTO `immo` (`id`, `name`, `created_at`) VALUES
('550e8400-e29b-41d4-a716-446655440000', 'IMMO', '2025-03-07 14:46:57');

-- --------------------------------------------------------

--
-- Structure de la table `livraisons_products`
--

CREATE TABLE `livraisons_products` (
  `uuid` varchar(36) NOT NULL,
  `reference` varchar(30) NOT NULL,
  `product_uuid` varchar(36) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `delivery_price` decimal(10,2) NOT NULL,
  `price_delivery_exactly` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `is_home_delivery` tinyint(1) DEFAULT 0,
  `delivery_man_id` varchar(36) NOT NULL,
  `status` enum('En cours','Livré','Annulé') DEFAULT 'En cours',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraisons_products`
--

INSERT INTO `livraisons_products` (`uuid`, `reference`, `product_uuid`, `recipient_name`, `phone`, `delivery_price`, `price_delivery_exactly`, `quantity`, `location`, `is_home_delivery`, `delivery_man_id`, `status`, `created_at`, `added_by`) VALUES
('1cb9-f0ca-a57a-493e-adb1', 'LIVR-20250609-4D9DA1', 'b7ce-c8d7-6a9a-4f43-9414', 'Dev', '6459012923', 4500.00, NULL, 3, 'Mokolo', 1, '045c-bfb2-a22e-4946-8048', 'Annulé', '2025-06-09 02:17:52', '8226-7654-379e-454e-8459'),
('6aae-34c2-b50a-481c-b59f', 'LIVR-20250609-91DE87', 'ca64-793a-b165-4a51-a5f9', 'Preston Hart', '645901290', 1500.00, '25000', 2, 'Voluptate alias magn', 0, '045c-bfb2-a22e-4946-8048', 'Livré', '2025-06-09 01:59:51', '8226-7654-379e-454e-8459'),
('8bfd-fdc2-49ea-4f4f-8e9b', 'LIVR-20250611-FDE941', '530b-9848-0497-42ab-864b', 'Ezekiel Wright', '+1 (572) 537-9987', 2000.00, '25000', 5, 'Tempor dolore at eiu', 1, '045c-bfb2-a22e-4946-8048', 'Livré', '2025-06-11 13:58:43', '8226-7654-379e-454e-8459'),
('9aaf-e449-4606-42e6-b0d6', 'LIVR-20250609-21C1BF', 'ca64-793a-b165-4a51-a5f9', 'Paki Nichols', '654237808', 2500.00, NULL, 3, 'Emana', 1, '045c-bfb2-a22e-4946-8048', 'Annulé', '2025-06-09 01:39:04', '8226-7654-379e-454e-8459');

-- --------------------------------------------------------

--
-- Structure de la table `main_agencies`
--

CREATE TABLE `main_agencies` (
  `uuid` varchar(100) NOT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `manager_uuid` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` varchar(2555) DEFAULT NULL,
  `can_create_agents` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `main_agencies`
--

INSERT INTO `main_agencies` (`uuid`, `ref`, `name`, `phone`, `email`, `city`, `region`, `logo`, `manager_uuid`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `added_by`, `can_create_agents`) VALUES
('015c-8e58-0ee2-4a27-8a8a', 'AG-20250611-F851F0', 'wohyq@mailinator.com', '+1 (873) 819-8998', 'alvis.crash@fsitip.com', 'Maroua', 'Nord', NULL, '741f-0b2d-605d-46f3-b597', 1, 0, '2025-06-11 07:23:23', '2025-06-11 07:23:23', '8226-7654-379e-454e-8459', 0),
('620d-5b73-4e41-49f8-8973', 'AG-20250609-C9456F', 'Agence E', '6542378765', 'agenceC@gmail.com', 'Douala', 'Centre', '7637-4f1d-dbdc-4729-b079.jpeg', 'd824-17c8-3549-455b-bd2f', 0, 0, '2025-06-09 19:21:34', '2025-06-11 07:18:06', '8226-7654-379e-454e-8459', 0),
('68a4-b424-6bc0-4517-aac6', 'AG-20250611-A8A617', 'hefoxat@mailinator.com', '+1 (873) 779-6697', 'zymir.alix@fsitip.com', 'Douala', 'Centre', NULL, 'fcc8-c5ba-212f-49c7-ab98', 1, 0, '2025-06-11 18:46:13', '2025-06-11 19:50:15', '8226-7654-379e-454e-8459', 0),
('c0cc-1ef0-0933-4374-8085', 'AG-20250609-054BBF', 'Agence A', '645901290', 'agenceA@gmail.com', 'Yaoundé', 'Centre', NULL, '8ca1-ff26-3de6-4279-af58', 1, 0, '2025-06-09 14:11:25', '2025-06-09 19:17:53', '8226-7654-379e-454e-8459', 1);

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
-- Structure de la table `owner`
--

CREATE TABLE `owner` (
  `id` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `residence_location` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `property_location` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `owner`
--

INSERT INTO `owner` (`id`, `last_name`, `first_name`, `phone_number`, `id_number`, `residence_location`, `nationality`, `property_location`, `property_type`, `details`, `created_at`, `is_deleted`) VALUES
('04b0-c408-df15-4699-9818', 'Heath', 'Jack', '+1 (718) 605-3709', '+1 (855) 712-9209', '+1 (235) 564-9539', '+1 (109) 866-3538', '+1 (528) 387-9834', 'Camp', 'Numquam ut dolorem a', '2025-03-05 11:28:54', 0),
('6c75-66e7-3d2a-4276-8bce', 'Ruiz', 'Howard', '+1 (902) 373-5574', 'CNI987654321', 'Limbé', 'Gabonaise', 'Edéa', 'Immeubles', 'Nemo quia ab volupta', '2025-03-05 11:09:22', 0),
('6f11-381a-f62b-4eca-b120', 'jean', 'Laurent 5', '678862852', 'cni123456789', 'yaounde', 'Camerounaise', 'golf', 'Villa', 'fhgdf edrtht rsh', '2025-03-05 11:09:52', 0),
('b6e9-bc52-86dc-4f27-9078', 'jean', 'roosvelt', '678862882', 'cni186456789', 'yaounde', 'camerounaise', 'bastos', 'Immeubles', 'tres belle immeuble', '2025-03-05 11:24:16', 0);

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

CREATE TABLE `packages` (
  `uuid` varchar(100) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_phone` varchar(20) NOT NULL,
  `sender_address` varchar(255) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `recipient_phone` varchar(20) NOT NULL,
  `recipient_address` varchar(255) NOT NULL,
  `home_delivery` tinyint(1) DEFAULT 0,
  `package_name` varchar(100) NOT NULL,
  `package_type` enum('Document','Petit colis','Gros colis') NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `main_agency_uuid` varchar(100) NOT NULL,
  `status` enum('en attente','en transit','livré','annulé') DEFAULT 'en attente',
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qr_code` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `is_collected` tinyint(1) DEFAULT 0,
  `is_delivery` tinyint(1) NOT NULL DEFAULT 0,
  `collected_by` varchar(255) DEFAULT NULL,
  `delivery_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `packages`
--

INSERT INTO `packages` (`uuid`, `sender_name`, `sender_phone`, `sender_address`, `recipient_name`, `recipient_phone`, `recipient_address`, `home_delivery`, `package_name`, `package_type`, `description`, `image_path`, `main_agency_uuid`, `status`, `is_deleted`, `created_at`, `updated_at`, `qr_code`, `ref`, `is_collected`, `is_delivery`, `collected_by`, `delivery_by`) VALUES
('c4b0-92f8-f9ed-4220-8744', 'Laurent Alphonse', '654128076', 'Yaoundé', 'Sharonne Mila', '654347890', '90 Place des Marchés, Bafoussam', 1, 'Iphone 13', 'Petit colis', 'Documentation and examples for opting images into responsive behavior', '6849cf472e874_iphone-12-frandroid-2020-768x768.png', 'c0cc-1ef0-0933-4374-8085', 'en attente', 0, '2025-06-11 18:47:35', '2025-06-11 19:29:43', 'c4b0-92f8-f9ed-4220-8744.png', 'COLIS-20250611-1DFC65', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` varchar(36) NOT NULL,
  `tenant_id` varchar(36) NOT NULL,
  `date_payment` datetime NOT NULL,
  `montant` int(100) NOT NULL,
  `added_by` varchar(36) NOT NULL,
  `status` varchar(100) NOT NULL,
  `mois` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`id`, `tenant_id`, `date_payment`, `montant`, `added_by`, `status`, `mois`) VALUES
('25d3-8f0d-e903-4265-a553', '2407-7ef7-8106-4576-bff9', '2025-03-08 09:26:54', 250000, '1a0f-1f19-89a1-4931-bc88', 'Partiellement payé', 'Avril'),
('afa0-56aa-c23e-4bbc-b21e', 'dd90-35d2-29d1-47cf-bee8', '2025-03-08 09:33:18', 75000, '1a0f-1f19-89a1-4931-bc88', 'Partiellement payé', 'Mai'),
('b2ad-66cd-3409-4dcb-932b', '2407-7ef7-8106-4576-bff9', '2025-03-08 09:32:17', 250000, '1a0f-1f19-89a1-4931-bc88', 'Partiellement payé', 'Mai');

-- --------------------------------------------------------

--
-- Structure de la table `prestations_client`
--

CREATE TABLE `prestations_client` (
  `uuid` varchar(36) NOT NULL,
  `client_uuid` varchar(36) DEFAULT NULL,
  `prestation` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prestations_client`
--

INSERT INTO `prestations_client` (`uuid`, `client_uuid`, `prestation`, `added_by`, `created_at`, `updated_at`, `is_deleted`) VALUES
('08bb-5af6-bb77-4fa5-ae12', 'fbcb-8e84-84c7-4b4a-9e0e', 'Prestations sur achat terrain', '8226-7654-379e-454e-8459', '2025-05-26 17:43:25', NULL, 0),
('0efa-0b89-0970-4835-bcdd', '55f0-3603-9907-491f-980d', 'Prestations sur gestion Immobilière', '8226-7654-379e-454e-8459', '2025-05-29 09:46:49', NULL, 0),
('3bd0-265b-20db-440e-9ead', '490c-2196-8200-487f-a757', 'Service de nettoyage', '8226-7654-379e-454e-8459', '2025-06-02 13:20:05', NULL, 0),
('41b9-51b7-7991-44e2-9275', '94e9-ce41-6cb2-4717-a09d', 'Autres prestations', '8226-7654-379e-454e-8459', '2025-05-25 21:05:22', NULL, 0),
('4817-135c-e32b-451e-b756', '260d-61d5-7502-4e9e-9a1a', 'Service de nettoyage', '8226-7654-379e-454e-8459', '2025-05-29 10:03:59', NULL, 0),
('5876-d93b-e0bc-4ca4-a27d', '4810-cd12-9c96-4689-a742', 'Prestations sur location Immobilière', '8226-7654-379e-454e-8459', '2025-05-29 09:41:23', NULL, 0),
('5985-3620-3d19-4848-aae5', '0ace-c95d-cffc-4218-b372', 'Prestations sur gestion Immobilière', '8226-7654-379e-454e-8459', '2025-05-29 09:29:18', NULL, 0),
('5da2-7a9b-0d63-464e-b29c', 'd51a-3344-5ba3-41af-a2fd', 'Projet location/construction long terme', '8226-7654-379e-454e-8459', '2025-05-24 16:56:42', NULL, 0),
('6231-ba2b-6026-424c-ac0c', 'e9e5-1857-4dd1-4bb6-b1dd', 'Service de nettoyage', '8226-7654-379e-454e-8459', '2025-05-29 09:08:44', NULL, 0),
('975f-5941-7f53-4259-a975', 'c2fd-8ee0-6e0d-45db-8d25', 'Prestations sur location terrain', '8226-7654-379e-454e-8459', '2025-05-29 09:25:41', NULL, 0),
('a71e-f751-93fb-41f8-9334', 'f609-a928-e689-4a3e-a3a7', 'Prestations sur achat Immobilière', '8226-7654-379e-454e-8459', '2025-05-29 09:51:33', '2025-05-29 09:54:10', 0),
('a858-df89-6bc9-4ec9-940f', 'a8f3-39a2-beb9-408b-9721', 'Service de rénovation', '8226-7654-379e-454e-8459', '2025-05-24 16:56:42', '2025-05-24 17:02:23', 1),
('b168-5e21-7cf2-4870-904b', 'e5d7-3f14-3e68-4c0d-9102', 'Service de déménagement', '8226-7654-379e-454e-8459', '2025-05-24 16:56:42', NULL, 0),
('ba4d-e9f3-6638-475c-8355', 'd851-220f-08a9-409c-a4c0', 'Service de rénovation', '8226-7654-379e-454e-8459', '2025-05-29 10:06:22', NULL, 0),
('c8c1-f557-80ab-4e23-9a5f', '9129-f551-dbf8-48ea-b3b1', 'Prestations sur achat terrain', '1a0f-1f19-89a1-4931-bc88', '2025-05-25 23:12:53', NULL, 0),
('cdcf-be9b-23e1-4d06-aa3c', 'b951-668c-dafc-4e41-a6b8', 'Clé en main', '8226-7654-379e-454e-8459', '2025-05-25 21:46:19', NULL, 0),
('ea9e-ac0d-567f-4b73-a881', 'c2fd-8ee0-6e0d-45db-8d25', 'Prestations sur achat terrain', '8226-7654-379e-454e-8459', '2025-05-29 09:25:41', NULL, 0),
('fc04-74d6-df74-4f43-9d9b', '3a8c-fb60-3e93-42ef-b1ed', 'Service de nettoyage', '1a0f-1f19-89a1-4931-bc88', '2025-05-25 23:33:39', NULL, 0),
('fc18-a338-33e9-475b-bf1d', 'dba2-eada-fda0-4c6f-b632', 'Service de déménagement', '1a0f-1f19-89a1-4931-bc88', '2025-05-26 02:28:33', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_menu`
--

CREATE TABLE `reservation_menu` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('boisson','plat') NOT NULL,
  `price` int(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `restaurant_id` varchar(255) DEFAULT NULL,
  `mois` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `total_price` int(100) GENERATED ALWAYS AS (`price` * `quantity`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_menu`
--

INSERT INTO `reservation_menu` (`id`, `name`, `type`, `price`, `quantity`, `added_by`, `restaurant_id`, `mois`, `created_at`, `updated_at`) VALUES
('1845-36a4-0835-48a6-a35b', 'pile', 'plat', 1000, 4, 'bb95-7bfb-133d-4396-8dab', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Mars', '2025-03-03 10:39:46', '2025-03-03 10:40:01'),
('1f6a-c653-fb49-4be1-88d5', 'kadji', 'plat', 750, 2, 'bb95-7bfb-133d-4396-8dab', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Mars', '2025-03-03 10:15:09', NULL),
('5202-39d5-7d47-4467-954a', 'poisson', 'plat', 750, 5, 'bb95-7bfb-133d-4396-8dab', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Mars', '2025-03-03 10:25:57', '2025-03-03 10:36:35'),
('7568-c452-6bee-4b65-887a', 'KADJI', 'boisson', 1000, 3, 'bb95-7bfb-133d-4396-8dab', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Mars', '2025-03-03 19:25:48', NULL),
('768c-f470-3337-471e-8f49', 'kadji', 'plat', 850, 6, 'bb95-7bfb-133d-4396-8dab', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Mars', '2025-03-03 10:38:34', '2025-03-03 10:39:19'),
('8539-01df-1155-4de6-abe1', 'Okok', 'plat', 1500, 3, 'bb95-7bfb-133d-4396-8dab', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Mars', '2025-03-03 19:22:59', NULL);

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
  `mois` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_nuitee`
--

INSERT INTO `reservation_nuitee` (`id`, `type_chambre`, `type_service`, `numero`, `id_motel`, `prix`, `date_entre`, `date_sortie`, `client_id`, `is_deleted`, `status`, `added_by`, `mois`, `created_at`, `updated_at`) VALUES
('02ae-8cb1-affa-42cb-b4d8', 'Chambre VIP', 'NUITEE', '107', '3f22-ded3-02e0-4e3a-86d1', '25000', '2025-03-03 10:00:00', '2025-03-04 12:00:00', '6700-df38-bcd6-4daf-818c', '0', 'en cours', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-02 16:08:37', '2025-03-03 12:51:58'),
('30a7-f048-3eaf-4687-8df2', 'Chambre standard', 'NUITEE', '102', '3f22-ded3-02e0-4e3a-86d1', '10000', '2025-03-02 17:03:00', '2025-03-03 12:00:00', 'f131-3755-c6ce-4af4-af37', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars\n', '2025-03-02 16:04:28', '2025-03-04 10:52:13'),
('4369-6688-5094-4ba0-b99e', 'Chambre VIP', 'NUITEE', '105', '3f22-ded3-02e0-4e3a-86d1', '12000', '2025-03-02 20:12:00', '2025-03-03 12:00:00', '49ce-cea5-17d2-49e4-873f', '0', 'terminée', '719a-bec0-3b45-482c-a331', 'Mars', '2025-03-02 18:11:53', '2025-03-04 10:52:13'),
('a487-5865-0cc1-4675-bbce', 'Chambre standard', 'NUITEE', '103', '3f22-ded3-02e0-4e3a-86d1', '7500', '2025-03-03 20:19:00', '2025-03-04 12:00:00', '6700-df38-bcd6-4daf-818c', '0', 'en cours', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 19:20:36', '2025-03-03 19:20:36');

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
  `mois` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_sieste`
--

INSERT INTO `reservation_sieste` (`id`, `type_chambre`, `type_service`, `numero`, `id_motel`, `prix`, `date_entre`, `date_sortie`, `client_id`, `is_deleted`, `status`, `added_by`, `mois`, `created_at`, `updated_at`) VALUES
('0e56-13ce-70f5-4697-847a', 'Chambre VIP', 'SIESTE', '106', '3f22-ded3-02e0-4e3a-86d1', 7000, '15:41:00', '17:41:00', '49ce-cea5-17d2-49e4-873f', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 16:08:22', '2025-03-03 17:14:39'),
('1682-c055-6b5e-4bd4-bb11', 'Chambre Simple', 'SIESTE', '102', '3f22-ded3-02e0-4e3a-86d1', 5000, '20:00:00', '22:00:00', '6700-df38-bcd6-4daf-818c', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 19:12:22', '2025-05-25 22:08:36'),
('1f2e-ea52-0209-4e52-a1fd', 'Chambre standard', 'SIESTE', '104', '3f22-ded3-02e0-4e3a-86d1', 5000, '18:15:00', '20:15:00', '49ce-cea5-17d2-49e4-873f', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 17:15:51', '2025-03-07 19:41:30'),
('1f67-ca79-a9e8-455a-8c01', 'Chambre standard', 'SIESTE', '104', '3f22-ded3-02e0-4e3a-86d1', 5000, '20:06:00', '22:06:00', '6700-df38-bcd6-4daf-818c', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 19:07:03', '2025-05-25 22:08:36'),
('1fa3-46cf-d338-409c-8ed0', 'Chambre VIP', 'SIESTE', '103', '3f22-ded3-02e0-4e3a-86d1', 3000, '17:12:00', '19:12:00', 'ca29-5cef-c65d-40cf-b867', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-07 18:12:30', '2025-03-07 18:12:34'),
('2593-45c4-e15b-4b54-86e7', 'Chambre standard', 'SIESTE', '101', '3f22-ded3-02e0-4e3a-86d1', 5000, '15:46:00', '17:46:00', '6700-df38-bcd6-4daf-818c', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-02 14:48:59', '2025-03-03 15:59:50'),
('29d7-c607-c379-4297-be67', 'Chambre Simple', 'SIESTE', '102', '3f22-ded3-02e0-4e3a-86d1', 5000, '16:20:00', '18:20:00', '49ce-cea5-17d2-49e4-873f', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-02 15:20:47', '2025-03-03 15:59:50'),
('31a2-df60-5a52-49a6-b986', 'Chambre Simple', 'SIESTE', '104', '3f22-ded3-02e0-4e3a-86d1', 5000, '23:00:00', '01:00:00', '49ce-cea5-17d2-49e4-873f', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 19:12:42', '2025-03-03 19:12:44'),
('34b3-04e8-8165-4c87-8458', 'Chambre Simple', 'SIESTE', '103', '3f22-ded3-02e0-4e3a-86d1', 3000, '10:01:00', '12:01:00', 'b801-f18d-9ab0-406e-85fb', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-04 11:00:12', '2025-03-04 11:01:00'),
('6457-2028-8c9e-47ba-8e46', 'Chambre standard', 'SIESTE', '102', '3f22-ded3-02e0-4e3a-86d1', 5000, '17:16:00', '19:16:00', 'f131-3755-c6ce-4af4-af37', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-07 18:15:40', '2025-03-07 18:16:12'),
('69e2-e4c1-6267-4e34-829c', 'Chambre standard', 'SIESTE', '101', '3f22-ded3-02e0-4e3a-86d1', 5000, '16:38:00', '18:38:00', '6700-df38-bcd6-4daf-818c', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 15:39:03', '2025-03-03 15:59:50'),
('7484-0434-c128-4ea7-99bd', 'Chambre Simple', 'SIESTE', '103', '3f22-ded3-02e0-4e3a-86d1', 3000, '19:17:00', '21:17:00', '6700-df38-bcd6-4daf-818c', '0', 'terminée', '719a-bec0-3b45-482c-a331', 'Mars', '2025-03-02 18:17:43', '2025-03-03 15:59:50'),
('88ac-e388-2c33-472e-91a2', 'Chambre VIP', 'SIESTE', '105', '3f22-ded3-02e0-4e3a-86d1', 5000, '09:27:00', '11:17:00', '6700-df38-bcd6-4daf-818c', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 16:07:04', '2025-03-03 16:07:07'),
('a43c-a74d-537d-461a-a406', 'Chambre standard', 'SIESTE', '104', '3f22-ded3-02e0-4e3a-86d1', 5000, '11:39:00', '13:39:00', 'b801-f18d-9ab0-406e-85fb', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-04 10:40:08', '2025-03-07 16:05:37'),
('b802-fff8-bb7c-4d7a-9343', 'Chambre Simple', 'SIESTE', '102', '3f22-ded3-02e0-4e3a-86d1', 5000, '10:05:00', '12:05:00', 'f131-3755-c6ce-4af4-af37', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-04 11:04:30', '2025-03-04 11:05:01'),
('bcaf-b3e7-d75f-4986-a694', 'Chambre Simple', 'SIESTE', '104', '3f22-ded3-02e0-4e3a-86d1', 5000, '13:03:00', '00:24:00', '49ce-cea5-17d2-49e4-873f', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-03 16:05:00', '2025-03-03 16:05:06'),
('caa4-d074-0f19-4fd5-add5', 'Chambre VIP', 'SIESTE', '106', '3f22-ded3-02e0-4e3a-86d1', 7000, '17:22:00', '19:22:00', 'f131-3755-c6ce-4af4-af37', '0', 'terminée', 'bb95-7bfb-133d-4396-8dab', 'Mars', '2025-03-02 15:22:40', '2025-03-03 15:59:50');

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
('de5c11e1-f6cd-11ef-9cb8-d8cb8a12514d', 'Restaurant La fortune', '12 Avenue des Délices, Paris', 'contact@gourmet.fr', '+33123456789', 'Restaurant gastronomique offrant une cuisine raffinée.', 'active', 0, '2025-03-01 17:49:12', '2025-03-03 19:55:57'),
('de5e7979-f6cd-11ef-9cb8-d8cb8a12514d', 'La Brasserie Royale', '5 Rue du Palais, Lyon', 'contact@brasserieroyale.fr', '+33456781234', 'Brasserie traditionnelle avec une ambiance chaleureuse.', 'active', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('de5e7a77-f6cd-11ef-9cb8-d8cb8a12514d', 'Chez Luigi', '22 Piazza Roma, Milan', 'info@chezluigi.it', '+390212345678', 'Pizzeria italienne réputée pour ses pizzas au feu de bois.', 'active', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', 'Sakura Sushi', '8 Chuo-ku, Tokyo', 'info@sakurasushi.jp', '+81398765432', 'Spécialiste des sushis et plats japonais authentiques.', 'inactive', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('de5e7ae7-f6cd-11ef-9cb8-d8cb8a12514d', 'The Steakhouse', '47 Downtown Street, New York', 'contact@steakhouse.com', '+12125551234', 'Steakhouse américain proposant des viandes de qualité.', 'active', 0, '2025-03-01 17:49:12', '2025-03-01 17:49:12'),
('f4d0-7e07-3f83-4bdd-9702', 'restau la fortune', 'yde', 'lafortune@gmail.com', '+123 678862852', 'jolie', 'active', 1, '2025-03-01 19:33:23', '2025-03-02 16:32:31');

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
  `price` varchar(255) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `property_type` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tenants`
--

INSERT INTO `tenants` (`id`, `first_name`, `last_name`, `num_cni`, `phone`, `address`, `price`, `added_by`, `owner_id`, `created_at`, `property_type`, `is_deleted`) VALUES
('13a1-e844-c8f4-41ca-a694', 'Ronan', 'Hardin', 'CNI6790776533', '+1 (288) 204-9126', 'EDEA', '120000', 'bb95-7bfb-133d-4396-8dab', '04b0-c408-df15-4699-9818', '2025-03-07 16:29:03', 'Appartements', 0),
('2407-7ef7-8106-4576-bff9', 'Genevieve', 'Giles', 'CNI67907765654', '+1 (687) 696-3631', '45 Avenue des Montagnes, Garoua', '250000', 'bb95-7bfb-133d-4396-8dab', '04b0-c408-df15-4699-9818', '2025-03-07 19:39:35', 'Immeubles', 0),
('6fba-98c6-d495-48a7-9542', 'Astra', 'Humphrey', '+1 (343) 791-9371', '+1 (217) 268-9939', 'Douala', '20000', 'bb95-7bfb-133d-4396-8dab', '04b0-c408-df15-4699-9818', '2025-03-07 16:18:53', 'Chambres', 0),
('7fbe-7b11-2cf6-4d75-ab3a', 'Lucas', 'Ellison', 'CNI123455667777', '+1 (853) 515-9075', 'Limbé', '15000', 'bb95-7bfb-133d-4396-8dab', '04b0-c408-df15-4699-9818', '2025-03-07 16:26:26', 'Chambres', 0),
('dd90-35d2-29d1-47cf-bee8', 'west', 'john', 'cni1234565215465', '652478950', 'yde', '75000', 'bb95-7bfb-133d-4396-8dab', '04b0-c408-df15-4699-9818', '2025-03-07 16:30:11', 'Studio', 0);

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
('045c-bfb2-a22e-4946-8048', 'Courtney', 'Carrillo', 'papybytyn@mailinator.com', 'Facere optio proide', '+1 (422) 439-5373', '$2y$10$3FVmCmckv7LJH3MHxeBmd.04SBgzzriaQXnuqCyv6K6vOeHT7eqGe', NULL, 'Gestionnaire de livraison', 0, 'active', '2025-06-09 01:09:03', '2025-06-09 01:09:03'),
('1a0f-1f19-89a1-4931-bc88', 'Jescie', 'Russell', 'xiyqpczopolciffmlg@nbmbb.com', 'Garoua', '+1 (774) 781-2629', '$2y$10$U6oM7JZy5m8wSzURT0kjoe8J16i.VF0eFbEanI398o9EvOGx3Nf5y', NULL, 'Gestionnaire IMMO', 0, 'active', '2025-03-08 07:53:03', '2025-03-08 07:54:37'),
('34fa-6718-b5c8-4dcc-8449', 'Samson', 'Small', 'manekengsorelle99@gmail.com', 'Aliquip cum tempore', '+1 (904) 895-7703', '$2y$10$gcMW9cdXHY.rZJ2ypw6Fu./IuO76CIgTGMOqdWg3W.wYWIH5Pg1JO', '67c1cf93cbaa3_images.jpeg', 'admin', 0, 'active', '2025-02-28 15:00:35', '2025-02-28 19:50:47'),
('64d8-6c65-9a3a-4b27-9838', 'Unity', 'Kane', 'waxirefo@mailinator.com', 'Quod omnis veritatis', '+1 (882) 236-5024', '$2y$10$UjNGohmbQQNiwVXkAVVcEurlO2QJtln2L0aikobF2p1s1.unLEPBa', NULL, 'admin', 1, 'active', '2025-02-28 13:55:24', '2025-02-28 14:04:34'),
('6fbc-5e43-4760-4b57-ab4c', 'Cheryl', 'Rutledge', 'pizir@mailinator.com', 'Eum sint amet conse', '+1 (987) 706-3406', '$2y$10$6mTaMlNLvJx2yUOX/rOrHeY6lMhedHkm.YMTYMI1RMrKevuWgiW3W', NULL, 'admin', 0, 'active', '2025-02-28 13:55:37', '2025-02-28 13:55:37'),
('719a-bec0-3b45-482c-a331', 'Zephania', 'Steele', 'roosveltkuenkam237@gmail.com', 'Ratione nihil rerum ', '+1 (624) 812-4146', '$2y$10$DIBVORcNGW1aY7ifaNS0M.sVylzi7tiiCjyCLjin/hLYbDyz//F1C', NULL, 'admin', 0, 'active', '2025-02-28 14:54:19', '2025-03-02 17:56:45'),
('741f-0b2d-605d-46f3-b597', 'Imelda', 'Richardson', 'fipazynil@mailinator.com', 'Non distinctio Unde', '+1 (331) 494-2953', '$2y$10$iIlPOWBMGUK8WcB5tk06kOlc.LB8dyoFR6kg4ifBVlUSO/7X9ktdW', NULL, 'Chef d’agence', 0, 'active', '2025-06-11 07:20:29', '2025-06-11 07:20:29'),
('8226-7654-379e-454e-8459', 'Laurent ', 'Alphonse', 'admin@gmail.com', '123 Rue de Paris, Paris, France', '612891290', '$2y$10$s.DIfIFXIWesGeN6WkbKdeKNgmeIjcVQ1k3Ap/kquZJa5Il6JDUI6', 'profile.png', 'super_admin', 0, 'active', '2025-02-28 13:31:32', '2025-06-12 18:55:59'),
('8ca1-ff26-3de6-4279-af58', 'Test', 'Test', 'testagence@gmail.com', '456 Avenue de la République, Paris, France', '65423776889', '$2y$10$MIZvP7PAgfXb2kXgPwitLuXH9wStgvNpbaguZICknLcBCtfqRFKPi', NULL, 'Chef d’agence', 0, 'active', '2025-06-09 13:16:21', '2025-06-11 14:11:15'),
('9ba6-16fa-065b-4245-88e6', 'Kenyon', 'Estrada', 'bavetyfeke@mailinator.com', 'Aut est consequatur', '+1 (315) 609-5792', '$2y$10$QBOzUCh2fE7ieh8ofGirueldYeLmE/.vi/PFNWOPGknOW5pcemGMu', NULL, 'admin', 1, 'active', '2025-02-28 13:29:12', '2025-02-28 14:03:11'),
('a4d4-cdc8-c90b-4b82-a1bf', 'Lester', 'Farmer', 'wapumufy@mailinator.com', 'Doloremque recusanda', '+1 (467) 438-9514', '$2y$10$1xCDAvxdj/1Mti/NQxmxwewubqc0eIThEX12h/Pg8ZkcT1t4O2ZGG', NULL, 'admin', 0, 'inactive', '2025-02-28 13:55:32', '2025-02-28 15:14:33'),
('bb95-7bfb-133d-4396-8dab', 'Tanisha', 'Knight', 'manekengsorelle94@gmail.com', 'Ratione in Nam magna', '+1 (865) 967-6675', '$2y$10$gjfadqVkM2SKIRUkEUtFoOECMNeIJ7QIFe9I0ROOfBsGCQMp/7J2m', NULL, 'Gestionnaire Motel & Restaurant', 0, 'active', '2025-02-28 15:03:33', '2025-03-08 07:54:15'),
('d824-17c8-3549-455b-bd2f', 'Devin', 'Horn', 'xeqyme@mailinator.com', 'Et tempor voluptates', '+1 (664) 511-9921', '$2y$10$fET.VjefKgRXBK5Uy/RjyOdjmsPUkIYxBI6uX6QTRmEf4bVlr22Oe', NULL, 'Chef d’agence', 0, 'inactive', '2025-06-09 19:20:46', '2025-06-11 07:18:06'),
('e7a3-08e5-2ec5-454d-b19d', 'Reece', 'Austin', 'direnevami@mailinator.com', 'Reprehenderit ab ul', '+1 (126) 496-7742', '$2y$10$7Id3C0VnlDsLaqqFc/6O/.MXUoJwJiPPeqfedhcmxcFdGMv1hHs/O', NULL, 'admin', 1, 'active', '2025-02-28 13:53:12', '2025-02-28 14:03:38'),
('fcc8-c5ba-212f-49c7-ab98', 'Sean', 'Rivas', 'qixifywo@mailinator.com', 'Dolorem qui ratione ', '+1 (894) 282-3574', '$2y$10$1MrmEEKz78bPV3LeJUbeO.KLapHxEVVcoNYBEVtqe6T185.K6PIDG', NULL, 'Chef d’agence', 0, 'active', '2025-06-11 18:45:22', '2025-06-11 19:50:15');

-- --------------------------------------------------------

--
-- Structure de la table `user_immo`
--

CREATE TABLE `user_immo` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `immo_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_immo`
--

INSERT INTO `user_immo` (`id`, `user_id`, `immo_id`, `created_at`, `updated_at`) VALUES
('0d58-627d-1190-4a2f-8d08', 'bb95-7bfb-133d-4396-8dab', '550e8400-e29b-41d4-a716-446655440000', '2025-03-07 15:03:50', '2025-03-07 15:03:50'),
('4957-b4d2-86af-42ac-a8e1', '6fbc-5e43-4760-4b57-ab4c', '550e8400-e29b-41d4-a716-446655440000', '2025-03-07 15:07:28', '2025-03-07 15:07:28');

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

-- --------------------------------------------------------

--
-- Structure de la table `user_restaurant`
--

CREATE TABLE `user_restaurant` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `restaurant_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_restaurant`
--

INSERT INTO `user_restaurant` (`id`, `user_id`, `restaurant_id`, `created_at`, `updated_at`) VALUES
('590d-5e89-7c77-43f2-8e46', 'bb95-7bfb-133d-4396-8dab', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', '2025-03-03 09:40:10', '2025-03-03 09:40:10'),
('5f50-40ef-05a4-4246-85d1', '719a-bec0-3b45-482c-a331', 'de5e7ab5-f6cd-11ef-9cb8-d8cb8a12514d', '2025-03-04 11:20:59', '2025-03-04 11:20:59'),
('e119-8a8d-1057-4909-a615', '34fa-6718-b5c8-4dcc-8449', 'de5e7979-f6cd-11ef-9cb8-d8cb8a12514d', '2025-03-04 11:22:50', '2025-03-04 11:22:50');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agents_for_agency`
--
ALTER TABLE `agents_for_agency`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `agency_uuid` (`agency_uuid`),
  ADD KEY `added_by` (`added_by`);

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
-- Index pour la table `clients_abonnes`
--
ALTER TABLE `clients_abonnes`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `client_products`
--
ALTER TABLE `client_products`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `client_uuid` (`client_uuid`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`uuid`);

--
-- Index pour la table `customers_dossiers`
--
ALTER TABLE `customers_dossiers`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `finalisations_dossiers`
--
ALTER TABLE `finalisations_dossiers`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `dossier_uuid` (`dossier_uuid`);

--
-- Index pour la table `immo`
--
ALTER TABLE `immo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraisons_products`
--
ALTER TABLE `livraisons_products`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `product_uuid` (`product_uuid`),
  ADD KEY `delivery_man_id` (`delivery_man_id`);

--
-- Index pour la table `main_agencies`
--
ALTER TABLE `main_agencies`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `manager_uuid` (`manager_uuid`);

--
-- Index pour la table `motel`
--
ALTER TABLE `motel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `main_agency_uuid` (`main_agency_uuid`),
  ADD KEY `collected_by` (`collected_by`),
  ADD KEY `delivery_by` (`delivery_by`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `prestations_client`
--
ALTER TABLE `prestations_client`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `client_uuid` (`client_uuid`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `reservation_menu`
--
ALTER TABLE `reservation_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `restaurant_id` (`restaurant_id`);

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
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `owner_id` (`owner_id`);

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
-- Index pour la table `user_immo`
--
ALTER TABLE `user_immo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `immo_id` (`immo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user_motel`
--
ALTER TABLE `user_motel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motel_id` (`motel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user_restaurant`
--
ALTER TABLE `user_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agents_for_agency`
--
ALTER TABLE `agents_for_agency`
  ADD CONSTRAINT `agents_for_agency_ibfk_1` FOREIGN KEY (`agency_uuid`) REFERENCES `main_agencies` (`uuid`) ON DELETE CASCADE,
  ADD CONSTRAINT `agents_for_agency_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

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
-- Contraintes pour la table `clients_abonnes`
--
ALTER TABLE `clients_abonnes`
  ADD CONSTRAINT `clients_abonnes_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `client_products`
--
ALTER TABLE `client_products`
  ADD CONSTRAINT `client_products_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_products_ibfk_2` FOREIGN KEY (`client_uuid`) REFERENCES `clients_abonnes` (`uuid`),
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_uuid`) REFERENCES `clients_abonnes` (`uuid`) ON DELETE CASCADE;

--
-- Contraintes pour la table `customers_dossiers`
--
ALTER TABLE `customers_dossiers`
  ADD CONSTRAINT `customers_dossiers_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `finalisations_dossiers`
--
ALTER TABLE `finalisations_dossiers`
  ADD CONSTRAINT `finalisations_dossiers_ibfk_1` FOREIGN KEY (`dossier_uuid`) REFERENCES `customers_dossiers` (`uuid`) ON DELETE CASCADE;

--
-- Contraintes pour la table `livraisons_products`
--
ALTER TABLE `livraisons_products`
  ADD CONSTRAINT `livraisons_products_ibfk_1` FOREIGN KEY (`product_uuid`) REFERENCES `client_products` (`uuid`),
  ADD CONSTRAINT `livraisons_products_ibfk_2` FOREIGN KEY (`delivery_man_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `livraisons_products_ibfk_3` FOREIGN KEY (`delivery_man_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `main_agencies`
--
ALTER TABLE `main_agencies`
  ADD CONSTRAINT `main_agencies_ibfk_1` FOREIGN KEY (`manager_uuid`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`main_agency_uuid`) REFERENCES `main_agencies` (`uuid`),
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`collected_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `packages_ibfk_3` FOREIGN KEY (`delivery_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `prestations_client`
--
ALTER TABLE `prestations_client`
  ADD CONSTRAINT `prestations_client_ibfk_1` FOREIGN KEY (`client_uuid`) REFERENCES `customers_dossiers` (`uuid`) ON DELETE CASCADE,
  ADD CONSTRAINT `prestations_client_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reservation_menu`
--
ALTER TABLE `reservation_menu`
  ADD CONSTRAINT `reservation_menu_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservation_menu_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

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
-- Contraintes pour la table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tenants_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`id`);

--
-- Contraintes pour la table `user_immo`
--
ALTER TABLE `user_immo`
  ADD CONSTRAINT `user_immo_ibfk_1` FOREIGN KEY (`immo_id`) REFERENCES `immo` (`id`),
  ADD CONSTRAINT `user_immo_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `user_motel`
--
ALTER TABLE `user_motel`
  ADD CONSTRAINT `user_motel_ibfk_1` FOREIGN KEY (`motel_id`) REFERENCES `motel` (`id`),
  ADD CONSTRAINT `user_motel_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `user_restaurant`
--
ALTER TABLE `user_restaurant`
  ADD CONSTRAINT `user_restaurant_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `user_restaurant_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
