CREATE TABLE IF NOT EXISTS  `users`
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_verified INT(1) NOT NULL DEFAULT 0
);
/*todo
  fk_user mettre fk link
  */
CREATE TABLE IF NOT EXISTS  `posts`
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    created_date DATETIME NOT NULL,
    updated_date DATETIME,
    fk_user_create INT NOT NULL,
    fk_user_update INT,
    title VARCHAR(255) NOT NULL,
    header TEXT NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS  `comments`
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    created_date DATETIME NOT NULL,
    fk_user_create INT NOT NULL,
    verified TINYINT NOT NULL DEFAULT 0,
    content TEXT NOT NULL
);