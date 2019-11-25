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
