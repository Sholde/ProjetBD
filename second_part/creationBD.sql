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
