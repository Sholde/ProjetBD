/* Table */
CREATE TABLE Clients(
    num_client INT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(30) NOT NULL,
    reduction boolean NOT NULL,
    PRIMARY KEY(num_client)
);
CREATE TABLE Film(
    num_film INT(3),
    nom VARCHAR(30) NOT NULL,
    genre VARCHAR(256) NOT NULL,
    duree INT NOT NULL,
    origine VARCHAR(30) NOT NULL,
    PRIMARY KEY(num_film)
);
CREATE TABLE Cinema(
    nom VARCHAR(30),
    companie VARCHAR(30) NOT NULL,
    PRIMARY KEY(nom)
);
CREATE TABLE Salle(
    num_salle INT,
    nom_du_cinema VARCHAR(30),
    nombre_de_place INT NOT NULL,
    ville VARCHAR(30) NOT NULL,
    PRIMARY KEY(num_salle, nom_du_cinema),
    FOREIGN KEY(nom_du_cinema) REFERENCES Cinema(nom) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Veut_voir(
	num_log INT,
    num_client INT NOT NULL,
    num_film INT NOT NULL,
    prix INT NOT NULL,
    PRIMARY KEY(num_log),
    FOREIGN KEY(num_client) REFERENCES Clients(num_client) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(num_film) REFERENCES Film(num_film) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Note(
    num_client INT,
    num_film INT,
    note INT NOT NULL,
    PRIMARY KEY(num_client, num_film),
    FOREIGN KEY(num_client) REFERENCES Clients(num_client) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(num_film) REFERENCES Film(num_film) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Suit(
    num_film_prec INT,
    num_film_suiv INT,
    PRIMARY KEY(
        num_film_prec,
        num_film_suiv
    ),
    FOREIGN KEY(num_film_prec) REFERENCES Film(num_film) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(num_film_suiv) REFERENCES Film(num_film) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Se_joue_dans(
	jour date,
    heure time,
    version VARCHAR(30) NOT NULL,
    num_film INT,
    num_salle INT,
    nom_du_cinema VARCHAR(30),
    PRIMARY KEY(
        num_film,
        num_salle,
        nom_du_cinema,
        jour,
        heure
    ),
    FOREIGN KEY(num_film) REFERENCES Film(num_film) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(num_salle, nom_du_cinema) REFERENCES Salle(num_salle, nom_du_cinema) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Personne(
    num_personne INT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    age INT NOT NULL,
    metier VARCHAR(256) NOT NULL,
    PRIMARY KEY(num_personne)
);
CREATE TABLE Participe_au_film(
    num_personne INT,
    num_film INT,
    PRIMARY KEY(num_personne, num_film),
    FOREIGN KEY(num_personne) REFERENCES Personne(num_personne) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(num_film) REFERENCES Film(num_film) ON DELETE CASCADE ON UPDATE CASCADE
);
create table Ticket (
	num_log INT,
	num_se_joue INT,
	num_client INT NOT NULL,
	num_salle INT NOT NULL,
	Primary key (num_log, num_se_joue),
	FOREIGN KEY(num_client) REFERENCES Clients(num_client) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(num_salle) REFERENCES Salle(num_salle) ON DELETE CASCADE ON UPDATE CASCADE
);

/* ##################################################################### */

/* Vue */
create view film_vf
from film f, se_joue_dans j
where f.num_film = j.num_film
and j.version like "vf";

create view film_vo
from film f, se_joue_dans j
where f.num_film = j.num_film
and j.version like "vo";

create view personne_majeur
from personne p
where p.age >= 18;

create view client_avec_reduction
from clients c
where c.reduction <> 0;

/* ##################################################################### */

/* Database */
create database Projet;
use Projet;

create user 'Client'@'localhost' identified by 'client';
create user 'Admin'@'localhost' identified by 'admin';
create user 'Anonyme'@'localhost' identified by 'anonyme';

grant all on Projet.* to 'Admin'@'localhost';

grant select on Projet.* to 'Anonyme'@'localhost';
revoke select on Projet.Clients from 'Anonyme'@'localhost';
revoke select on Projet.VeutVoir from 'Anonyme'@'localhost';
revoke select on Projet.Note from 'Anonyme'@'localhost';
revoke select on Projet.Ticket from 'Anonyme'@'localhost';

grant select on Projet.* to 'Client'@'localhost';
grant all on Projet.Clients to 'Client'@'localhost';
grant all on Projet.VeutVoir to 'Client'@'localhost';
grant all on Projet.Note to 'Client'@'localhost';


/* ##################################################################### */

/* Requête d'insertion */

/* Clients */
insert into Clients values (1, "Marley", "Bob", "bob.marley@email.com", "bob", 0);
insert into Clients values (2, "Queen", "Alice", "alice.queen@email.com", "alice", 1);
insert into Clients values (3, "Dubreuil", "Clément", "clement.dubreuil@email.com", "clement", 0);
insert into Clients values (4, "Abral", "Mohamed", "mohamed.abral@email.com", "mohamed", 1);
insert into Clients values (5, "Dupont", "Clément", "clement.dupont@email.com", "clement", 0);
insert into Clients values (6, "Zuckerberg", "Mark", "mark.zuckerberg@email.com", "mark", 1);
insert into Clients values (7, "Dupond", "Charles", "charles.dupond@email.com", "charles", 0);
insert into Clients values (8, "Daf", "Max", "max.daf@email.com", "max", 0);
insert into Clients values (9, "Lemond", "Max", "max.lemond@email.com", "max", 0);
insert into Clients values (10, "Valgrin", "Brad", "brad.valgrin@email.com", "brad", 0);
insert into Clients values (11, "Gates", "Bill", "bill.gates@email.com", "bill", 0);
insert into Clients values (12, "Linus", "Torvalds", "linus.torvalds@email.com", "linus", 0);
insert into Clients values (13, "Jobs", "Steve", "steve.jobs@email.com", "steve", 0);
insert into Clients values (14, "Alpher", "Ralph", "Ralph_Asher.Alpher@email.com", "Alpha", 0);
insert into Clients values (15, "Bethe", "Hans", "bethe.1547@email.com", "Beta", 0);
insert into Clients values (16, "Gamow", "George", "brad.valgrin@email.com", "Gamma", 1);
insert into Clients values (17, "Dicaprio", "Leonardo", "leo.caprio@email.com", "leonard", 0);
insert into Clients values (18, "Lemaître", "Georges", "georgelemaitre@email.com", "lemaitre", 0);
insert into Clients values (19, "Dieu", "dieu", "leternel@email.com", "dieu", 1);
insert into Clients values (20, "Van Damme", "jean-claude", "jean-claude@email.com", "vandamme", 1);
insert into Clients values (21, "Curie", "Marie", "marie8764@email.com", "curie", 1);
insert into Clients values (22, "Tournachon", "Gaspard-Félix", "Nadar@email.com", "nad", 0);
insert into Clients values (23, "Dumas", "Alexandre", "dumas_3mousqt@email.com", "alex", 0);
insert into Clients values (24, "Einstein", "Albert", "Einsteinlebg@email.com", "albert", 1);
insert into Clients values (25, "Clayton", "Harold", "Clay744@email.com", "clay", 0);
insert into Clients values (26, "Lawrence", "Ernest", "lawrence.ernest@email.com", "ernest", 0);
insert into Clients values (27, "Murphree", "Eger", "Eger.murphree@email.com", "murph", 0);
insert into Clients values (28, "Compton", "Arthur", "arture.compton@email.com", "art", 0);
insert into Clients values (29, "Bergerac", "Cyrano", "bergerac.cyr@email.com", "cyr", 1);
insert into Clients values (30, "Poquelin", "Jean-Baptiste", "moliere@email.com", "mol", 0);
insert into Clients values (31, "Kant", "Emmanuel", "Kant.Emma@email.com", "manu", 0);
insert into Clients values (32, "Sand", "George", "gege.sand@email.com", "sand", 0);
insert into Clients values (33, "Al-Kachi", "Ghiyath", "kachi@email.com", "kashi", 1);
insert into Clients values (34, "Jackson", "Michaël", "thriller@email.com", "mik", 0);
insert into Clients values (35, "Mendeleïev", "Dmitri", "tableau_periodique@email.com", "dmidmi", 0);
insert into Clients values (36, "Arendt", "Hannah", "Hanna984@email.com", "arendt", 0);
insert into Clients values (37, "Gandhi", "Mohandas Karamchand", "gandhi77816@email.com", "gandhi", 0);
insert into Clients values (38, "Sempé", "Jean-Jacques", "SempeJeanJacques@email.com", "semp", 0);
insert into Clients values (39, "Goscinny", "René", "reneGos@email.com", "gos", 0);
insert into Clients values (40, "Perusse", "Francois", "deuxminpeuple@email.com", "brad", 1);
insert into Clients values (41, "Ravel", "Maurice", "maumau@email.com", "ravel", 0);
insert into Clients values (42, "Remi", "George", "tintindu45@email.com", "tintin", 0);
insert into Clients values (43, "Spinoza", "Baruch", "baruch@email.com", "spin", 0);
insert into Clients values (44, "Franklin", "Benjamin", "benjidu74@email.com", "ben", 0);
insert into Clients values (45, "Goya", "Francisco", "francis.goya@email.com", "goya", 1);
insert into Clients values (46, "Hardy", "Olivier", "hardy.olvier@email.com", "olive", 0);
insert into Clients values (47, "Ionesco", "Eugène", "iones.eug@email.com", "eug", 0);
insert into Clients values (48, "Ali", "Mohamed", "momoleboxeur@email.com", "box", 0);
insert into Clients values (49, "Lavoisier", "Antoine Laurent", "antoinelavoisier@email.com", "ant", 0);
insert into Clients values (50, "Mandela", "Nelson", "mand.nels@email.com", "nels", 0);

/* Cinema */
insert into Cinema values ("Pathé Boulogne", "Pathé Gaumont");
insert into Cinema values ("Ciné-Sel", "Sel");
insert into Cinema values ("UGC Versailles", "UGC");
insert into Cinema values ("UGC Vélizy", "UGC");

/* Salle */
insert into Salle values (1, "Pathé Boulogne", 60, "Boulogne");
insert into Salle values (2, "Pathé Boulogne", 60, "Boulogne");
insert into Salle values (3, "Pathé Boulogne", 40, "Boulogne");
insert into Salle values (4, "Pathé Boulogne", 30, "Boulogne");
insert into Salle values (1, "Ciné-Sel", 60, "Sèvres");
insert into Salle values (2, "Ciné-Sel", 60, "Sèvres");
insert into Salle values (3, "Ciné-Sel", 30, "Sèvres");
insert into Salle values (1, "UGC Versailles", 60, "Versailles");
insert into Salle values (2, "UGC Versailles", 30, "Versailles");
insert into Salle values (1, "UGC Vélizy", 60, "Vélizy");
insert into Salle values (2, "UGC Vélizy", 60, "Vélizy");
insert into Salle values (3, "UGC Vélizy", 60, "Vélizy");
insert into Salle values (4, "UGC Vélizy", 30, "Vélizy");

/* Film */
insert into Film values (1, "The Matrix", "SF", 120, "USA");
insert into Film values (2, "The Matrix reloaded", "SF", 120, "USA");
insert into Film values (3, "The Matrix revolution", "SF", 120, "USA");
insert into Film values (4, "The social network", "Biographie", 120, "USA");
insert into Film values (5, "V for Vendetta", "Action", 120, "USA");
insert into Film values (6, "Die hard", "Action", 120, "USA");
insert into Film values (7, "Toy Story", "Animation", 120, "USA");
insert into Film values (8, "Toy Story 2", "Animation", 120, "USA");
insert into Film values (9, "Toy Story 3", "Animation", 120, "USA");
insert into Film values (10, "Toy Story 4", "Animation", 120, "USA");

/* Personne */
/* Matrix (vérifié age) */
insert into Personne values (1, "Reeves", "Keanu", 55, "Acteur");
insert into Personne values (2, "Fishburne", "Laurence", 58, "Acteur");
insert into Personne values (3, "Wachowski", "Lilly", 62, "Directrice");
insert into Personne values (4, "Wachowski", "Lana", 60, "Directrice");
insert into Personne values (5, "Moss", "Carrie-Anne", 62, "Actrice");

/* The social Network */
insert into Personne values (6, "Fincher", "David", 57, "Directeur");
insert into Personne values (7, "Sorkin", "Aaron", 58, "Scenariste");
insert into Personne values (8, "Eisenberg", "Jesse", 36, "Acteur");
insert into Personne values (9, "Garfield", "Andrew", 36, "Acteur");
insert into Personne values (10, "Timberlake", "Justin", 38, "Acteur");

/* V for Vendetta */
insert into Personne values (11, "McTeigue", "James", 52, "Directeur");
insert into Personne values (12, "Weaving", "Hugo", 59, "Acteur");
insert into Personne values (13, "Portman", "Natalie", 38, "Actrice");
insert into Personne values (14, "Graves", "Rupert", 56, "Acteur");

/* Die hard */
insert into Personne values (15, "McTierman", "John", 68, "Directeur");
insert into Personne values (16, "Willis", "Bruce", 62, "Acteur");
insert into Personne values (17, "Stuart", "James", 63, "Scenariste");
insert into Personne values (18, "Rickman", "Alan", 69, "Acteur");

/* Toy Story 1 */
insert into Personne values (19, "Lasseter", "John", 62, "Directeur");
insert into Personne values (20, "Docter", "Pete", 51, "Scenariste");
insert into Personne values (21, "Hanks", "Tom", 63, "Doubleur");
insert into Personne values (22, "Allen", "Tim", 66, "Doubleur");
insert into Personne values (23, "Rickles", "Don", 90, "Doubleur");

/* Suit */
insert into Suit values (1, 2);
insert into Suit values (2, 3);
insert into Suit values (7, 8);
insert into Suit values (8, 9);
insert into Suit values (9, 10);

/* Participe au film */
insert into Participe_au_film values (1, 1);
insert into Participe_au_film values (2, 1);
insert into Participe_au_film values (3, 1);
insert into Participe_au_film values (4, 1);
insert into Participe_au_film values (5, 1);

insert into Participe_au_film values (1, 2);
insert into Participe_au_film values (2, 2);
insert into Participe_au_film values (3, 2);
insert into Participe_au_film values (4, 2);
insert into Participe_au_film values (5, 2);

insert into Participe_au_film values (1, 3);
insert into Participe_au_film values (2, 3);
insert into Participe_au_film values (3, 3);
insert into Participe_au_film values (4, 3);
insert into Participe_au_film values (5, 3);

insert into Participe_au_film values (6, 4);
insert into Participe_au_film values (7, 4);
insert into Participe_au_film values (8, 4);
insert into Participe_au_film values (9, 4);
insert into Participe_au_film values (10, 4);

insert into Participe_au_film values (3, 5);
insert into Participe_au_film values (4, 5);
insert into Participe_au_film values (11, 5);
insert into Participe_au_film values (12, 5);
insert into Participe_au_film values (13, 5);
insert into Participe_au_film values (14, 5);

insert into Participe_au_film values (15, 6);
insert into Participe_au_film values (16, 6);
insert into Participe_au_film values (17, 6);
insert into Participe_au_film values (18, 6);

insert into Participe_au_film values (19, 7);
insert into Participe_au_film values (20, 7);
insert into Participe_au_film values (21, 7);
insert into Participe_au_film values (22, 7);
insert into Participe_au_film values (23, 7);

/* Se_joue_dans */ /* On va mettre les films la semaine du 16 vu qu on va présenté cette semaine la */
insert into Se_joue_dans values('2019-12-16', '10-00-00', "vf", 1, 1, "Pathé Boulogne");
insert into Se_joue_dans values('2019-12-16', '10-00-00', "vo", 6, 2, "Pathé Boulogne");
insert into Se_joue_dans values('2019-12-16', '15-00-00', "vf", 4, 1, "Pathé Boulogne");
insert into Se_joue_dans values('2019-12-16', '15-00-00', "vf", 5, 3, "Pathé Boulogne");


/* Veut_voir */ /* 6 euro sans reduc, 5 euro avec */
insert into Veut_voir values(1, 1, 1, 6);
insert into Veut_voir values(2, 1, 1, 6);
insert into Veut_voir values(3, 2, 1, 5);
insert into Veut_voir values(4, 50, 1, 6);

/* Note */
insert into Note values(21,4,4);
insert into Note values(18,5,5);
insert into Note values(10,7,4);
insert into Note values(4,5,1);
insert into Note values(50,1,5);
insert into Note values(41,3,4);
insert into Note values(20,4,3);
insert into Note values(45,4,2);
insert into Note values(21,1,3);
insert into Note values(22,5,4);
insert into Note values(6,3,5);
insert into Note values(12,2,2);
insert into Note values(34,1,3);
insert into Note values(1,1,3);

/* Ticket */ /* Quand un client achete une place il y a un uplet qui s'ajoute dans cette tavle aussi */


/* ##################################################################### */

/* Requète select */

/* Note Moyenne des film */
select f.nom, moy(n.note)
from Film f, Note n
where f.num_film = n.num_film
group by f.nom

/* nom, prenom des acteurs / actices jouant dans des film en vf */
select p.nom, p.prenom
from Personne p, film_vf vf, Participe_au_film pf
where p.num_personne = pf.num_personne
and vf.num_film = pf.num_film

/* nom des film ayant une suite et le nom du film */
select f_prec.nom, f_suiv.nom
from Film f_prec, Film f_suiv, Suit s
where f_prec.num_film = s.num_film_prec
and f_suiv.num_film = s.num_film_suiv

/* nom des film ayant une note sup moy */ /* Les notes sont entre 0 et 5  */
select f.nom
from Film f, Note n
where f.num_film = n.num_film
group by f.nom
having avg(n.note) >  CONVERT(2.5, decimal(1,1))

/* nom des cinema UGC */
select c.nom
from Cinema c
where c.companie like "UGC"

/* Recette pour chaque film */
select f.nom, sum(v.prix)
from Film f, Veut_voir v
where f.num_film = v.num_film
group by f.nom

/* nom des film de SF ayant 100 entré ou plus */
select f.nom, sum(v.num_client)
from Film f, Veut_voir v
where f.num_film = v.num_film
group by f.nom
having sum(v.num_client) > 100

/* ##################################################################### */

/* Requête update */

/* Bob change sa note sur le film The Matrix */
update Note
set note = 5
where num_client = 1
and num_film = 1;

/* un admin change la salle du film The Matrix dans la salle 4 au cinéma Pathé Boulogne*/
update Se_joue_dans
set num_salle = 4
where num_film = 1
and nom_du_cinema = "Pathé Boulogne"
