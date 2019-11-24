-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2019 at 01:34 PM
-- Server version: 10.1.24-MariaDB-6
-- PHP Version: 7.0.22-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cinema`
--

CREATE TABLE `Cinema` (
  `nom` varchar(30) NOT NULL,
  `companie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Cinema`
--

INSERT INTO `Cinema` (`nom`, `companie`) VALUES
('Ciné-Sel', 'Sel'),
('Pathé Boulogne', 'Pathé Gaumont'),
('UGC Vélizy', 'UGC'),
('UGC Versailles', 'UGC');

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

CREATE TABLE `Clients` (
  `numero_client` int(4) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mot_de_passe` varchar(30) NOT NULL,
  `type_de_reduction` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Clients`
--

INSERT INTO `Clients` (`numero_client`, `nom`, `prenom`, `email`, `mot_de_passe`, `type_de_reduction`) VALUES
(1, 'Marley', 'Bob', 'bob.marley@email.com', 'bob', 'none'),
(2, 'Queen', 'Alice', 'alice.queen@email.com', 'alice', 'have'),
(3, 'Dubreuil', 'Clément', 'clement.dubreuil@email.com', 'clement', 'none'),
(4, 'Abral', 'Mohamed', 'mohamed.abral@email.com', 'mohamed', 'have'),
(5, 'Dupont', 'Clément', 'clement.dupont@email.com', 'clement', 'none'),
(6, 'Zuckerberg', 'Mark', 'mark.zuckerberg@email.com', 'mark', 'have'),
(7, 'Dupond', 'Charles', 'charles.dupond@email.com', 'charles', 'none'),
(8, 'Daf', 'Max', 'max.daf@email.com', 'max', 'none'),
(9, 'Lemond', 'Max', 'max.lemond@email.com', 'max', 'none'),
(10, 'Valgrin', 'Brad', 'brad.valgrin@email.com', 'brad', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `Film`
--

CREATE TABLE `Film` (
  `numero_film` int(3) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `duree` int(11) NOT NULL,
  `origine` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Film`
--

