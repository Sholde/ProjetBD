/* Supprime un client */
delete from Clients
where prenom like "Brad"

/* Supprime un client */
delete from Clients
where email like "mark.zuckerberg@email.com"

/* annule la diffusion d'un film d' un le réalisateur est David Fincher dans les cinema de Boulogne */
delete from Se_joue_dans
inner join Salle
	Se_joue_dans.num_salle = Salle.num_salle
where Salle.ville like "%Boulogne%"
