
  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `descripción` text NOT NULL,
  `telefono` varchar(300) NOT NULL,
  `dirección` text NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name_tag` varchar(300) NOT NULL,
  `description_tag` text NOT NULL,
  `cover_tag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `sheets` (
  `id_sheets` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name_sheets` varchar(300) NOT NULL,
  `description_sheets` text NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `image_sheets` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `relations` (
  `id_relations` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_tag` int NOT NULL,
  `id_sheets` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` 
  (`id_user`, `nombre`, `email`, `password`, `descripción`, `telefono`, `dirección`, `imagen`) 
VALUES
  (1, 'andres', 'andres@gmail.com', 'andresc', 'Entusiasta', '978654321', 'La Molina', 'img'),
  (2, 'julio', 'julio@gmail.com', 'julioc', 'Entusiasta', '978654321', 'Barranco', 'img');





  