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

INSERT INTO users (role, name, surname, nick, email, password, image, created_at, updated_at, remember_token) VALUES
('admin', 'Juan', 'Perez', 'juanp', 'juan@example.com', 'pass123', 'img1.jpg', NOW(), NOW(), null),
('user', 'Ana', 'Garcia', 'anag', 'ana@example.com', 'pass123', 'img2.jpg', NOW(), NOW(), null),
('user', 'Luis', 'Martinez', 'luism', 'luis@example.com', 'pass123', 'img3.jpg', NOW(), NOW(), null);


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

INSERT INTO images (user_id, image_path, description, created_at, updated_at) VALUES
(1, 'path1.jpg', 'Descripción de la imagen 1', NOW(), NOW()),
(2, 'path2.jpg', 'Descripción de la imagen 2', NOW(), NOW()),
(3, 'path3.jpg', 'Descripción de la imagen 3', NOW(), NOW());


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

INSERT INTO comments (user_id, image_id, content, created_at, updated_at) VALUES
(1, 1, 'Comentario de Juan en imagen 1', NOW(), NOW()),
(2, 1, 'Comentario de Ana en imagen 1', NOW(), NOW()),
(3, 2, 'Comentario de Luis en imagen 2', NOW(), NOW());


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

INSERT INTO likes (user_id, image_id, created_at, updated_at) VALUES
(1, 2, NOW(), NOW()),
(2, 3, NOW(), NOW()),
(3, 1, NOW(), NOW()),
(3, 2, NOW(), NOW()),
(1, 2, NOW(), NOW());


