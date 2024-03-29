
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name_user` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `phone` varchar(300) NOT NULL,
  `direction` text NOT NULL,
  `image` text NOT NULL
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
  `product_size` text NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `image_sheets` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `relations_tags_sheets` (
  `id_relations` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_tag` int NOT NULL,
  `id_sheets` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `stamping_materials` (
  `id_stamping_materials` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name_of_material` text NOT NULL,
  `description_material` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `material_images` (
  `id_material_images` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_stamping_materials` int NOT NULL,/* Llave de stamping_materials */
  `id_resources_images` text NOT NULL,/* Llave de resources_images */
  `description_material`text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `resources_images` (
  `id_resources_images` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `image_name` text NOT NULL, 
  `linck_image` text NOT NULL, 
  `description_image` text NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `quantity_pricing_table` (
  `id_quantity_pricing_table` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_stamping_materials` int NOT NULL,/* Llave de stamping_materials */
  `1-11` int NOT NULL,
  `12-24` int NOT NULL,
  `25-49` int NOT NULL,
  `50-99` int NOT NULL,
  `100-+` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




INSERT INTO `users` 
  (`id_user`, `name_user`, `email`, `password`, `description`, `phone`, `direction`, `image`) 
VALUES
  (1, 'andres', 'andres@gmail.com', 'andresc', 'Entusiasta', '978654321', 'La Molina', 'img'),
  (2, 'julio', 'julio@gmail.com', 'julioc', 'Entusiasta', '978654321', 'Barranco', 'img');




INSERT INTO `tags` 
  (`id_tag`, `name_tag`, `description_tag`, `cover_tag`)
VALUES
  (1, 'Navideños', 'Todo sobre navidades', 'Link de imagen del tag.'),
  (2, 'Parejas', 'Sobre todo viniles para poleras', 'Link de imagen del tag.'),
  (3, 'Cumpleaños', 'Para niños', 'Link de imagen del tag.');




INSERT INTO `sheets` 
  (`id_sheets`, `name_sheets`, `description_sheets`, `product_size`, `price`, `amount`, `image_sheets`)
VALUES
  (1, 'Mikey mouse', 'Muñeco de disney', `product_size`, '2', '200', 'Link de Mikey mouse'),
  (2, 'Cobra Kai', 'Arbol insignia', `product_size`, '3', '30', 'Link de Cobra Kai'),
  (3, 'Grut', 'De marvel', '5', `product_size`, '50', 'Link de Grut');


