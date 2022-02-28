-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 fév. 2022 à 14:36
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_pizza`
--
CREATE DATABASE IF NOT EXISTS `projet_pizza` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projet_pizza`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `idArticle` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idArticle`, `nom`, `description`, `image`, `idCategorie`) VALUES
(1, 'americanDegeu', 'Viande, tomates, sauce dégeu', '..\\assets\\img\\americanDegeu.jpeg', 3),
(2, 'jambonCru', 'jambon cru, olives, parmesan', '..\\assets\\img\\jambonCru.jpeg', 2),
(9, 'Poivrons', 'Poivrons verts, poivrons rouges, poivrons jaunes... une pizza aux ... poivrons !', '..\\assets\\img\\poivrons.jpeg', 1),
(10, 'Champisilic', 'Fond crème fraiche, champignons et basilic', '..\\assets\\img\\champisilic.jpg', 2),
(11, 'Coeur', 'Pizza en forme de coeur sans aucun intérêt gustatif.', '..\\assets\\img\\coeur.jpg', 1),
(12, 'champoignbon', 'Pepperoni, tomates, poivron jaune, oignon rouge et champignon', '..\\assets\\img\\champoignbon.jpg', 1),
(13, 'Couronne du Christ', 'Lard, roquette, tomates confites', '..\\assets\\img\\couronneDuChrist.jpg', 3),
(14, 'Pizza aux fruits', 'Des fruits sur une pâte à pizza... Intérêt ? Grossir en pensant que non grâce aux fruits.', '..\\assets\\img\\fruitizza.jpg', 3),
(15, 'Mozza-Basilic', 'Un fon de tomate immonde, de la mozza saccagée dans ce fond, et du basilic brûlé.\r\nBonne chance !', '..\\assets\\img\\mozzaBasilic.jpg', 1),
(16, 'Pepperoni', 'Tout plein de Pepperoni et tout plein d\'emmental', '..\\assets\\img\\pepperoni.jpg', 1),
(17, 'Au carré !', 'Basilic, pesto & parmesan', '..\\assets\\img\\pizzaCarrée.jpg', 2),
(18, 'Veggizza', 'Carotte, chèvre et autres légumes', '\\assets\\img\\veggizza.jpg', 3),
(19, 'Vomita', 'Ne me demandez pas ce qu\'il y a dedans, jugez en vous-même avec la photo', '..\\assets\\img\\vomita.jpg', 2),
(20, 'Cheddar', 'Du cheddar en plus du fromage.\r\n- Light -', '\\assets\\img\\cheddar.png', 3),
(21, 'Tomate - Mozza', 'Tomate & Mozza', '\\assets\\img\\tomateMozza.jpg', 2),
(22, 'Coca cola 33cl', 'Du coca en 33cl', '..\\assets\\img\\coca33.jpg', 4),
(23, 'Cherry coke 33cl', 'Coca au cerise', '..\\assets\\img\\cherryCoke.jpg', 4),
(28, 'Jupilaiiire', 'de la biaiiire', '..\\assets\\img\\biaire.jpg', 7),
(29, 'Fanta orange 33cl', 'soda à l\'orange', '..\\assets\\img\\fanta.jpg', 4),
(30, 'Oasis Tropical 50 cl', 'Oasis 50cl', '../assets/img/oasis.jpg', 4),
(31, 'Orangina', 'Oranginaaaa', '../assets/img/orangina.jpg', 4),
(32, 'San Pellegrino', 'Eau gazeuse 50cl', '../assets/img/sanpellegrino.jpg', 6),
(33, 'Vittel 50 cl', 'Eau plate 50 cl', '..assets/img/vittel50.jpg', 5),
(34, 'Schweppes Agrumes 33cl', 'Soda aux agrumes', '..assets/img/schweppesAgrum.jpg', 4),
(35, 'Glace B & J chocolat', 'de la glace au chocolat', '..assets/img/ben&jeChoco.jpg', 9),
(36, 'Moelleux au chocolat', 'Du chocolat tout moelleux', '../assets/img/moelleuxChoco.jpg', 8),
(37, 'Tiramitsu', 'Tiramitsu fait par nos petites mains', '..assets/img/tiramitsu.jpg', 8),
(38, 'Glace B & J Chunky', 'Chunky freeze', '..assets/img/ben&jeChunky.jpg', 9),
(39, 'Half Bake', 'demi boulanger ? o_O', '..assets/img/ben&jeHalfBaked.jpg', 9);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `petite` double(10,2) NOT NULL,
  `grande` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCategorie`, `nom`, `image`, `petite`, `grande`) VALUES
(1, 'classiques', '', 9.00, '11.50'),
(2, 'gourmandes', '', 12.50, '14.20'),
(3, 'spéciales', '', 14.00, '15.30'),
(4, 'Soda 33cl ou boisson sucrée 50cl', '', 1.70, '2.00'),
(5, 'Eau ', '', 2.00, '0.00'),
(6, 'Eau gazeuse', '', 2.20, '0.00'),
(7, 'Alcool', '', 2.90, '0.00'),
(8, 'Dessert Maison', '', 2.50, '0.00'),
(9, 'Glace', '', 1.90, '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` enum('administrateur','client','','') NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `email`, `password`, `role`) VALUES
(1, 'admin@admin.fr', '$2y$10$JDnEyS52Fi9ZlMZ0z1/i0Ov528/T8xOtvdaAffyvQQoy1Uz0iK.n2', 'administrateur'),
(2, 'user@user.fr', '$2y$10$uXDlxTV1KhTHN6GaoIxJduSq8R6RwD2II2ChxuvJiGmApXZvskcMC', 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `catégorie` (`idCategorie`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `catégorie` FOREIGN KEY (`idCategorie`) REFERENCES `categories` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
