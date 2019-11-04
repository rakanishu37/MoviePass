/*#Filtrar por fecha o horario*/
select
	movies.name_movie,
    cinemas.name_cinema,
    shows.projection_time
from
	shows inner join movies on shows.id_movie = movies.id_movie
	inner join cinemas on shows.id_cinema = cinemas.id_cinema
where
	shows.projection_time like "%12:45:00%"; /*otro con la fecha es lo mismo solo que usamos el sistema de fecha*/
    
/*filtrar por genero*/
select
	movies.name_movie,
    genres.name_genre
from
	movies_by_genres inner join movies on movies_by_genres.id_movie = movies.id_movie
    inner join genres on movies_by_genres.id_genre = genres.id_genre
where
	genres.name_genre = "Fantasia";