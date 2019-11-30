/* Vue */
/* Film diffuséen vf */
create view film_vf as (
select f.nom
from Film f, Se_joue_dans j
where f.num_film = j.num_film
and j.version like "vf"
group by f.nom);

/* Film diffuséen vo */
create view film_vo as (
select f.nom
from Film f, Se_joue_dans j
where f.num_film = j.num_film
and j.version like "vo"
group by f.nom);

create view personne_majeur as (
select *
from Personne p
where p.age >= 18);

create view client_avec_reduction as (
select *
from Clients c
where c.reduction <> 0);
