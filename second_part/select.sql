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

/* nom des cinema Pathé */
select c.nom
from Cinema c
where c.compagnie like "Pathé%"

/* Recette pour chaque film */
select f.nom, sum(v.prix)
from Film f, Veut_voir v
where f.num_film = v.num_film
group by f.nom

/* nom des film de SF ayant 100 entré ou plus */
select f.nom, sum(v.num_client)
from Film f, Veut_voir v
where f.num_film = v.num_film
and f.genre like "Science-Fiction"
group by f.nom
having sum(v.num_client) > 100

/* nom des film diffusé par la compagnie Pathé */
select f.nom
from Film f, Se_joue_dans j, Salle s, Cinema ci
where f.num_film = j.num_film
and j.num_salle = f.num_salle
and s.nom_du_cinema = ci.nom
Group by f.nom

/* Ticket pour le client n */
select j.num_salle, j.jour, j.heure, v.prix
from Se_joue_dans j, Veut_voir v
where v.num_se_joue = j.num_se_joue
and j.num_client = n

/* nom des films de SF avec plus de 3 représentation dont au moins une est dans le cinema de boulogne */
SELECT
    table2.nom_du_film
FROM
    (
    SELECT
        func.nom AS nom_du_film
    FROM
        (
        SELECT
            f.nom AS nom
        FROM
            Film f,
            Se_joue_dans j
        WHERE
            f.num_film = j.num_film AND f.genre LIKE "%Science-Fiction%"
    ) AS func
GROUP BY
    nom_du_film
HAVING
    COUNT(nom_du_film) > 2
) AS table1,
(
SELECT
    f.nom AS nom_du_film
FROM
    Film f,
    Se_joue_dans j,
    Salle s,
    Cinema ci
WHERE
    f.num_film = j.num_film AND j.num_salle = s.num_salle AND s.nom_du_cinema = ci.nom AND ci.nom LIKE "%Boulogne%"
GROUP BY
    f.nom
) AS table2
WHERE
    table1.nom_du_film = table2.nom_du_film
    
/* nom, prenom et age des acteurs jouant dans des film d'action en vf */
Select p.nom, p.prenom, p.age
from Personne p, Film f, Se_joue_dans j
where f.num_film = j.num_film
and j.version = "vf"
and (p.metier like "%Acteur%" or p.metier like "%Actrice%")
group by p.nom, p.prenom

/* Ajout de requêtes de base pour l'administrateur */
SELECT * FROM Clients;
SELECT * FROM Film;
SELECT * FROM Cinema;
SELECT * FROM Salle;
SELECT * FROM Veut_voir;
SELECT * FROM Note;
SELECT * FROM Suit;
SELECT * FROM Se_joue_dans;
SELECT * FROM Personne;
SELECT * FROM Participe_au_film;
