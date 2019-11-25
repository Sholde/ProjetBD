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
