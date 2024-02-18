CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE IF NOT EXISTS users (
    id INT(255) AUTO_INCREMENT NOT NULL,
    role VARCHAR(20),
    name VARCHAR(100),
    surname VARCHAR(200),
    nick VARCHAR(100),
    email VARCHAR(255),
    password VARCHAR(255),
    image VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    remember_token VARCHAR(255),

    CONSTRAINT pk_users PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS images (
    id INT(255) AUTO_INCREMENT NOT NULL,
    user_id INT(255),
    image_path VARCHAR(100),
    description TEXT,
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT pk_images PRIMARY KEY (id),
    CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users (id)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS comments (
    id INT(255) AUTO_INCREMENT NOT NULL,
    user_id INT(255),
    image_id INT(255),
    content TEXT,
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT pk_comments PRIMARY KEY (id),
    CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users (id),
    CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES images (id)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS likes (
    id INT(255) AUTO_INCREMENT NOT NULL,
    user_id INT(255),
    image_id INT(255),
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT pk_likes PRIMARY KEY (id),
    CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users (id),
    CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images (id)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS followers (
    id INT(255) AUTO_INCREMENT NOT NULL,
    user_id INT(255),
    followed_user_id INT(255),
    created_at DATETIME,
    updated_at DATETIME,

    CONSTRAINT pk_followers PRIMARY KEY (id),
    CONSTRAINT fk_followers_users FOREIGN KEY (user_id) REFERENCES users (id),
    CONSTRAINT fk_followers_followed_users FOREIGN KEY (followed_user_id) REFERENCES users (id),
    CONSTRAINT unique_user_follow UNIQUE (user_id, followed_user_id)
) ENGINE=InnoDB;



