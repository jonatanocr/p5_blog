CREATE DATABASE `blog_jonatan` CHARACTER SET 'utf8';

CREATE TABLE IF NOT EXISTS  `users`
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_type VARCHAR(20) NOT NULL DEFAULT 'visitor'
);

CREATE TABLE IF NOT EXISTS  `posts`
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    created_date DATETIME NOT NULL,
    updated_date DATETIME,
    fk_author INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    header TEXT NOT NULL,
    content TEXT NOT NULL,
    FOREIGN KEY(fk_author)
    REFERENCES users(id)
    ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS  `comments`
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    created_date DATETIME NOT NULL,
    fk_author INT NOT NULL,
    fk_post INT NOT NULL,
    verified TINYINT NOT NULL DEFAULT 0,
    content TEXT NOT NULL,
    FOREIGN KEY(fk_author)
    REFERENCES users(id)
    ON DELETE CASCADE,
    FOREIGN KEY(fk_post)
    REFERENCES posts(id)
    ON DELETE CASCADE
);
