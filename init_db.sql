CREATE TABLE IF NOT EXISTS  `users`
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_verified INT(1) NOT NULL DEFAULT 0
);