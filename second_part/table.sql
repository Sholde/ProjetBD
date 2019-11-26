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
	num_veut_voir INT,
	num_se_joue INT,
    num_client INT NOT NULL,
    num_film INT NOT NULL,
    prix INT NOT NULL,
    PRIMARY KEY(num_veut_voir, num_se_joue),
    FOREIGN KEY(num_se_joue) REFERENCES Se_joue_dans(num_se_joue) ON DELETE CASCADE ON UPDATE CASCADE,
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
	num_se_joue INT,
	jour date,
    heure time,
    version VARCHAR(30) NOT NULL,
    num_film INT,
    num_salle INT,
    nom_du_cinema VARCHAR(30),
    PRIMARY KEY(
		num_se_joue,
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
