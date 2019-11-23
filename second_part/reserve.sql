CREATE TABLE Clients(
	numero_client INT(4),
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(30) NOT NULL,
    type_de_reduction bool NOT NULL,
    PRIMARY KEY(numero_client)
);
CREATE TABLE Film(
    numero_film INT(3),
    nom VARCHAR(30) NOT NULL,
    genre VARCHAR(30) NOT NULL,
    duree INT NOT NULL,
    origine VARCHAR(30) NOT NULL,
    PRIMARY KEY(numero_film)
);
CREATE TABLE Cinema(
    nom VARCHAR(30),
    companie VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY(nom)
);
CREATE TABLE Salle(
    numero_salle INT,
    nom_du_cinema VARCHAR(30),
    nombre_de_place INT(3) NOT NULL,
    ville VARCHAR(30) NOT NULL,
    PRIMARY KEY(numero_salle, nom_du_cinema)
    foreign key (nom_du_cinema) references Cinema(nom)
);
CREATE TABLE Veut_voir(
    numero_client INT,
    numero_film INT,
    prix INT NOT NULL,
    primary key (numero_client, numero_film),
    FOREIGN KEY(numero_client) REFERENCES Clients(numero_client),
    FOREIGN KEY(numero_film) REFERENCES Film(numero_film)
);
CREATE TABLE Note(
    numero_client INT,
    numero_film INT,
    note INT NOT NULL,
    primary key (numero_client, numero_film),
    FOREIGN KEY(numero_client) REFERENCES Clients(numero_client),
    FOREIGN KEY(numero_film) REFERENCES Film(numero_film)
);
CREATE TABLE Suit(
    numero_film_prec INT,
    numero_film_suivant INT,
    primary key (numero_film_prec, numero_film_suiv),
    FOREIGN KEY(numero_film_prec) REFERENCES Film(numero_film),
    FOREIGN KEY(numero_film_suiv) REFERENCES Film(numero_film)
);
CREATE TABLE Se_joue_dans(
    date INT,
    heure INT,
    version VARCHAR(30) NOT NULL,
    numero_film INT,
    num_salle INT,
    primary key (numero_film, num_salle, date, heure),
    FOREIGN KEY(numero_film) REFERENCES Film(numero_film),
    FOREIGN KEY(num_salle) REFERENCES Salle(numero_salle)
);
CREATE TABLE Personne(
    numero_personne INT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    pseudo VARCHAR(30) NOT NULL,
    age INT NOT NULL,
    role VARCHAR(30) NOT NULL,
    PRIMARY KEY(numero_personne)
);
CREATE TABLE Participe_au_film(
    numero_personne INT,
    numero_film INT,
    primary key (numero_personne, numero_film),
    FOREIGN KEY(numero_personne) REFERENCES Personne(numero_personne),
    FOREIGN KEY(numero_film) REFERENCES Film(numero_film)
);

/* Vue */
create view film_francais
from film f, se_joue_dans j
where f.numero_film = j.numero_film
and j.version like "vf";

create view film_vo
from film f, se_joue_dans j
where f.numero_film = j.numero_film
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

/* Cinema */
insert into Cinema values ("Pathé Boulogne", "Pathé Gaumont");
insert into Cinema values ("Ciné-Sel", "Sel");
insert into Cinema values ("UGC Versailles", "UGC");
insert into Cinema values ("UGC Vélizy", "UGC");

/* Salle */
insert into Cinema values (1, "Pathé Boulogne", 90, "Boulogne");
insert into Cinema values (2, "Pathé Boulogne", 90, "Boulogne");
insert into Cinema values (3, "Pathé Boulogne", 90, "Boulogne");
insert into Cinema values (1, "Ciné-Sel", 60, "Sèvre");
insert into Cinema values (2, "Ciné-Sel", 60, "Sèvre");
insert into Cinema values (3, "Ciné-Sel", 60, "Sèvre");
insert into Cinema values (1, "UGC Versailles", 120, "Versailles");
insert into Cinema values (2, "UGC Versailles", 90, "Versailles");
insert into Cinema values (1, "UGC Vélizy", 120, "Vélizy");
insert into Cinema values (2, "UGC Vélizy", 120, "Vélizy");
insert into Cinema values (3, "UGC Vélizy", 120, "Vélizy");
insert into Cinema values (4, "UGC Vélizy", 90, "Vélizy");

/* Film */
insert into Film values (1, "Matrix", "SF", 120, "USA");
insert into Film values (2, "Matrix 2", "SF", 120, "USA");
insert into Film values (3, "Matrix 3", "SF", 120, "USA");
insert into Film values (4, "The social network", "Biographie", 120, "USA");
insert into Film values (5, "V for Vendetta", "Action", 120, "USA");
