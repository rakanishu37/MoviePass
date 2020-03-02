CREATE DATABASE moviepass_database;
USE moviepass_database;

CREATE TABLE cinemas(
    id_cinema int auto_increment,
    name_cinema varchar(50),
	address_cinema varchar(50),
	active boolean,
    constraint pk_id_cinema primary key (id_cinema),
    constraint unq_name_cinema unique (name_cinema),
    constraint unq_address_cinema unique (address_cinema)
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

CREATE TABLE theatres(
    id_theater int auto_increment,
    capacity int,
    theater_name varchar(20),
    id_cinema int,
    seat_price float(2),
    constraint pk_id_theater primary key (id_theater),
    constraint fk_id_cinema_cinemas foreign key (id_cinema) references cinemas (id_cinema),
    constraint chk_capacity check (capacity>0),
    constraint chk_seat_price check (seat_price>0)
);

CREATE TABLE shows(
    id_show int auto_increment,
    projection_time datetime,
    id_movie int,
    id_theater int,
    active boolean,
    constraint pk_id_show primary key (id_show),
    constraint fk_id_theater_theatres foreign key (id_theater) references theatres (id_theater),
    constraint fk_id_movie_shows_movies foreign key (id_movie) references movies (id_movie)
);

CREATE TABLE users(
    id_user int auto_increment,
    administrador boolean,
    email varchar(50),
    password_user varchar (50),
    constraint pk_id_user primary key (id_user),
    -- constraint fk_id_role_roles foreign key (id_role) references roles (id_role),
    constraint unq_email unique (email)
);

CREATE TABLE purchases(
    id_purchase int auto_increment,
    id_user int,
    quantity_of_tickets int not null,
    total_amount int,
    date_purchase datetime,
    discount int,
    constraint pk_id_purchase primary key (id_purchase),
    constraint fk_id_user_users foreign key (id_user) references users (id_user),
);

CREATE TABLE tickets(
    id_ticket int auto_increment,
    ticket_number int, 
    id_purchase int,
    id_show int,
    constraint pk_id_ticket primary key (id_ticket),
    constraint fk_id_purchase_purchases foreign key (id_purchase) references purchases (id_purchase),
    constraint fk_id_show_shows foreign key (id_show) references shows (id_show)
);

/*
CREATE TABLE roles(
    id_role int auto_increment,
    name_role varchar(30),
    constraint pk_id_role primary key (id_role)
    /*constraint unq_name_role un
);*/
