--Filtrar por fecha o horario
select
	movies.name_movie,
    cinemas.name_cinema,
    shows.projection_time
from
	shows inner join movies on shows.id_movie = movies.id_movie
	inner join cinemas on shows.id_cinema = cinemas.id_cinema
where
	shows.projection_time like "%12:45:00%"; -- shows.projection_time like "%2019-11-23%" ejemplo por si quiero buscar por fecha y no hora
--filtrar por genero
select
	movies.name_movie,
    genres.name_genre
from
	movies_by_genres inner join movies on movies_by_genres.id_movie = movies.id_movie
    inner join genres on movies_by_genres.id_genre = genres.id_genre
where
	genres.name_genre = "Fantasia";    
--filtrar por ambas
select
    movies.name_movie,
	genres.name_genre,
	shows.projection_time
from
	shows inner join movies_by_genres on shows.id_movie = movies_by_genres.id_movie
    inner join movies on movies.id_movie = shows.id_movie
    inner join genres on genres.id_genre = movies_by_genres.id_genre
where
	genres.name_genre = "Fantasia" and shows.projection_time like "%12:45:00%";