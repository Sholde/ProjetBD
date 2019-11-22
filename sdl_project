CREATE TABLE Clients(
	numero_client INT(4),
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(30) NOT NULL,
    type_de_reduction VARCHAR(30) NOT NULL,
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
CREATE TABLE Se_trouve(
    ville VARCHAR(30) NOT NULL,
    numero_salle INT,
    nom_cinema VARCHAR(30),
    primary key (numero_salle, nom_cinema),
    FOREIGN KEY(numero_salle) REFERENCES Salle(numero_salle),
    FOREIGN KEY(nom_cinema) REFERENCES Cinema(nom)
);

// Vue
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
where c.type_reduction <> "none";

// database
create database Projet;

create user 'Bob'@'localhost' 
