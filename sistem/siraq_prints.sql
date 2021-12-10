
  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `descripción` text NOT NULL,
  `telefono` varchar(300) NOT NULL,
  `dirección` text NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tags` (
  `id_tag` int NOT NULL,
  `name_tag` varchar(300) NOT NULL,
  `description_tag` text NOT NULL,
  `cover_tag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `sheets` (
  `id_sheets` int NOT NULL,
  `name_sheets` varchar(300) NOT NULL,
  `description_sheets` text NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `image_sheets` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `relations` (
  `id_relations` int NOT NULL,
  `id_tag` int NOT NULL,
  `id_sheets` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indices de la tabla
--
ALTER TABLE `sheets`
  ADD PRIMARY KEY (`id_sheets`);

--
-- Indices de la tabla
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id_relations`);