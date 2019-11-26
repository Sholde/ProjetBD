/* Database */
create database Projet;
use Projet;

create user 'Admin'@'localhost' identified by 'admin';
create user 'Anonyme'@'localhost' identified by 'anonyme';
create user 'Client'@'localhost' identified by 'client';

grant all on Projet.* to 'Admin'@'localhost';

grant select on Film to 'Anonyme'@'localhost';
grant select on Personne to 'Anonyme'@'localhost';
grant select on Participe_au_film to 'Anonyme'@'localhost';
grant select on Cinema to 'Anonyme'@'localhost';
grant select on Se_joue_dans to 'Anonyme'@'localhost';
grant select on Salle to 'Anonyme'@'localhost';
grant select on Suit to 'Anonyme'@'localhost';

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
