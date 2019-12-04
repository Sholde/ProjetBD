-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 04 Décembre 2019 à 14:48
-- Version du serveur :  10.1.24-MariaDB-6
-- Version de PHP :  7.0.22-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Cinema`
--

CREATE TABLE `Cinema` (
  `nom` varchar(30) NOT NULL,
  `compagnie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Cinema`
--

INSERT INTO `Cinema` (`nom`, `compagnie`) VALUES
('Ciné-Sel', 'Sel'),
('Pathé Boulogne', 'Pathé Gaumont');

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `num_client` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mot_de_passe` varchar(30) NOT NULL,
  `reduction` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Clients`
--

INSERT INTO `Clients` (`num_client`, `nom`, `prenom`, `email`, `mot_de_passe`, `reduction`) VALUES
(1, 'Marley', 'Bob', 'bob.marley@email.com', 'bob', 0),
(2, 'Queen', 'Alice', 'alice.queen@email.com', 'alice', 1),
(3, 'Dubreuil', 'Clément', 'clement.dubreuil@email.com', 'clement', 0),
(4, 'Abral', 'Mohamed', 'mohamed.abral@email.com', 'mohamed', 1),
(5, 'Dupont', 'Clément', 'clement.dupont@email.com', 'clement', 0),
(6, 'Zuckerberg', 'Mark', 'mark.zuckerberg@email.com', 'mark', 1),
(7, 'Dupond', 'Charles', 'charles.dupond@email.com', 'charles', 0),
(8, 'Daf', 'Max', 'max.daf@email.com', 'max', 0),
(9, 'Lemond', 'Max', 'max.lemond@email.com', 'max', 0),
(10, 'Valgrin', 'Brad', 'brad.valgrin@email.com', 'brad', 0),
(11, 'Gates', 'Bill', 'bill.gates@email.com', 'bill', 0),
(12, 'Linus', 'Torvalds', 'linus.torvalds@email.com', 'linus', 0),
(13, 'Jobs', 'Steve', 'steve.jobs@email.com', 'steve', 0),
(14, 'Alpher', 'Ralph', 'Ralph_Asher.Alpher@email.com', 'Alpha', 0),
(15, 'Bethe', 'Hans', 'bethe.1547@email.com', 'Beta', 0),
(17, 'Dicaprio', 'Leonardo', 'leo.caprio@email.com', 'leonard', 0),
(18, 'Lemaître', 'Georges', 'georgelemaitre@email.com', 'lemaitre', 0),
(19, 'Dieu', 'dieu', 'leternel@email.com', 'dieu', 1),
(20, 'Van Damme', 'jean-claude', 'jean-claude@email.com', 'vandamme', 1),
(21, 'Curie', 'Marie', 'marie8764@email.com', 'curie', 1),
(22, 'Tournachon', 'Gaspard-Félix', 'Nadar@email.com', 'nad', 0),
(23, 'Dumas', 'Alexandre', 'dumas_3mousqt@email.com', 'alex', 0),
(24, 'Einstein', 'Albert', 'Einsteinlebg@email.com', 'albert', 1),
(25, 'Clayton', 'Harold', 'Clay744@email.com', 'clay', 0),
(26, 'Lawrence', 'Ernest', 'lawrence.ernest@email.com', 'ernest', 0),
(27, 'Murphree', 'Eger', 'Eger.murphree@email.com', 'murph', 0),
(28, 'Compton', 'Arthur', 'arture.compton@email.com', 'art', 0),
(29, 'Bergerac', 'Cyrano', 'bergerac.cyr@email.com', 'cyr', 1),
(30, 'Poquelin', 'Jean-Baptiste', 'moliere@email.com', 'mol', 0),
(31, 'Kant', 'Emmanuel', 'Kant.Emma@email.com', 'manu', 0),
(32, 'Sand', 'George', 'gege.sand@email.com', 'sand', 0),
(33, 'Al-Kachi', 'Ghiyath', 'kachi@email.com', 'kashi', 1),
(34, 'Jackson', 'Michaël', 'thriller@email.com', 'mik', 0),
(35, 'Mendeleïev', 'Dmitri', 'tableau_periodique@email.com', 'dmidmi', 0),
(36, 'Arendt', 'Hannah', 'Hanna984@email.com', 'arendt', 0),
(37, 'Gandhi', 'Mohandas Karamchand', 'gandhi77816@email.com', 'gandhi', 0),
(38, 'Sempé', 'Jean-Jacques', 'SempeJeanJacques@email.com', 'semp', 0),
(39, 'Goscinny', 'René', 'reneGos@email.com', 'gos', 0),
(40, 'Perusse', 'Francois', 'deuxminpeuple@email.com', 'brad', 1),
(41, 'Ravel', 'Maurice', 'maumau@email.com', 'ravel', 0),
(42, 'Remi', 'George', 'tintindu45@email.com', 'tintin', 0),
(43, 'Spinoza', 'Baruch', 'baruch@email.com', 'spin', 0),
(44, 'Franklin', 'Benjamin', 'benjidu74@email.com', 'ben', 0),
(45, 'Goya', 'Francisco', 'francis.goya@email.com', 'goya', 1),
(46, 'Hardy', 'Olivier', 'hardy.olvier@email.com', 'olive', 0),
(47, 'Ionesco', 'Eugène', 'iones.eug@email.com', 'eug', 0),
(48, 'Ali', 'Mohamed', 'momoleboxeur@email.com', 'box', 0),
(49, 'Lavoisier', 'Antoine Laurent', 'antoinelavoisier@email.com', 'ant', 0),
(50, 'Mandela', 'Nelson', 'mand.nels@email.com', 'nels', 0),
(51, 'Kepler', 'Johannes', 'Johannes.Kepl@email.com', 'kel', 0),
(52, 'Descartes', 'René', 'Descartes.Rene@email.com', 'ren', 1),
(53, 'Torricelli', 'Evangelista', 'evang.torr@email.com', 'eve', 0),
(54, 'Newton', 'Isaac', 'iss.newt@email.com', 'new', 0),
(55, 'Watt', 'James', 'watt.james@email.com', 'watt', 0),
(56, 'Becquerel', 'Henri', 'henri.beck@email.com', 'becq', 1),
(57, 'Lorentz', 'Hendrik', 'lorentz.hendrik@email.com', 'lo', 1),
(58, 'Curie', 'Pierre', 'Pierre.curie@email.com', 'cur', 0),
(59, 'Bourgeois', 'Léon', 'bourg.leon@email.com', 'leon', 0),
(60, 'Simon', 'Claude', 'simon.claude@email.com', 'claude', 1),
(61, 'Allais', 'Maurice', 'allais.maurice@email.com', 'ail', 1),
(62, 'Debreu', 'Gérard', 'debreu.gérard@email.com', 'gege', 0),
(63, 'Cassin', 'René', 'cassin.rene@email.com', 'rene', 0),
(64, 'Néel', 'Louis', 'louis.neel@email.com', 'louis', 0),
(65, 'Jacob', 'François', 'jacob.franc@email.com', 'franc', 0),
(66, 'Lwoff', 'André', 'andre.lwoff@email.com', 'lw', 0),
(67, 'Sartre', 'Jean-Paul', 'jean.sartre@email.com', 'jp', 0),
(68, 'Camus', 'Albert', 'albert.camus@email.com', 'al', 1),
(69, 'Mauriac', 'François', 'mauriac.francois@email.com', 'fanc', 0),
(70, 'Jouhaux', 'Léon', 'leon.jouhaux@email.com', 'leon', 0),
(71, 'Sauvage', 'Jean-Pierre', 'sauvage.jp@email.com', 'jp', 1),
(72, 'Tirole', 'Jean', 'jean.tirole@emaiil.com', 'tirol', 0),
(73, 'Modiano', 'Patrick', 'modiano.patrick@email.com', 'modiano', 0),
(74, 'Serge', 'Haroche', 'serge.haroche@email.com', 'serg', 0),
(75, 'Chauvin', 'Yves', 'yves.chauvin@email.com', 'yves', 1),
(76, 'Xingjian', 'Gao', 'xingjian.gao@email.com', 'gao', 0),
(77, 'Agre', 'Peter', 'peter.agre@email.com', 'agre', 0),
(78, 'Alder', 'Kurt', 'alder.kurt@email.com', 'kurt', 1),
(79, 'Altman', 'Sidney', 'atlman.sydney@email.com', 'sid', 0),
(80, 'Sanger', 'Aziz', 'aziz.sanger@email.com', 'aziz', 0),
(81, 'Shirakawa', 'Hideki', 'hideki.shira@email.com', 'hid', 0),
(82, 'Steitz', 'Thomas', 'steitz.thomas@email.com', 'thomas', 0),
(83, 'Yonath', 'Ada', 'ada.yonath@email.com', 'yonath', 0),
(84, 'Yoshino', 'Akira', 'akira.yoshino@email.com', 'akira', 1),
(85, 'Wittig', 'Georg', 'wittig.georg@email.com', 'georg', 0),
(86, 'Wallach', 'Otto', 'wallach.otto@email.com', 'otto', 0),
(87, 'Warshel', 'Arieh', 'warshel.arieh@email.com', 'ariech', 0),
(88, 'Tsien', 'Roger', 'tsien.roger@email.com', 'roger', 0),
(89, 'Taube', 'Henry', 'henry.taube@email.com', 'taube', 0),
(90, 'Svedberg', 'Theodor', 'theodor.svedberg@email.com', 'theo', 0),
(91, 'Smalley', 'Richard', 'smalley.richard@email.com', 'smalley', 0),
(92, 'Polanyi', 'John', 'polanyi.john@email.com', 'john', 0),
(93, 'Porter', 'George', 'george.porter@email.com', 'porter', 1),
(94, 'Pauling', 'Linus', 'linus.pauling@email.com', 'lius', 0),
(95, 'Olah', 'George', 'george.olah@email.com', 'olah', 0),
(96, 'Nernst', 'Walter', 'nersnt.walter@email.com', 'ners', 0),
(97, 'Natta', 'Giulio', 'natta.giulio@email.com', 'natta', 0),
(98, 'Mullis', 'Kary', 'kary.mullis@email.com', 'mullis', 0),
(99, 'Mitchell', 'Peter', 'peter.mitchell@email.com', 'peter', 0),
(100, 'McMillian', 'Edwin', 'ed.mcmillian@email.com', 'ed', 0),
(101, 'Michel', 'Hartmut', 'mich.hart@email.com', 'mich', 0),
(102, 'Karle', 'Jerome', 'jerome.karle@email.com', 'karle', 0),
(103, 'Karlplus', 'Martin', 'karl.plus@email.com', 'k+', 0),
(104, 'Karrer', 'Paul', 'karrer.paul@email.com', 'paul', 0),
(105, 'Kendrew', 'John', 'john.kendrew@email.com', 'ken', 0),
(106, 'Klug', 'Aaron', 'klug.aaron@email.com', 'klug', 0),
(107, 'Kobilka', 'Brian', 'kob.brian@email.com', 'kob', 0),
(108, 'Kohn', 'Walter', 'kohn.walter@email.com', 'kohn', 0),
(109, 'Kornberg', 'Roger', 'kornberg.roger@email.com', 'roger', 0),
(110, 'Kroto', 'Harold', 'kroto.harold@email.com', 'kroto', 0),
(111, 'Kuhn', 'Richard', 'richard.kuhn@email.com', 'kuh', 0),
(112, 'Haber', 'Fritz', 'fritz.haber@email.com', 'fr', 0),
(113, 'Hahn', 'Otto', 'otto.hahn@email.com', 'otto', 1),
(114, 'Harden', 'Odd', 'harden.odd@email.com', 'odd', 0),
(115, 'Boltzmann', 'Ludwig', 'boltzman.ludwig@email.com', 'wig', 1),
(116, 'Brunhes', 'Bernard', 'bernard.brunches@email.com', 'nard', 1),
(117, 'Diu', 'Bernard', 'bernard.diu@email.com', 'diu', 0),
(118, 'Graetzel', 'Michael', 'michael.graetzel@email.cm', 'mich', 0),
(119, 'Gonczi', 'Georges', 'georges.gonczi@email.com', 'geo', 0),
(120, 'Bruhat', 'Georges', 'georges.bruhat@email.com', 'bru', 0),
(121, 'Rocard', 'Yves', 'yves.rocard@email.com', 'yves', 0),
(122, 'Stengers', 'Isabelle', 'isa.sten@email.com', 'sten', 1),
(123, 'Reif', 'Frederic', 'fred.reif@email.com', 'fred', 0),
(124, 'Jancovici', 'Bernard', 'nard.jand@email.com', 'jan', 1),
(125, 'Kubo', 'Ryogo', 'kubo.kubo@email.com', 'kubo', 0),
(126, 'Barberousse', 'Anouk', 'barbe.rousse@email.com', 'rousse', 0),
(127, 'Brush', 'Stephen', 'steph.bruch@email.com', 'steph', 0),
(128, 'Cercignani', 'Carlo', 'carlo.cerc@email.com', 'carlo', 0),
(129, 'Ehrenfest', 'Paul', 'paul.ehrenfest@email.com', 'paul', 0),
(130, 'Ehrenfest', 'Tatiana', 'tatiana.ehren@email.com', 'tati', 0),
(131, 'Harman', 'Peter', 'peter.harman@email.com', 'peter', 0),
(132, 'Maury', 'Jean-Pierre', 'jp.maury@email.com', 'maury', 0),
(133, 'Cork', 'James', 'james.cork@email.com', 'james', 0),
(134, 'Fernandez', 'Bernard', 'Fernandez.Bernard@email.com', 'fer', 0),
(135, 'Valentin', 'Luc', 'luc.valentin@email.com', 'luc', 0),
(136, 'David', 'Halliday', 'halliday.david@email.com', 'haliday', 0),
(137, 'Kaplan', 'Irving', 'kaplan.irving@email.com', 'irving', 0),
(138, 'Wesley', 'Addison', 'addison.weshley@email.com', 'weshl', 0),
(139, 'Marx', 'Karl', 'karl.marx@email.com', 'karl', 0),
(140, 'Engels', 'Friedrich', 'engels.fried@email.com', 'fried', 0),
(141, 'Joly', 'Maurice', 'joly.maurice@email.com', 'joly', 0),
(142, 'Tucker', 'Benjamin', 'Tucker.benjamin@email.com', 'ben', 0),
(143, 'Brentano', 'Franz', 'franz.bren@email.com', 'franz', 0),
(144, 'Max', 'Frisch', 'max.frisch@email.com', 'frisch', 0),
(145, 'Mach', 'Ernst', 'ernst.mach@email.com', 'ernst', 0),
(146, 'James', 'William', 'William.james@email.com', 'james', 0),
(147, 'Cohen', 'Hermann', 'cohen.hermann@email.com', 'herm', 0),
(148, 'Tarde', 'Gabriel', 'gabriel.tarde@email.com', 'gab', 0),
(149, 'Nietzsche', 'Friedrich', 'fried.niet@email.com', 'fried', 0),
(150, 'Frege', 'Gottlob', 'frege.gottlob@email.com', 'frege', 0),
(151, 'Freud', 'Sigmund', 'freud.Sigmund@email.com', 'freud', 0),
(152, 'Hannequin', 'Arthur', 'Hanneq.Art@email.com', 'art', 1),
(153, 'Belot', 'Gustave', 'belot.gust@email.com', 'gust', 1),
(154, 'Dewet', 'John', 'john.dewet@email.com', 'dewet', 0),
(155, 'Bergson', 'Henri', 'henri.bergson@email.com', 'henri', 0),
(156, 'Duhem', 'Pierre', 'pierre.duhem@email.com', 'duhem', 0),
(157, 'Blondel', 'Maurice', 'maurice.blondel@email.com', 'blond', 0),
(158, 'Palante', 'Georges', 'georges.palante@email.com', 'palante', 0),
(159, 'Santayana', 'George', 'george.santa@email.com', 'santa', 0),
(160, 'Weber', 'Max', 'weber.max@email.com', 'max', 0),
(161, 'Chestov', 'Léon', 'leon.chestove@email.com', 'chestov', 0),
(162, 'Croce', 'Benedetto', 'croce.benedetto@email.com', 'croce', 0),
(163, 'Max', 'Scheler', 'max.scheler@email.com', 'max', 0),
(164, 'Maritain', 'Jacques', 'maritain.jacques@email.com', 'jak', 0),
(165, 'Heidegger', 'Martin', 'martin.h@email.com', 'password', 0),
(166, 'Dalbiez', 'Roland', 'roland.dal@email.com', 'roland', 1),
(167, 'Carnap', 'Rudolf', 'rudol.carnap@email.com', 'carnap', 0),
(168, 'Hazlitt', 'Henry', 'henry.haz@email.com', 'haz', 0),
(169, 'Marcuse', 'Herbert', 'marcuse.herbert@email.com', 'marc', 0),
(170, 'Strauss', 'Leo', 'leo.strauss@email.com', 'leo', 0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `client_avec_reduction`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `client_avec_reduction` (
`num_client` int(11)
,`nom` varchar(30)
,`prenom` varchar(30)
,`email` varchar(30)
,`mot_de_passe` varchar(30)
,`reduction` tinyint(1)
);

-- --------------------------------------------------------

--
-- Structure de la table `Film`
--

CREATE TABLE `Film` (
  `num_film` int(3) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `genre` varchar(256) NOT NULL,
  `duree` int(11) NOT NULL,
  `origine` varchar(30) NOT NULL,
  `version_disponible` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Film`
