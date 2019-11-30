/* Database */
create database Projet;
use Projet;

create user 'Admin'@'localhost' identified by 'admin';
create user 'Anonyme'@'localhost' identified by 'anonyme';
create user 'Client'@'localhost' identified by 'client';

grant all on Projet.* to 'Admin'@'localhost';

/* pour pouvoir compter les notes et les bénéfices */
grant select on Projet.* to 'Anonyme'@'localhost';

grant select on client_avec_reduction to 'Client'@'localhost';
grant select on personne_majeur to 'Client'@'localhost';
grant select on film_vo to 'Client'@'localhost';
grant select on film_vf to 'Client'@'localhost';
grant select on Film to 'Client'@'localhost';
grant select on Personne to 'Client'@'localhost';
grant select on Participe_au_film to 'Client'@'localhost';
grant select on Cinema to 'Client'@'localhost';
grant select on Se_joue_dans to 'Client'@'localhost';
grant select on Salle to 'Client'@'localhost';
grant select on Suit to 'Client'@'localhost';
grant all on Clients to 'Client'@'localhost';
grant all on Veut_voir to 'Client'@'localhost';
grant all on Note to 'Client'@'localhost';
