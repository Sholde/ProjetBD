-- MySQL dump 10.17  Distrib 10.3.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: admin
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Cinema`
--

DROP TABLE IF EXISTS `Cinema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cinema` (
  `nom` varchar(30) NOT NULL,
  `companie` varchar(30) NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cinema`
--

LOCK TABLES `Cinema` WRITE;
/*!40000 ALTER TABLE `Cinema` DISABLE KEYS */;
INSERT INTO `Cinema` VALUES ('Ciné-Sel','Sel'),('Pathé Boulogne','Pathé Gaumont'),('UGC Vélizy','UGC'),('UGC Versailles','UGC');
/*!40000 ALTER TABLE `Cinema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients` (
  `numero_client` int(4) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mot_de_passe` varchar(30) NOT NULL,
  `type_de_reduction` varchar(30) NOT NULL,
  PRIMARY KEY (`numero_client`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients`
--

LOCK TABLES `Clients` WRITE;
/*!40000 ALTER TABLE `Clients` DISABLE KEYS */;
INSERT INTO `Clients` VALUES (1,'Marley','Bob','bob.marley@email.com','bob','none'),(2,'Queen','Alice','alice.queen@email.com','alice','have'),(3,'Dubreuil','Clément','clement.dubreuil@email.com','clement','none'),(4,'Abral','Mohamed','mohamed.abral@email.com','mohamed','have'),(5,'Dupont','Clément','clement.dupont@email.com','clement','none'),(6,'Zuckerberg','Mark','mark.zuckerberg@email.com','mark','have'),(7,'Dupond','Charles','charles.dupond@email.com','charles','none'),(8,'Daf','Max','max.daf@email.com','max','none'),(9,'Lemond','Max','max.lemond@email.com','max','none'),(10,'Valgrin','Brad','brad.valgrin@email.com','brad','none'),(11,'Gates','Bill','bill.gates@email.com','bill','0'),(12,'Linus','Torvalds','linus.torvalds@email.com','linus','0'),(13,'Jobs','Steve','steve.jobs@email.com','steve','0'),(14,'Alpher','Ralph','Ralph_Asher.Alpher@email.com','Alpha','0'),(15,'Bethe','Hans','bethe.1547@email.com','Beta','0'),(16,'Gamow','George','gamow.gege@email.com','Gamma','1'),(17,'Dicaprio','Leonardo','leo.caprio@email.com','leonard','0'),(18,'Lemaître','Georges','georgelemaitre@email.com','lemaitre','0'),(19,'Dieu','dieu','leternel@email.com','dieu','1'),(20,'Van Damme','jean-claude','jean-claude@email.com','vandamme','1'),(21,'Curie','Marie','marie8764@email.com','curie','1'),(22,'Tournachon','Gaspard-Félix','Nadar@email.com','nad','0'),(23,'Dumas','Alexandre','dumas_3mousqt@email.com','alex','0'),(24,'Einstein','Albert','Einsteinlebg@email.com','albert','1'),(25,'Clayton','Harold','Clay744@email.com','clay','0'),(26,'Lawrence','Ernest','lawrence.ernest@email.com','ernest','0'),(27,'Murphree','Eger','Eger.murphree@email.com','murph','0'),(28,'Compton','Arthur','arture.compton@email.com','art','0'),(29,'Bergerac','Cyrano','bergerac.cyr@email.com','cyr','1'),(30,'Poquelin','Jean-Baptiste','moliere@email.com','mol','0'),(31,'Kant','Emmanuel','Kant.Emma@email.com','manu','0'),(32,'Sand','George','gege.sand@email.com','sand','0'),(33,'Al-Kachi','Ghiyath','kachi@email.com','kashi','1'),(34,'Jackson','Michaël','thriller@email.com','mik','0'),(35,'Mendeleïev','Dmitri','tableau_periodique@email.com','dmidmi','0'),(36,'Arendt','Hannah','Hanna984@email.com','arendt','0'),(37,'Gandhi','Mohandas Karamchand','gandhi77816@email.com','gandhi','0'),(38,'Sempé','Jean-Jacques','SempeJeanJacques@email.com','semp','0'),(39,'Goscinny','René','reneGos@email.com','gos','0'),(40,'Perusse','Francois','deuxminpeuple@email.com','brad','1'),(41,'Ravel','Maurice','maumau@email.com','ravel','0'),(42,'Remi','George','tintindu45@email.com','tintin','0'),(43,'Spinoza','Baruch','baruch@email.com','spin','0'),(44,'Franklin','Benjamin','benjidu74@email.com','ben','0'),(45,'Goya','Francisco','francis.goya@email.com','goya','1'),(46,'Hardy','Olivier','hardy.olvier@email.com','olive','0'),(47,'Ionesco','Eugène','iones.eug@email.com','eug','0'),(48,'Ali','Mohamed','momoleboxeur@email.com','box','0'),(49,'Lavoisier','Antoine Laurent','antoinelavoisier@email.com','ant','0'),(50,'Mandela','Nelson','mand.nels@email.com','nels','0');
/*!40000 ALTER TABLE `Clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Film`
--

DROP TABLE IF EXISTS `Film`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Film` (
  `numero_film` int(3) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `duree` int(11) NOT NULL,
  `origine` varchar(30) NOT NULL,
  PRIMARY KEY (`numero_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Film`
--

LOCK TABLES `Film` WRITE;
/*!40000 ALTER TABLE `Film` DISABLE KEYS */;
INSERT INTO `Film` VALUES (1,'The Matrix','SF',120,'USA'),(2,'The Matrix reloaded','SF',120,'USA'),(3,'The Matrix revolution','SF',120,'USA'),(4,'The social network','Biographie',120,'USA'),(5,'V for Vendetta','Action',120,'USA'),(6,'Die hard','Action',120,'USA'),(7,'Toy Story','Animation',120,'USA'),(8,'Toy Story 2','Animation',120,'USA'),(9,'Toy Story 3','Animation',120,'USA'),(10,'Toy Story 4','Animation',120,'USA');
/*!40000 ALTER TABLE `Film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Note`
--

DROP TABLE IF EXISTS `Note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Note` (
  `numero_client` int(11) NOT NULL,
  `numero_film` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`numero_client`,`numero_film`),
  KEY `numero_film` (`numero_film`),
  CONSTRAINT `Note_ibfk_1` FOREIGN KEY (`numero_client`) REFERENCES `Clients` (`numero_client`),
  CONSTRAINT `Note_ibfk_2` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Note`
--

LOCK TABLES `Note` WRITE;
/*!40000 ALTER TABLE `Note` DISABLE KEYS */;
/*!40000 ALTER TABLE `Note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Participe_au_film`
--

DROP TABLE IF EXISTS `Participe_au_film`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Participe_au_film` (
  `numero_personne` int(11) NOT NULL,
  `numero_film` int(11) NOT NULL,
  PRIMARY KEY (`numero_personne`,`numero_film`),
  KEY `numero_film` (`numero_film`),
  CONSTRAINT `Participe_au_film_ibfk_1` FOREIGN KEY (`numero_personne`) REFERENCES `Personne` (`numero_personne`),
  CONSTRAINT `Participe_au_film_ibfk_2` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Participe_au_film`
--

LOCK TABLES `Participe_au_film` WRITE;
/*!40000 ALTER TABLE `Participe_au_film` DISABLE KEYS */;
INSERT INTO `Participe_au_film` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(1,2),(2,2),(3,2),(4,2),(5,2),(1,3),(2,3),(3,3),(4,3),(5,3),(6,4),(7,4),(8,4),(9,4),(10,4),(3,5),(4,5),(11,5),(12,5),(13,5),(14,5),(15,6),(16,6),(17,6),(18,6),(19,7),(20,7),(21,7),(22,7),(23,7);
/*!40000 ALTER TABLE `Participe_au_film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Personne`
--

DROP TABLE IF EXISTS `Personne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Personne` (
  `numero_personne` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `metier` varchar(30) NOT NULL,
  PRIMARY KEY (`numero_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Personne`
--

LOCK TABLES `Personne` WRITE;
/*!40000 ALTER TABLE `Personne` DISABLE KEYS */;
INSERT INTO `Personne` VALUES (1,'Reeves','Keanu',55,'Acteur'),(2,'Fishburne','Laurence',58,'Acteur'),(3,'Wachowski','Lilly',62,'Directrice'),(4,'Wachowski','Lana',60,'Directrice'),(5,'Moss','Carrie-Anne',62,'Actrice'),(6,'Fincher','David',57,'Directeur'),(7,'Sorkin','Aaron',58,'Ecrivain'),(8,'Eisenberg','Jesse',36,'Acteur'),(9,'Garfield','Andrew',36,'Acteur'),(10,'Timberlake','Justin',38,'Acteur'),(11,'McTeigue','James',52,'Directeur'),(12,'Weaving','Hugo',59,'Acteur'),(13,'Portman','Natalie',38,'Actrice'),(14,'Graves','Rupert',56,'Acteur'),(15,'Lasseter','John',62,'Directeur'),(16,'Docter','Pete',51,'Ecrivain'),(17,'Hanks','Tom',63,'Doubleur'),(18,'Allen','Tim',66,'Doubleur'),(19,'Rickles','Don',90,'Doubleur'),(20,'Docter','Pete',51,'Scenariste'),(21,'Hanks','Tom',63,'Doubleur'),(22,'Allen','Tim',66,'Doubleur'),(23,'Rickles','Don',90,'Doubleur');
/*!40000 ALTER TABLE `Personne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Salle`
--

DROP TABLE IF EXISTS `Salle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Salle` (
  `numero_salle` int(11) NOT NULL,
  `nom_du_cinema` varchar(30) NOT NULL,
  `nombre_de_place` int(3) NOT NULL,
  `ville` varchar(30) NOT NULL,
  PRIMARY KEY (`numero_salle`,`nom_du_cinema`),
  KEY `nom_du_cinema` (`nom_du_cinema`),
  CONSTRAINT `Salle_ibfk_1` FOREIGN KEY (`nom_du_cinema`) REFERENCES `Cinema` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Salle`
--

LOCK TABLES `Salle` WRITE;
/*!40000 ALTER TABLE `Salle` DISABLE KEYS */;
INSERT INTO `Salle` VALUES (1,'Ciné-Sel',60,'Sèvres'),(1,'Pathé Boulogne',60,'Boulogne'),(1,'UGC Vélizy',60,'Vélizy'),(1,'UGC Versailles',60,'Versailles'),(2,'Ciné-Sel',60,'Sèvres'),(2,'Pathé Boulogne',60,'Boulogne'),(2,'UGC Vélizy',60,'Vélizy'),(2,'UGC Versailles',30,'Versailles'),(3,'Ciné-Sel',30,'Sèvres'),(3,'Pathé Boulogne',40,'Boulogne'),(3,'UGC Vélizy',60,'Vélizy'),(4,'Pathé Boulogne',30,'Boulogne'),(4,'UGC Vélizy',30,'Vélizy');
/*!40000 ALTER TABLE `Salle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Se_joue_dans`
--

DROP TABLE IF EXISTS `Se_joue_dans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Se_joue_dans` (
  `DATE` int(11) NOT NULL,
  `heure` int(11) NOT NULL,
  `VERSION` varchar(30) NOT NULL,
  `numero_film` int(11) NOT NULL,
  `num_salle` int(11) NOT NULL,
  PRIMARY KEY (`numero_film`,`num_salle`,`DATE`,`heure`),
  KEY `num_salle` (`num_salle`),
  CONSTRAINT `Se_joue_dans_ibfk_1` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`),
  CONSTRAINT `Se_joue_dans_ibfk_2` FOREIGN KEY (`num_salle`) REFERENCES `Salle` (`numero_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Se_joue_dans`
--

LOCK TABLES `Se_joue_dans` WRITE;
/*!40000 ALTER TABLE `Se_joue_dans` DISABLE KEYS */;
/*!40000 ALTER TABLE `Se_joue_dans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Suit`
--

DROP TABLE IF EXISTS `Suit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Suit` (
  `numero_film_prec` int(11) NOT NULL,
  `numero_film_suiv` int(11) NOT NULL,
  PRIMARY KEY (`numero_film_prec`,`numero_film_suiv`),
  KEY `numero_film_suiv` (`numero_film_suiv`),
  CONSTRAINT `Suit_ibfk_1` FOREIGN KEY (`numero_film_prec`) REFERENCES `Film` (`numero_film`),
  CONSTRAINT `Suit_ibfk_2` FOREIGN KEY (`numero_film_suiv`) REFERENCES `Film` (`numero_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Suit`
--

LOCK TABLES `Suit` WRITE;
/*!40000 ALTER TABLE `Suit` DISABLE KEYS */;
INSERT INTO `Suit` VALUES (1,2),(2,3),(7,8),(8,9),(9,10);
/*!40000 ALTER TABLE `Suit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Veut_voir`
--

DROP TABLE IF EXISTS `Veut_voir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Veut_voir` (
  `numero_client` int(11) NOT NULL,
  `numero_film` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`numero_client`,`numero_film`),
  KEY `numero_film` (`numero_film`),
  CONSTRAINT `Veut_voir_ibfk_1` FOREIGN KEY (`numero_client`) REFERENCES `Clients` (`numero_client`),
  CONSTRAINT `Veut_voir_ibfk_2` FOREIGN KEY (`numero_film`) REFERENCES `Film` (`numero_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Veut_voir`
--

LOCK TABLES `Veut_voir` WRITE;
/*!40000 ALTER TABLE `Veut_voir` DISABLE KEYS */;
/*!40000 ALTER TABLE `Veut_voir` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-24 21:32:05
