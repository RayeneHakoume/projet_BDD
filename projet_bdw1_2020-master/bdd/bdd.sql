-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2020 at 04:14 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Base`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categorie`
--

CREATE TABLE `Categorie` (
  `catId` int(11) NOT NULL,
  `nomCat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Categorie`
--

INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES
(33, 'Univers'),
(34, 'Voiture'),
(35, 'Avion de ligne'),
(36, 'Habitat'),
(37, 'Avion '),
(38, 'Nature'),
(39, 'PNG'),
(40, 'Autre'),
(41, 'Jeu');

-- --------------------------------------------------------

--
-- Table structure for table `Photo`
--

CREATE TABLE `Photo` (
  `photoId` int(11) NOT NULL,
  `nomFich` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `catId` int(11) NOT NULL,
  `uId` int(11) DEFAULT NULL,
  `visible` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Photo`
--

INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `image`, `catId`, `uId`, `visible`) VALUES
(1, 'La voie lactÃ©e', 'Image prise de l\'espace', 'm1.png', 33, 2, 'Oui'),
(2, 'Range Rover', 'Voiture SUV ', 'b4.png', 34, 2, 'Oui'),
(3, 'Boing A 380 ', 'Transporteur aÃ©rien', 'bo1.png', 35, 2, 'Oui'),
(4, 'Tante', 'Habitat des bÃ©douins arabes', 's2.png', 36, 2, 'Oui'),
(5, 'F 15 ', 'Avion de combat', 'bo6.png', 37, 2, 'Oui'),
(6, 'JetPrivÃ©e', 'Avion de transport privÃ©', 'bo5.png', 37, 2, 'Oui'),
(7, 'Faune', 'Jardin naturel', 'd2.png', 38, 2, 'Oui'),
(8, 'Soleil', 'Vue de l\'espace', 'm3.png', 33, 2, 'Oui'),
(9, 'Fiat', '....', '765_360_0-carros-mais-feios-de-sempre1_1528130513.jpg', 34, 2, 'Oui'),
(10, 'Avion de chasse', 'Avion de combat premiÃ¨re guÃ©rre mondiale', 'StreitP-4013.1.14.jpg', 37, 2, 'Oui'),
(11, 'Fantom ', 'Pacman', 'fantome.png', 39, 1, 'Oui'),
(12, 'Joueur', 'Pacman', 'pacman.png', 39, 1, 'Non'),
(13, 'Point ', 'Point Rouge ', 'pastille.png', 40, 1, 'Oui'),
(14, 'Vaisseau', 'Vaisseau dans space invader', 'space_craft.png', 41, 1, 'Oui'),
(15, 'Alien', 'Alien dans space invader', 'alien.png', 41, 1, 'Oui');

-- --------------------------------------------------------

--
-- Table structure for table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `uId` int(11) NOT NULL,
  `nomU` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `mP` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`uId`, `nomU`, `nom`, `mP`) VALUES
(0, 'root', 'root', 'root'),
(1, 'Utilisateur 1', 'Utilisateur 1', '1234'),
(2, 'Mous', 'Mous', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photoId`);

--
-- Indexes for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`uId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
