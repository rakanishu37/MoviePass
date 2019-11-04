CREATE DATABASE moviepass_database;
USE moviepass_database;

CREATE TABLE cinemas(
    id_cinema int auto_increment,
    name_cinema varchar(50),
	address_cinema varchar(50),
	capacity int,
	ticket_price int,
	active boolean,
    constraint pk_id_cinema primary key (id_cinema),
    constraint unq_name_cinema unique (name_cinema),
    constraint unq_address_cinema unique (address_cinema),
    constraint chk_capacity check (capacity>0),
    constraint chk_ticket_price check (ticket_price>0)
);

CREATE TABLE genres(
    id_genre int,
    name_genre varchar (20),
    constraint pk_id_genre primary key (id_genre),
    constraint unq_name_genre unique (name_genre)
);

CREATE TABLE movies(
    id_movie int,
    name_movie varchar(100),
    runtime int,
    language_movie varchar(3),
    image_url varchar(50),
    constraint pk_id_movie primary key (id_movie),
    constraint unq_name_movie unique (name_movie),
    constraint chk_runtime check (runtime>0)
);

CREATE TABLE movies_by_genres(
    id_genre int,
    id_movie int,
    constraint pk_id_genre primary key (id_genre,id_movie),
    constraint fk_id_genre_genres foreign key (id_genre) references genres (id_genre),
    constraint fk_id_movie_movies foreign key (id_movie) references movies (id_movie)
);

CREATE TABLE shows(
    id_show int auto_increment,
    projection_time datetime,
    id_movie int,
    id_cinema int,
    constraint pk_id_show primary key (id_show),
    constraint fk_id_cinema_cinemas foreign key (id_cinema) references cinemas (id_cinema),
    constraint fk_id_movie_shows_movies foreign key (id_movie) references movies (id_movie)
);

INSERT INTO cinemas (name_cinema,address_cinema,capacity,ticket_price,active) VALUES 
('Cinemacenter','Diagonal Pueyrredon 3050',300,100,true),
('Cine Ambassador','Diagonal Centro 1673',1000,150,true),
('Cien Paseo Aldrey','Sarmiento 2685',200,100,true);

select * from cinemas;

INSERT INTO genres (id_genre, name_genre) VALUES
(1,'Acción'),
(2,'Horror'),
(3,'Comedia'),
(4,'Ciencia Ficción'),
(5,'Fantasia'),
(6,'Thriller');

select * from genres;

INSERT INTO movies (id_movie, name_movie, runtime, language_movie, image_url) VALUES
(1, 'Star Wars: La Amenaza Fantasma', 60, 'EN', 'google.com'),
(2, 'Star Wars: El Ataque de los Clones', 60, 'EN', 'google.com'),
(3, 'Star Wars: La Venganza de los Sith', 60, 'EN', 'google.com'),
(4, 'Star Wars: Una Nueva Esperanza', 60, 'EN', 'google.com'),
(5, 'Star Wars: El Imperio Contrataca', 60, 'EN', 'google.com'),
(6, 'Star Wars: El Retorno del Jedi', 60, 'EN', 'google.com');

select * from movies;

INSERT INTO movies_by_genres(id_genre,id_movie) VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(1,6),
(5,1),
(3,2),
(4,3),
(5,4),
(2,5),
(6,6);

select * from movies_by_genres;

INSERT INTO shows(projection_time, id_movie, id_cinema) VALUES
('2019-11-22 17:30:00',1,1),
('2019-11-22 17:30:00',2,2),
('2019-11-22 17:30:00',3,3),
('2019-11-23 12:45:00',4,1),
('2019-11-23 12:45:00',5,2),
('2019-11-23 12:45:00',6,3);

select * from shows;

select
	movies.name_movie,
    cinemas.name_cinema,
    shows.projection_time
from
	shows inner join movies on shows.id_movie = movies.id_movie
	inner join cinemas on shows.id_cinema = cinemas.id_cinema
/*group by
	shows.projection_time; #por alguna razon no funca ¯\_(ツ)_/¯
*/

select
	movies.name_movie,
    genres.name_genre
from
	movies_by_genres left outer join movies on movies_by_genres.id_movie = movies.id_movie
    inner join genres on movies_by_genres.id_genre = genres.id_genre;