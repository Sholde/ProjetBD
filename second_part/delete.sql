/* Supprime un client */
delete from Clients
where prenom like "Brad"

/* Supprime un client */
delete from Clients
where email like "mark.zuckerberg@email.com"

/* annule la diffusion des film d''un directeur qui est David Fincher dans les cinema de Boulogne */
delete from Se_joue_dans
inner join Salle
	Se_joue_dans.num_salle = Salle.num_salle
inner join Film
	Film.num_film = Se_joue_dans.num_film
inner Join Participe_au_film
	Participe_au_film.num_film = Film.num_film
inner join Peronne
	Personne.num_personne = Participe_au_film.num_personne
where Salle.ville like "%Boulogne%"
and Personne.nom like "Fincher"
and Personne.prenom like "David"
and Personne.metier like "%Directeur%"