INSERT INTO `Film` (`numero_film`, `nom`, `genre`, `duree`, `origine`) VALUES
(1, 'The Matrix', 'SF', 120, 'USA'),
(2, 'The Matrix reloaded', 'SF', 120, 'USA'),
(3, 'The Matrix revolution', 'SF', 120, 'USA'),
(4, 'The social network', 'Biographie', 120, 'USA'),
(5, 'V for Vendetta', 'Action', 120, 'USA'),
(6, 'Die hard', 'Action', 120, 'USA'),
(7, 'Toy Story', 'Animation', 120, 'USA'),
(8, 'Toy Story 2', 'Animation', 120, 'USA'),
(9, 'Toy Story 3', 'Animation', 120, 'USA'),
(10, 'Toy Story 4', 'Animation', 120, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `Note`
--

CREATE TABLE `Note` (
  `numero_client` int(11) NOT NULL,
  `numero_film` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Participe_au_film`
--

CREATE TABLE `Participe_au_film` (
  `numero_personne` int(11) NOT NULL,
  `numero_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Personne`
--

CREATE TABLE `Personne` (
  `numero_personne` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `metier` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Personne`
--

INSERT INTO `Personne` (`numero_personne`, `nom`, `prenom`, `age`, `metier`) VALUES
(1, 'Reeves', 'Keanu', 55, 'Acteur'),
(2, 'Fishburne', 'Laurence', 58, 'Acteur'),
(3, 'Wachowski', 'Lilly', 62, 'Directrice'),
(4, 'Wachowski', 'Lana', 60, 'Directrice'),
(5, 'Moss', 'Carrie-Anne', 62, 'Actrice'),
(6, 'Fincher', 'David', 57, 'Directeur'),
(7, 'Sorkin', 'Aaron', 58, 'Ecrivain'),
(8, 'Eisenberg', 'Jesse', 36, 'Acteur'),
(9, 'Garfield', 'Andrew', 36, 'Acteur'),
(10, 'Timberlake', 'Justin', 38, 'Acteur'),
(11, 'McTeigue', 'James', 52, 'Directeur'),
(12, 'Weaving', 'Hugo', 59, 'Acteur'),
(13, 'Portman', 'Natalie', 38, 'Actrice'),
(14, 'Graves', 'Rupert', 56, 'Acteur'),
(15, 'Lasseter', 'John', 62, 'Directeur'),
(16, 'Docter', 'Pete', 51, 'Ecrivain'),
(17, 'Hanks', 'Tom', 63, 'Doubleur'),
(18, 'Allen', 'Tim', 66, 'Doubleur'),
(19, 'Rickles', 'Don', 90, 'Doubleur');

-- --------------------------------------------------------

--
-- Table structure for table `Salle`
--

CREATE TABLE `Salle` (
  `numero_salle` int(11) NOT NULL,
  `nom_du_cinema` varchar(30) NOT NULL,
  `nombre_de_place` int(3) NOT NULL,
  `ville` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Salle`
--

INSERT INTO `Salle` (`numero_salle`, `nom_du_cinema`, `nombre_de_place`, `ville`) VALUES
(1, 'Ciné-Sel', 60, 'Sèvres'),
(1, 'Pathé Boulogne', 60, 'Boulogne'),
(1, 'UGC Vélizy', 60, 'Vélizy'),
(1, 'UGC Versailles', 60, 'Versailles'),
(2, 'Ciné-Sel', 60, 'Sèvres'),
(2, 'Pathé Boulogne', 60, 'Boulogne'),
(2, 'UGC Vélizy', 60, 'Vélizy'),
(2, 'UGC Versailles', 30, 'Versailles'),
(3, 'Ciné-Sel', 30, 'Sèvres'),
(3, 'Pathé Boulogne', 40, 'Boulogne'),
(3, 'UGC Vélizy', 60, 'Vélizy'),
(4, 'Pathé Boulogne', 30, 'Boulogne'),
(4, 'UGC Vélizy', 30, 'Vélizy');

-- --------------------------------------------------------

--
-- Table structure for table `Se_joue_dans`
--

CREATE TABLE `Se_joue_dans` (
  `DATE` int(11) NOT NULL,
  `heure` int(11) NOT NULL,
  `VERSION` varchar(30) NOT NULL,
  `numero_film` int(11) NOT NULL,
  `num_salle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Suit`
--

CREATE TABLE `Suit` (
  `numero_film_prec` int(11) NOT NULL,
  `numero_film_suiv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Veut_voir`
--

CREATE TABLE `Veut_voir` (
  `numero_client` int(11) NOT NULL,
  `numero_film` int(11) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cinema`
--
ALTER TABLE `Cinema`
  ADD PRIMARY KEY (`nom`);

--
-- Indexes for table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`numero_client`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`numero_film`);

--
-- Indexes for table `Note`
--
ALTER TABLE `Note`
  ADD PRIMARY KEY (`numero_client`,`numero_film`),
  ADD KEY `numero_film` (`numero_film`);

--
-- Indexes for table `Participe_au_film`
--
ALTER TABLE `Participe_au_film`
  ADD PRIMARY KEY (`numero_personne`,`numero_film`),
  ADD KEY `numero_film` (`numero_film`);

--
-- Indexes for table `Personne`
--
ALTER TABLE `Personne`
  ADD PRIMARY KEY (`numero_personne`);

--
-- Indexes for table `Salle`
--
ALTER TABLE `Salle`
  ADD PRIMARY KEY (`numero_salle`,`nom_du_cinema`),
  ADD KEY `nom_du_cinema` (`nom_du_cinema`);

--
-- Indexes for table `Se_joue_dans`
--
ALTER TABLE `Se_joue_dans`
  ADD PRIMARY KEY (`numero_film`,`num_salle`,`DATE`,`heure`),
  ADD KEY `num_salle` (`num_salle`);

--
-- Indexes for table `Suit`
--
ALTER TABLE `Suit`
  ADD PRIMARY KEY (`numero_film_prec`,`numero_film_suiv`),
  ADD KEY `numero_film_suiv` (`numero_film_suiv`);

--
-- Indexes for table `Veut_voir`
--
ALTER TABLE `Veut_voir`
  ADD PRIMARY KEY (`numero_client`,`numero_film`),
  ADD KEY `numero_film` (`numero_film`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Note`
--
ALTER TABLE `Note`
  ADD CONSTRAINT `Note_ibfk_1` FOREIGN KEY (`numero_client`) REFERENCES `Clients` (`numero_client`),
  ADD CONSTRAINT `Note_ibfk_2` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`);

--
-- Constraints for table `Participe_au_film`
--
ALTER TABLE `Participe_au_film`
  ADD CONSTRAINT `Participe_au_film_ibfk_1` FOREIGN KEY (`numero_personne`) REFERENCES `Personne` (`numero_personne`),
  ADD CONSTRAINT `Participe_au_film_ibfk_2` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`);

--
-- Constraints for table `Salle`
--
ALTER TABLE `Salle`
  ADD CONSTRAINT `Salle_ibfk_1` FOREIGN KEY (`nom_du_cinema`) REFERENCES `Cinema` (`nom`);

--
-- Constraints for table `Se_joue_dans`
--
ALTER TABLE `Se_joue_dans`
  ADD CONSTRAINT `Se_joue_dans_ibfk_1` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`),
  ADD CONSTRAINT `Se_joue_dans_ibfk_2` FOREIGN KEY (`num_salle`) REFERENCES `Salle` (`numero_salle`);

--
-- Constraints for table `Suit`
--
ALTER TABLE `Suit`
  ADD CONSTRAINT `Suit_ibfk_1` FOREIGN KEY (`numero_film_prec`) REFERENCES `Film` (`numero_film`),
  ADD CONSTRAINT `Suit_ibfk_2` FOREIGN KEY (`numero_film_suiv`) REFERENCES `Film` (`numero_film`);

--
-- Constraints for table `Veut_voir`
--
ALTER TABLE `Veut_voir`
  ADD CONSTRAINT `Veut_voir_ibfk_1` FOREIGN KEY (`numero_client`) REFERENCES `Clients` (`numero_client`),
  ADD CONSTRAINT `Veut_voir_ibfk_2` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
