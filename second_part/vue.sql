/* Vue */
create view film_vf
from film f, se_joue_dans j
where f.num_film = j.num_film
and j.version like "vf";

create view film_vo
from film f, se_joue_dans j
where f.num_film = j.num_film
and j.version like "vo";

create view personne_majeur
from personne p
where p.age >= 18;

create view client_avec_reduction
from clients c
where c.reduction <> 0;
