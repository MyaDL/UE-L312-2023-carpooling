-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 nov. 2023 à 16:13
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carpooling`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`id`, `driver_id`, `tel`, `price`, `payment_method`) VALUES
(1, 1, '0707070707', 25, 'Carte bancaire'),
(2, 2, '0606060606', 20, 'Chèque');

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `door` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `color`, `door`) VALUES
(1, 'Peugeot', '308', 'Noir', 5),
(2, 'Ford', 'KA', 'Verte', 3),
(3, 'Renault', 'ZOE', 'Blanche', 5);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `start_address` varchar(255) NOT NULL,
  `arrival_address` varchar(255) NOT NULL,
  `start_date_time` datetime NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `creator_id`, `start_address`, `arrival_address`, `start_date_time`, `message`) VALUES
(1, 1, '20 rue des tuilleries', '30 rue des tuilleries', '2023-06-05 00:00:00', 'Hello'),
(2, 2, '20 rue des fleures', '25 rue des fleures', '2023-07-05 00:00:00', 'Hey !');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Jean', 'Pierre', 'jean@pierre.fr', '1995-05-06 00:00:00'),
(2, 'Magalie', 'Bernard', 'magali@bernard.fr', '2001-06-21 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
