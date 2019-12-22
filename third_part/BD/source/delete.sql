/* Supprime un client */
delete from Clients
where prenom like "Brad"

/* Supprime un client */
delete from Clients
where email like "mark.zuckerberg@email.com"

/* annule la diffusion des film d'un directeur qui est David Fincher dans les cinema de Boulogne */
delete from Se_joue_dans
where Se_joue_dans.num_se_joue in (
select num_se_joue
from Salle s, Participe_au_film pa, Personne p
where p.num_personne = pa.num_personne
and pa.num_film = Se_joue_dans.num_film
and Se_joue_dans.num_salle = s.num_salle
and s.ville like "%Boulogne%"
and p.nom like "Fincher"
and p.prenom like "David"
and pa.metier like "%Directeur%"
)
