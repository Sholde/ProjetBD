/* Table */
CREATE TABLE Clients(
    num_client INT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(30) NOT NULL,
    type_de_reduction VARCHAR(30) NOT NULL,
    PRIMARY KEY(num_client)
);
CREATE TABLE Film(
    num_film INT(3),
    nom VARCHAR(30) NOT NULL,
    genre VARCHAR(30) NOT NULL,
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
    nombre_de_place INT(3) NOT NULL,
    ville VARCHAR(30) NOT NULL,
    PRIMARY KEY(num_salle, nom_du_cinema),
    FOREIGN KEY(nom_du_cinema) REFERENCES Cinema(nom)
);
CREATE TABLE Veut_voir(
    num_client INT,
    num_film INT,
    prix INT NOT NULL,
    PRIMARY KEY(num_client, num_film),
    FOREIGN KEY(num_client) REFERENCES Clients(num_client),
    FOREIGN KEY(num_film) REFERENCES Film(num_film)
);
CREATE TABLE Note(
    num_client INT,
    numero_film INT,
    note INT NOT NULL,
    PRIMARY KEY(num_client, num_film),
    FOREIGN KEY(num_client) REFERENCES Clients(num_client),
    FOREIGN KEY(num_film) REFERENCES Film(num_film)
);
CREATE TABLE Suit(
    num_film_prec INT,
    num_film_suiv INT,
    PRIMARY KEY(
        num_film_prec,
        num_film_suiv
    ),
    FOREIGN KEY(num_film_prec) REFERENCES Film(num_film),
    FOREIGN KEY(num_film_suiv) REFERENCES Film(num_film)
);
CREATE TABLE Se_joue_dans(
    jour INT,
    heure INT,
    version VARCHAR(30) NOT NULL,
    num_film INT,
    num_salle INT,
    PRIMARY KEY(
        num_film,
        num_salle,
        jour,
        heure
    ),
    FOREIGN KEY(num_film) REFERENCES Film(num_film),
    FOREIGN KEY(num_salle) REFERENCES Salle(num_salle)
);
CREATE TABLE Personne(
    num_personne INT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    age INT NOT NULL,
    metier VARCHAR(30) NOT NULL,
    PRIMARY KEY(num_personne)
);
CREATE TABLE Participe_au_film(
    num_personne INT,
    num_film INT,
    PRIMARY KEY(num_personne, num_film),
    FOREIGN KEY(num_personne) REFERENCES Personne(num_personne),
    FOREIGN KEY(num_film) REFERENCES Film(num_film)
);

/* Vue */
create view film_francais
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
where c.type_de_reduction <> "none";

/* Database */
create database Projet;

create user 'Client'@'localhost' identified by 'client';
create user 'Admin'@'localhost' identified by 'admin';
create user 'Anonyme'@'localhost' identified by 'anonyme';

grant all on Projet.* to 'Admin'@'localhost';

grant select on Projet.* to 'Anonyme'@'localhost';
revoke select from Projet.Clients from 'Anonyme'@'localhost';
revoke select from Projet.VeutVoir from 'Anonyme'@'localhost';
revoke select from Projet.Note from 'Anonyme'@'localhost';

grant select on Projet.* to 'Client'@'localhost';
grant all from Projet.Clients from 'Client'@'localhost';
grant all from Projet.VeutVoir from 'Client'@'localhost';
grant all from Projet.Note from 'Client'@'localhost';

/* Requête d'insertion */

/* Clients */
insert into Clients values (1, "Marley", "Bob", "bob.marley@email.com", "bob", "none");
insert into Clients values (2, "Queen", "Alice", "alice.queen@email.com", "alice", "have");
insert into Clients values (3, "Dubreuil", "Clément", "clement.dubreuil@email.com", "clement", "none");
insert into Clients values (4, "Abral", "Mohamed", "mohamed.abral@email.com", "mohamed", "have");
insert into Clients values (5, "Dupont", "Clément", "clement.dupont@email.com", "clement", "none");
insert into Clients values (6, "Zuckerberg", "Mark", "mark.zuckerberg@email.com", "mark", "have");
insert into Clients values (7, "Dupond", "Charles", "charles.dupond@email.com", "charles", "none");
insert into Clients values (8, "Daf", "Max", "max.daf@email.com", "max", "none");
insert into Clients values (9, "Lemond", "Max", "max.lemond@email.com", "max", "none");
insert into Clients values (10, "Valgrin", "Brad", "brad.valgrin@email.com", "brad", "none");

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
insert into Personne values (7, "Sorkin", "Aaron", 58, "Ecrivain");
insert into Personne values (8, "Eisenberg", "Jesse", 36, "Acteur");
insert into Personne values (9, "Garfield", "Andrew", 36, "Acteur");
insert into Personne values (10, "Timberlake", "Justin", 38, "Acteur");

/* V for Vendetta */
insert into Personne values (11, "McTeigue", "James", 52, "Directeur");
insert into Personne values (12, "Weaving", "Hugo", 59, "Acteur");
insert into Personne values (13, "Portman", "Natalie", 38, "Actrice");
insert into Personne values (14, "Graves", "Rupert", 56, "Acteur");

/* Toy Story 1 */
insert into Personne values (15, "Lasseter", "John", 62, "Directeur");
insert into Personne values (16, "Docter", "Pete", 51, "Ecrivain");
insert into Personne values (17, "Hanks", "Tom", 63, "Doubleur");
insert into Personne values (18, "Allen", "Tim", 66, "Doubleur");
insert into Personne values (19, "Rickles", "Don", 90, "Doubleur");
