-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 23, 2020 at 03:58 PM
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
(1, 'Adidas am4 vit.01', 10, 159.99, 'A_vitality'),
(3, 'oui', 12, 67, ''),
(4, 'oui', 12, 67, '');

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
(1, 'Vives', 'Maxime', 18, 'rue de chez moi', 64230, 'Uzein', 'hastagmaxime@gmail.com', '$2y$10$vgXjGcFC/gAg9B1wvf2ZhOIg.L9EdvlRZNbjSR93Rm/GE8rsObvbW', '0QkWqZymgOYLsyRIOWsXiuktCpcl1xiicIO0PS47FTYxGMsn1xa8hWA99mmO', NULL, '2020-01-21 17:32:39', '2020-01-21 17:32:39'),
(2, 'Belot', 'Timery', 20, 'Rue de chez Timery', 64140, 'Gan', 'TimeryBelot@gmail.com', '$2y$10$ueYDl80yHOzRC7BRAlgheuBe4xJXbo6AJoBLKiuy3jb5paTGpo8lS', NULL, NULL, '2020-01-21 21:14:03', '2020-01-21 21:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `ventes`
--

CREATE TABLE `ventes` (
  `id_vente` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id_vente` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
