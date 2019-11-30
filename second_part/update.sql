/* Bob change sa note sur le film The Matrix */
update Note
set note = 5
where num_client = 1
and num_film = 1;

/* un admin change la salle du film The Matrix dans la salle 4 au cinéma Pathé Boulogne*/
update Se_joue_dans
set num_salle = 4
where num_film = 1
and nom_du_cinema = "Pathé Boulogne"

/* Retire la réduction du client num 16 */
update Clients
set reduction = 0
where num_client = 16

/* Met a jour le prix du billet suivant si il a une reduc ou non, car on a insérer a la main et c'était trop long de vérifié le prix */
update Veut_voir
inner join Clients
on Clients.num_client = Veut_voir.num_client
set Veut_voir.prix = 6
where Clients.reduction = 0

update Veut_voir
inner join Clients
on Clients.num_client = Veut_voir.num_client
set Veut_voir.prix = 5
where Clients.reduction = 1
