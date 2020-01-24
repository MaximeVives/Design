-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2020 at 05:59 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `design`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AjoutPanier` (IN `P_user` INT, IN `P_obj` INT)  NO SQL
INSERT INTO `paniers` (`id_panier`, `id`, `id_produit`) VALUES (NULL, P_user, P_obj)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `debug` (IN `P_debug` VARCHAR(255))  NO SQL
INSERT INTO `debug` VALUES (NULL, P_debug, 0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEmail` (IN `P_user` INT)  NO SQL
SELECT `email` FROM `users` WHERE `id`= P_user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `int_debug` (IN `P_debug` INT)  NO SQL
INSERT INTO `debug` VALUES (NULL, "OUi", P_debug)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LinkPanierProduit` (IN `P_user` INT)  NO SQL
SELECT *
FROM `produits`
INNER JOIN `paniers` ON `produits`.id_produit = `paniers`.`id_produit`
WHERE `paniers`.`id`= P_user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MajQuantite` (IN `P_idProd` INT)  NO SQL
UPDATE `produits`
SET `quantite_produit` = `quantite_produit`-1
WHERE `id_produit` = P_idProd$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RecupPanier` (IN `P_user` INT)  NO SQL
SELECT * FROM `paniers` WHERE `id`=P_user$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `debug`
--

CREATE TABLE `debug` (
  `id_debug` int(11) NOT NULL,
  `text_debug` varchar(2000) NOT NULL,
  `int_debug` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debug`
--

INSERT INTO `debug` (`id_debug`, `text_debug`, `int_debug`) VALUES
(20, '2', 0),
(21, 'OUi', 2),
(22, 'OUi', 2),
(23, 'OUi', 3),
(24, 'Array', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paniers`
--

CREATE TABLE `paniers` (
  `id_panier` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paniers`
--

INSERT INTO `paniers` (`id_panier`, `id`, `id_produit`) VALUES
(1, 1, 1),
(4, 2, 1),
(5, 2, 1),
(6, 2, 1),
(7, 2, 1),
(8, 2, 1),
(9, 3, 1),
(10, 3, 1),
(11, 1, 1),
(12, 4, 1),
(13, 1, 1),
(14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` char(50) NOT NULL,
  `quantite_produit` int(11) NOT NULL,
  `prix_produit` float NOT NULL,
  `url_produit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `quantite_produit`, `prix_produit`, `url_produit`) VALUES
(1, 'Adidas am4 vit.01', 3, 159.99, 'A_vitality');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` char(255) NOT NULL,
  `prenom` char(255) NOT NULL,
  `age` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` char(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(255) NOT NULL,
  `remember_token` char(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `age`, `adresse`, `code_postal`, `ville`, `email`, `password`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Vives', 'Maxime', 18, 'rue de chez moi', 64230, 'Uzein', 'hastagmaxime@gmail.com', '$2y$10$vgXjGcFC/gAg9B1wvf2ZhOIg.L9EdvlRZNbjSR93Rm/GE8rsObvbW', 'XiHsbnWkLovwL8qbPTUYGJLz41hqGyMZzTUSDCtNHdpg31OhxFxt1iCvE59K', NULL, '2020-01-21 17:32:39', '2020-01-21 17:32:39'),
(2, 'Belot', 'Timery', 20, 'Rue de chez Timery', 64140, 'Gan', 'TimeryBelot@gmail.com', '$2y$10$ueYDl80yHOzRC7BRAlgheuBe4xJXbo6AJoBLKiuy3jb5paTGpo8lS', NULL, NULL, '2020-01-21 21:14:03', '2020-01-21 21:14:03'),
(3, 'Mariot', 'Pauline', 20, 'rue de chez Pauline', 64230, 'Lescar', 'poly.mariot@gmail.com', '$2y$10$ZH/0AlT.xEQAXDAMakTHmO7jVQ8I21hHdHqfiH2foYu6TICMYLdz2', NULL, NULL, '2020-01-23 16:55:12', '2020-01-23 16:55:12'),
(4, 'Corchia', 'Bernard', 48, 'rue de chez Bernard', 64230, 'Uzein', 'bernard.corchia@orange.fr', '$2y$10$0SYHafP9t1I5U8LpEC/SHOIP7bpjVmYxDp/QOFF.dxJloQxgp4CVe', NULL, NULL, '2020-01-23 22:29:50', '2020-01-23 22:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `ventes`
--

CREATE TABLE `ventes` (
  `id_vente` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debug`
--
ALTER TABLE `debug`
  ADD PRIMARY KEY (`id_debug`);

--
-- Indexes for table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id_panier`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id_vente`),
  ADD UNIQUE KEY `vente_AK` (`id_client`,`id_produit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debug`
--
ALTER TABLE `debug`
  MODIFY `id_debug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id_vente` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
