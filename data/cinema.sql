CREATE TABLE genre (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE movie (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    id_genre INT NOT NULL,
    FOREIGN KEY (id_genre) REFERENCES genre(id)
);

CREATE TABLE user (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    password VARCHAR(255) NOT NULL,
    bio VARCHAR(255)
);

CREATE TABLE history (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_movie INT NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_movie) REFERENCES movie(id),
    FOREIGN KEY (id_user) REFERENCES user(id)
);