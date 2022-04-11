DROP DATABASE IF EXISTS cinema;
CREATE DATABASE my_cinema;

USE my_cinema;

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE movie (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    id_genre INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_genre) REFERENCES genre(id)
);  

CREATE TABLE genre (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE history (
    id INT NOT NULL AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_movie INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_movie) REFERENCES movie(id)
);