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



select
	shows.id_show,
	shows.projection_time,
	shows.id_movie,
	shows.id_cinema
from
	shows inner join movies_by_genres on shows.id_movie = movies_by_genres.id_movie
    inner join genres on genres.id_genre = movies_by_genres.id_genre
where
	genres.id_genre = "numero";


--
/*ticketero */
DELIMITER //
create procedure countingSeats (in idshow int, out ticket int)
begin
	set ticket= (select 
                    case
						when tickets.ticket_number is null then 1
						when tickets.ticket_number>=theatres.capacity then -1
						else tickets.ticket_number+1
                    end as resultado
                from
					theatres inner join shows on theatres.id_theater = shows.id_theater
                    inner join tickets on tickets.id_show = shows.id_show
				where
                    shows.id_show = idshow);
END //

drop procedure countingSeats;

select *
from Cinemas;

insert into cinemas (name_cinema, address_cinema , active) values ("CinemaLauty", "lacasadelauty", true);

select *
from theatres;

insert into theatres (capacity, theater_name , id_cinema, seat_price) 
values 
(100, "LaSalaBonita", 1, 150),
(125, "LaSalaMeh", 1, 125),
(150, "LaSalaFea", 1, 100);

select *
from shows;

insert into shows(projection_time, id_movie, id_theater, active) 
values
("2019-11-26 12:30", 290859, 1, true),
("2019-11-26 12:30", 475557, 2, true),
("2019-11-26 12:30", 458897, 3, true);

select *
from movies;

select *
from tickets;

select *
from purchases;

insert into shows(quantity_of_tickets , total_amount, date_purchase, discount) 
values
(1,200,"2019-11-24", 0);

call countingSeats(1, @ticket)
select @ticket from countingSeats;


insert into tickets(ticket_number, id_purchase, id_show) values (@ticket, 1,1);


select
	shows.id_show,
    shows.projection_time,
    shows.id_movie,
    shows.id_theater,
    shows.active,
	ifnull(sum(theatres.capacity-count(tickets.ticket_number)),0)
from 
	shows inner join 