--

INSERT INTO `Film` (`num_film`, `nom`, `genre`, `duree`, `origine`, `version_disponible`) VALUES
(1, 'The Matrix', 'Science-Fiction - Action', 120, 'USA', 'all'),
(2, 'The Matrix reloaded', 'Science-Fiction - Action', 120, 'USA', 'all'),
(3, 'The Matrix revolution', 'Science-Fiction - Action', 120, 'USA', 'all'),
(4, 'The social network', 'Biographie - Drame', 120, 'USA', 'all'),
(5, 'V for Vendetta', 'Action', 120, 'USA', 'vf'),
(6, 'Die hard', 'Action', 120, 'USA', 'vo'),
(7, 'Die hard 2', 'Action', 120, 'USA', 'vo'),
(8, 'Die hard 3', 'Action', 120, 'USA', 'vo'),
(9, 'Die hard 4', 'Action', 120, 'USA', 'vo');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `film_vf`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `film_vf` (
`num_film` int(3)
,`nom` varchar(30)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `film_vo`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `film_vo` (
`num_film` int(3)
,`nom` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure de la table `Note`
--

CREATE TABLE `Note` (
  `num_client` int(11) NOT NULL,
  `num_film` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Note`
--

INSERT INTO `Note` (`num_client`, `num_film`, `note`) VALUES
(1, 1, 3),
(1, 4, 3),
(4, 5, 1),
(4, 6, 2),
(4, 8, 1),
(6, 3, 5),
(10, 7, 4),
(12, 2, 2),
(14, 7, 2),
(18, 5, 5),
(20, 4, 3),
(20, 6, 3),
(21, 1, 3),
(21, 4, 4),
(22, 5, 4),
(32, 5, 1),
(34, 1, 3),
(37, 9, 2),
(41, 3, 4),
(45, 4, 2),
(50, 1, 5),
(55, 1, 5),
(55, 7, 2),
(67, 4, 2),
(99, 4, 5),
(101, 3, 3),
(112, 3, 3),
(133, 8, 1),
(139, 3, 4),
(144, 1, 4),
(152, 1, 3),
(152, 4, 4),
(152, 8, 3),
(157, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Participe_au_film`
--

CREATE TABLE `Participe_au_film` (
  `num_personne` int(11) NOT NULL,
  `num_film` int(11) NOT NULL,
  `metier` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Participe_au_film`
--

INSERT INTO `Participe_au_film` (`num_personne`, `num_film`, `metier`) VALUES
(1, 1, 'Acteur'),
(1, 2, 'Acteur'),
(1, 3, 'Acteur'),
(2, 1, 'Acteur'),
(2, 2, 'Acteur'),
(2, 3, 'Acteur'),
(3, 1, 'Directrice - Scénariste'),
(3, 2, 'Directrice - Scénariste'),
(3, 3, 'Directrice - Scénariste'),
(3, 5, 'Scénariste'),
(4, 1, 'Directrice - Scénariste'),
(4, 2, 'Directrice - Scénariste'),
(4, 3, 'Directrice - Scénariste'),
(4, 5, 'Scénariste'),
(5, 1, 'Actrice'),
(5, 2, 'Actrice'),
(5, 3, 'Actrice'),
(6, 4, 'Directeur'),
(7, 4, 'Scénariste'),
(8, 4, 'Acteur'),
(9, 4, 'Acteur'),
(10, 4, 'Acteur'),
(11, 5, 'Directeur'),
(12, 5, 'Acteur'),
(13, 5, 'Actrice'),
(14, 5, 'Acteur'),
(15, 6, 'Directeur'),
(15, 7, 'Directeur'),
(15, 8, 'Directeur'),
(15, 9, 'Directeur'),
(16, 6, 'Acteur'),
(16, 7, 'Acteur'),
(16, 8, 'Acteur'),
(16, 9, 'Acteur'),
(17, 6, 'Scénariste'),
(17, 7, 'Scénariste'),
(17, 8, 'Scénariste'),
(17, 9, 'Scénariste'),
(18, 6, 'Acteur');

-- --------------------------------------------------------

--
-- Structure de la table `Personne`
--

CREATE TABLE `Personne` (
  `num_personne` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Personne`
--

INSERT INTO `Personne` (`num_personne`, `nom`, `prenom`, `age`) VALUES
(1, 'Reeves', 'Keanu', 55),
(2, 'Fishburne', 'Laurence', 58),
(3, 'Wachowski', 'Lilly', 62),
(4, 'Wachowski', 'Lana', 60),
(5, 'Moss', 'Carrie-Anne', 62),
(6, 'Fincher', 'David', 57),
(7, 'Sorkin', 'Aaron', 58),
(8, 'Eisenberg', 'Jesse', 36),
(9, 'Garfield', 'Andrew', 36),
(10, 'Timberlake', 'Justin', 38),
(11, 'McTeigue', 'James', 52),
(12, 'Weaving', 'Hugo', 59),
(13, 'Portman', 'Natalie', 38),
(14, 'Graves', 'Rupert', 56),
(15, 'McTierman', 'John', 68),
(16, 'Willis', 'Bruce', 62),
(17, 'Stuart', 'James', 63),
(18, 'Rickman', 'Alan', 69);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `personne_majeur`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `personne_majeur` (
`num_personne` int(11)
,`nom` varchar(30)
,`prenom` varchar(30)
,`age` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `Salle`
--

CREATE TABLE `Salle` (
  `num_salle` int(11) NOT NULL,
  `nom_du_cinema` varchar(30) NOT NULL,
  `nb_de_place` int(11) NOT NULL,
  `ville` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Salle`
--

INSERT INTO `Salle` (`num_salle`, `nom_du_cinema`, `nb_de_place`, `ville`) VALUES
(1, 'Ciné-Sel', 30, 'Sèvres'),
(1, 'Pathé Boulogne', 30, 'Boulogne'),
(2, 'Pathé Boulogne', 30, 'Boulogne');

-- --------------------------------------------------------

--
-- Structure de la table `Se_joue_dans`
--

CREATE TABLE `Se_joue_dans` (
  `num_se_joue` int(11) NOT NULL,
  `jour` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `version` varchar(30) NOT NULL,
  `num_film` int(11) DEFAULT NULL,
  `num_salle` int(11) DEFAULT NULL,
  `nom_du_cinema` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Se_joue_dans`
--

INSERT INTO `Se_joue_dans` (`num_se_joue`, `jour`, `heure`, `version`, `num_film`, `num_salle`, `nom_du_cinema`) VALUES
(1, '2019-12-16', '10:00:00', 'vf', 1, 1, 'Pathé Boulogne'),
(2, '2019-12-16', '10:00:00', 'vo', 6, 2, 'Pathé Boulogne'),
(3, '2019-12-16', '15:00:00', 'vf', 2, 1, 'Pathé Boulogne'),
(4, '2019-12-16', '16:00:00', 'vf', 5, 2, 'Pathé Boulogne'),
(5, '2019-12-16', '10:00:00', 'vf', 4, 1, 'Ciné-Sel'),
(6, '2019-12-16', '15:00:00', 'vf', 5, 1, 'Ciné-Sel'),
(7, '2019-12-17', '09:00:00', 'vf', 3, 1, 'Pathé Boulogne'),
(8, '2019-12-17', '11:00:00', 'vf', 1, 1, 'Ciné-Sel'),
(9, '2019-12-18', '17:00:00', 'vf', 4, 1, 'Pathé Boulogne'),
(10, '2019-12-18', '17:00:00', 'vo', 6, 1, 'Ciné-Sel'),
(11, '2019-12-20', '14:00:00', 'vo', 2, 1, 'Ciné-Sel'),
(12, '2019-12-21', '21:00:00', 'vo', 1, 1, 'Pathé Boulogne');

-- --------------------------------------------------------

--
-- Structure de la table `Suit`
--

CREATE TABLE `Suit` (
  `num_film_prec` int(11) NOT NULL,
  `num_film_suiv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Suit`
--

INSERT INTO `Suit` (`num_film_prec`, `num_film_suiv`) VALUES
(1, 2),
(2, 3),
(6, 7),
(7, 8),
(8, 9);

-- --------------------------------------------------------

--
-- Structure de la table `Veut_voir`
--

CREATE TABLE `Veut_voir` (
  `num_veut_voir` int(11) NOT NULL,
  `num_se_joue` int(11) NOT NULL,
  `num_client` int(11) NOT NULL,
  `num_film` int(11) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Veut_voir`
--

INSERT INTO `Veut_voir` (`num_veut_voir`, `num_se_joue`, `num_client`, `num_film`, `prix`) VALUES
(1, 1, 1, 1, 6),
(2, 1, 1, 1, 6),
(3, 1, 2, 1, 5),
(4, 1, 50, 1, 6),
(5, 1, 50, 1, 6),
(6, 1, 50, 1, 6),
(7, 1, 50, 1, 6),
(8, 1, 50, 1, 6),
(9, 1, 45, 1, 5),
(10, 1, 45, 1, 5),
(11, 1, 45, 1, 5),
(12, 1, 45, 1, 5),
(13, 1, 45, 1, 5),
(14, 1, 45, 1, 5),
(15, 1, 45, 1, 5),
(16, 1, 45, 1, 5),
(17, 1, 45, 1, 5),
(18, 1, 30, 1, 6),
(19, 1, 30, 1, 6),
(20, 1, 30, 1, 6),
(21, 1, 30, 1, 6),
(22, 1, 5, 1, 6),
(23, 1, 12, 1, 6),
(24, 2, 6, 6, 5),
(25, 2, 6, 6, 5),
(26, 2, 6, 6, 5),
(27, 2, 24, 6, 5),
(28, 2, 24, 6, 5),
(29, 2, 24, 6, 5),
(30, 2, 24, 6, 5),
(31, 2, 47, 6, 6),
(32, 2, 47, 6, 6),
(33, 3, 109, 2, 6),
(34, 3, 109, 2, 6),
(35, 3, 109, 2, 6),
(36, 3, 64, 2, 6),
(37, 3, 64, 2, 6),
(38, 3, 64, 2, 6),
(39, 3, 64, 2, 6),
(40, 3, 64, 2, 6),
(41, 3, 64, 2, 6),
(42, 3, 134, 2, 6),
(43, 3, 134, 2, 6),
(44, 3, 134, 2, 6),
(45, 3, 134, 2, 6),
(46, 3, 78, 2, 5),
(47, 3, 78, 2, 5),
(48, 3, 78, 2, 5),
(49, 3, 78, 2, 5),
(50, 4, 109, 5, 6),
(51, 4, 117, 5, 6),
(52, 4, 160, 5, 6),
(53, 4, 10, 5, 6),
(54, 4, 57, 5, 5),
(55, 4, 57, 5, 5),
(56, 4, 57, 5, 5),
(57, 4, 57, 5, 5),
(58, 4, 76, 5, 6),
(59, 4, 76, 5, 6),
(60, 4, 131, 5, 6),
(61, 4, 137, 5, 6),
(62, 4, 131, 5, 6),
(63, 4, 8, 5, 6),
(64, 4, 81, 5, 6),
(65, 4, 81, 5, 6),
(66, 4, 81, 5, 6),
(67, 4, 81, 5, 6),
(68, 5, 14, 4, 6),
(70, 5, 14, 4, 6),
(71, 5, 14, 4, 6),
(72, 5, 14, 4, 6),
(73, 6, 11, 5, 6),
(74, 6, 14, 5, 6),
(75, 6, 99, 5, 6),
(76, 6, 99, 5, 6),
(77, 6, 99, 5, 6),
(78, 6, 99, 5, 6),
(79, 6, 126, 5, 6),
(80, 6, 126, 5, 6),
(81, 7, 87, 3, 6),
(82, 7, 87, 3, 6),
(83, 7, 87, 3, 6),
(84, 7, 87, 3, 6),
(85, 8, 104, 1, 6),
(86, 8, 104, 1, 6),
(87, 8, 7, 1, 6),
(88, 8, 8, 1, 6),
(89, 8, 8, 1, 6),
(90, 9, 44, 4, 6),
(91, 9, 44, 4, 6),
(92, 9, 44, 4, 6),
(93, 9, 44, 4, 6),
(94, 9, 44, 4, 6),
(95, 9, 44, 4, 6),
(96, 9, 44, 4, 6),
(97, 9, 44, 4, 6),
(98, 10, 153, 6, 5),
(99, 10, 153, 6, 5),
(100, 10, 153, 6, 5),
(101, 10, 153, 6, 5),
(102, 10, 153, 6, 5),
(103, 10, 153, 6, 5),
(104, 10, 153, 6, 5),
(105, 10, 153, 6, 5),
(106, 10, 153, 6, 5),
(107, 10, 153, 6, 5),
(108, 10, 153, 6, 5),
(109, 10, 153, 6, 5),
(110, 10, 153, 6, 5),
(111, 10, 153, 6, 5),
(112, 10, 153, 6, 5),
(113, 10, 153, 6, 5),
(114, 11, 36, 2, 6),
(115, 11, 36, 2, 6),
(116, 11, 36, 2, 6),
(117, 11, 144, 2, 6),
(118, 11, 36, 2, 6),
(119, 11, 36, 2, 6),
(120, 11, 36, 2, 6),
(121, 11, 36, 2, 6),
(122, 12, 14, 1, 6),
(123, 12, 15, 1, 6),
(124, 12, 14, 1, 6),
(125, 12, 14, 1, 6),
(126, 12, 117, 1, 6),
(127, 12, 117, 1, 6),
(128, 12, 9, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la vue `client_avec_reduction`
--
DROP TABLE IF EXISTS `client_avec_reduction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `client_avec_reduction`  AS  (select `c`.`num_client` AS `num_client`,`c`.`nom` AS `nom`,`c`.`prenom` AS `prenom`,`c`.`email` AS `email`,`c`.`mot_de_passe` AS `mot_de_passe`,`c`.`reduction` AS `reduction` from `Clients` `c` where (`c`.`reduction` <> 0)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `film_vf`
--
DROP TABLE IF EXISTS `film_vf`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `film_vf`  AS  (select `f`.`num_film` AS `num_film`,`f`.`nom` AS `nom` from (`Film` `f` join `Se_joue_dans` `j`) where ((`f`.`num_film` = `j`.`num_film`) and (`j`.`version` like 'vf')) group by `f`.`nom`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `film_vo`
--
DROP TABLE IF EXISTS `film_vo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `film_vo`  AS  (select `f`.`num_film` AS `num_film`,`f`.`nom` AS `nom` from (`Film` `f` join `Se_joue_dans` `j`) where ((`f`.`num_film` = `j`.`num_film`) and (`j`.`version` like 'vo')) group by `f`.`nom`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `personne_majeur`
--
DROP TABLE IF EXISTS `personne_majeur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `personne_majeur`  AS  (select `p`.`num_personne` AS `num_personne`,`p`.`nom` AS `nom`,`p`.`prenom` AS `prenom`,`p`.`age` AS `age` from `Personne` `p` where (`p`.`age` >= 18)) ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Cinema`
--
ALTER TABLE `Cinema`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`num_client`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`num_film`);

--
-- Index pour la table `Note`
--
ALTER TABLE `Note`
  ADD PRIMARY KEY (`num_client`,`num_film`),
  ADD KEY `num_film` (`num_film`);

--
-- Index pour la table `Participe_au_film`
--
ALTER TABLE `Participe_au_film`
  ADD PRIMARY KEY (`num_personne`,`num_film`),
  ADD KEY `num_film` (`num_film`);

--
-- Index pour la table `Personne`
--
ALTER TABLE `Personne`
  ADD PRIMARY KEY (`num_personne`);

--
-- Index pour la table `Salle`
--
ALTER TABLE `Salle`
  ADD PRIMARY KEY (`num_salle`,`nom_du_cinema`),
  ADD KEY `nom_du_cinema` (`nom_du_cinema`);

--
-- Index pour la table `Se_joue_dans`
--
ALTER TABLE `Se_joue_dans`
  ADD PRIMARY KEY (`num_se_joue`),
  ADD KEY `num_film` (`num_film`),
  ADD KEY `num_salle` (`num_salle`,`nom_du_cinema`);

--
-- Index pour la table `Suit`
--
ALTER TABLE `Suit`
  ADD PRIMARY KEY (`num_film_prec`,`num_film_suiv`),
  ADD KEY `num_film_suiv` (`num_film_suiv`);

--
-- Index pour la table `Veut_voir`
--
ALTER TABLE `Veut_voir`
  ADD PRIMARY KEY (`num_veut_voir`),
  ADD KEY `num_se_joue` (`num_se_joue`),
  ADD KEY `num_client` (`num_client`),
  ADD KEY `num_film` (`num_film`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Note`
--
ALTER TABLE `Note`
  ADD CONSTRAINT `Note_ibfk_1` FOREIGN KEY (`num_client`) REFERENCES `Clients` (`num_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Note_ibfk_2` FOREIGN KEY (`num_film`) REFERENCES `Film` (`num_film`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Participe_au_film`
--
ALTER TABLE `Participe_au_film`
  ADD CONSTRAINT `Participe_au_film_ibfk_1` FOREIGN KEY (`num_personne`) REFERENCES `Personne` (`num_personne`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Participe_au_film_ibfk_2` FOREIGN KEY (`num_film`) REFERENCES `Film` (`num_film`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Salle`
--
ALTER TABLE `Salle`
  ADD CONSTRAINT `Salle_ibfk_1` FOREIGN KEY (`nom_du_cinema`) REFERENCES `Cinema` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Se_joue_dans`
--
ALTER TABLE `Se_joue_dans`
  ADD CONSTRAINT `Se_joue_dans_ibfk_1` FOREIGN KEY (`num_film`) REFERENCES `Film` (`num_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Se_joue_dans_ibfk_2` FOREIGN KEY (`num_salle`,`nom_du_cinema`) REFERENCES `Salle` (`num_salle`, `nom_du_cinema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Suit`
--
ALTER TABLE `Suit`
  ADD CONSTRAINT `Suit_ibfk_1` FOREIGN KEY (`num_film_prec`) REFERENCES `Film` (`num_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Suit_ibfk_2` FOREIGN KEY (`num_film_suiv`) REFERENCES `Film` (`num_film`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Veut_voir`
--
ALTER TABLE `Veut_voir`
  ADD CONSTRAINT `Veut_voir_ibfk_1` FOREIGN KEY (`num_se_joue`) REFERENCES `Se_joue_dans` (`num_se_joue`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Veut_voir_ibfk_2` FOREIGN KEY (`num_client`) REFERENCES `Clients` (`num_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Veut_voir_ibfk_3` FOREIGN KEY (`num_film`) REFERENCES `Film` (`num_film`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
