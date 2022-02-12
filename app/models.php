<?php
    /* 
    $products = $connectionDb->prepare("SELECT * FROM products WHERE id_user = ? AND id_products = ? AND enable_disable = '1' ");
    $products->execute(array($id_user, $id_products));
    $assocQuery = assocQuery($products); */
    
    /* $id_products = self::increaseIdValue($connectionDb, 'id_products', 'products', 'id', $id_user);
    $sqlProducts = $connectionDb->prepare("INSERT INTO `products` (`id_products`, `id_user`, `id_mazo`, `nombre_products`, `description_products`) VALUES (?, ?, ?, ?, ?)");
    $sqlProducts->execute(array($id_products, $id_user, $id_mazo, $nombre_products, $description_products,)); */

$user_siraq     = function($method, $connection, array $petition)
{
    $methodsToReturn = [
        'users_login'  => function() use ($connection, $petition)
            {
                def($consultation ,"SELECT * FROM `users` WHERE `email` = '".$petition['email']."' AND `password` = '".$petition['password']."' ");
                return assocQuery($connection->query($consultation));

                //$sqlProducts = $connection->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ? ");

                /* return 
                    $sqlProducts->execute
                        (
                            array($petition['email'], $petition['password'],)
                        )
                ; */
            },
        'name_of_course_inscriptions'   => function() use ($connection, $petition)
            {
                $sqlProducts = $connection->query("SELECT * FROM `courses`");
                return assocQuery($sqlProducts);

            },
    ];
    return $methodsToReturn[$method];
};

$tags_siraq     = function($method, $connection, array $petition)
{
    $methodsToReturn = [
        'tags_of_products' => function() use ($connection, $petition)
            {
                def($consultation ,"SELECT * FROM `tags`");
                return assocQuery($connection->query($consultation));
            }
    ];
    return $methodsToReturn[$method];
};

$products_siraq     = function($method, $connection, array $petition)
{
    $methodsToReturn = [
        'add_product_model' => function() use ($connection, $petition)
            {
                def($consultation ,"INSERT INTO `sheets` 
                (`name_sheets`, `description_sheets`, `product_size`, `price`, `amount`, `image_sheets`)
                VALUES
                ('".$petition['name_of_product']."', '".$petition['description_product']."', '".$petition['product_size']."', '".$petition['product_price_in_soles']."', '".$petition['product_quantity']."', '".$petition['upload_file']."');");
                return $connection->query($consultation);
            }
    ];
    
    return $methodsToReturn[$method];
};

$stamping_materials = function($method, $connection, array $petition)
{
    $methodsToReturn = [
        'add_stamping_model' => function() use ($connection, $petition)
            {
                def($consultation_stamping_materials ,
                    $connection->query(
                        "INSERT INTO `stamping_materials` 
                        (`name_of_material`, `description_material`)
                        VALUES
                        ('".$petition['name_of_material']."', '".$petition['description_material']."');"
                    )
                );

                def($id_stamping_materials, 
                    (
                        assocQuery(
                            $connection->query(
                                'SELECT * FROM `stamping_materials` ORDER BY `id_stamping_materials` DESC LIMIT 1'
                            )
                        )
                    )['id_stamping_materials'] 
                );
                var_dump($id_stamping_materials);

                return $id_stamping_materials;
            },
        'add_stamping_images_model' => function() use ($connection, $petition)
            {

                def($consultation_resources_images, 
                    $connection->query(
                        "INSERT INTO `resources_images` 
                        (`image_name`, `linck_image`)
                        VALUES
                        ('".$petition['image_name']."', '".$petition['linck_image']."');"
                    )
                );

                def($id_resources_images, 
                    (
                        assocQuery(
                            $connection->query(
                                'SELECT * FROM `resources_images` ORDER BY `id_resources_images` DESC LIMIT 1'
                            )
                        )
                    )['id_resources_images']
                );

                def($consultation_material_images, 
                    $connection->query(
                        "INSERT INTO `material_images` 
                        (`id_stamping_materials`, `id_resources_images`)
                        VALUES
                        ('".$petition['id_stamping_materials']."', '".$id_resources_images."');"
                    )
                );
            },
        'get_stamping_materials' => function() use ($connection, $petition)
            {
                /**
                 * Estas consultas se deben traer el nombre de los materiales de estampados, y las imagenes
                 * Entonces primero se hace una consulta a la tabla stamping_materials, con la cual se trae
                 * el nombre y la descripción del material. Luego 
                 */
                /* return assocQuery(
                    $connection->query(
                        "SELECT  s.name_of_material, r.image_name, r.linck_image
                        FROM stamping_materials AS s
                        JOIN material_images AS m
                            ON m.id_stamping_materials = s.id_stamping_materials
                        JOIN resources_images AS r
                            ON r.id_resources_images = m.id_resources_images;"
                    )
                ); */
                def($stamping_materials,
                    assocQuery(
                        $connection->query(
                            'SELECT id_stamping_materials, name_of_material 
                            FROM stamping_materials;')
                    )
                );
                
                $news_querys = array_reduce($stamping_materials, function(mixed $carry, mixed $item) use ($connection)
                {
                    $obtaining_the_images_of_the_materials = assocQuery(
                        $connection->query(
                            'SELECT r.image_name, r.linck_image
                            FROM material_images AS m
                            JOIN resources_images AS r
                                ON r.id_resources_images = m.id_resources_images
                                WHERE m.id_stamping_materials = '.$item['id_stamping_materials'].';'
                        )
                    );

                    $new_item = array_merge($item, 
                        [
                            'material_images' => (isset($obtaining_the_images_of_the_materials[0])) 
                                ? $obtaining_the_images_of_the_materials
                                : [$obtaining_the_images_of_the_materials]
                        ]
                    );
                    $new_carry = array_merge($carry, [$new_item]);
                    return $new_carry;
                }, []);
                return $news_querys;
            }
    ];
    
    return $methodsToReturn[$method];
};

$courses        = function($method, $connection, array $petition)#: bool
{
    $methodsToReturn = [
        'courses_insert'  => function() use ($connection, $petition)
            {
                $sqlProducts = $connection->prepare("INSERT INTO `courses` (`name_course`, `teacher`) VALUES (?, ?)");
                $boolReturn = $sqlProducts->execute(array($petition['name_course'], $petition['teacher'],));
                return $boolReturn ? 'true' : 'false';
            },
        'name_of_course_inscriptions'   => function() use ($connection, $petition)
            {
                $sqlProducts = $connection->query("SELECT * FROM `courses`");
                return assocQuery($sqlProducts);
                /*
                $sqlProducts = $connection->query(
                    "SELECT i.id_inscriptions, c.name_course, p.name_of_alumno 
                    FROM inscriptions AS i
                    JOIN courses AS c
                        ON i.name_course = c.id_courses
                    JOIN pupil AS p
                        ON i.name_pupil = p.id_pupil
                    ");
                */
                #$sqlProducts->execute();
                /*
                    SELECT c.name, b.title, a.name, t.type
                    FROM transactions AS t
                    JOIN books AS b
                        ON t.book_id = b.book_id
                    JOIN clients AS c
                        ON t.client_id = c.client_id
                    JOIN authors AS a
                        ON b.author_id = a.author_id
                    WHERE c.gender = 'M'
                        -- AND t.type = 'sell'
                        AND t.type IN  ('sell', 'lend')
                */
                #return assocQuery($sqlProducts->execute());
                #var_dump($sqlProducts->execute());
                #return ['uno' => 'primero', 'dos' => 'segundo'];

            },
    ];
    return $methodsToReturn[$method];
};

$inscriptions   = function($method, $connection, array $petition)
{
    $methodsToReturn = 
    [
        'inscriptions_insert'           =>  function() use ($connection, $petition)
            {
                $sqlProducts = $connection->prepare("INSERT INTO `inscriptions` (`name_course`, `name_pupil`) VALUES (?, ?)");
                $boolReturn = $sqlProducts->execute(array($petition['name_course_inscriptions'], $petition['name_student_inscriptions'],));
                return $boolReturn ? 'true' : 'false';
            },
        'name_table_simple'   => function() use ($connection, $petition)
            {
                #$sqlProducts = $connection->query("SELECT * FROM `courses`");
                #return assocQuery($sqlProducts);

                $sqlProducts = $connection->query(
                    "SELECT i.id_inscriptions, c.name_course, p.name_of_alumno 
                    FROM inscriptions AS i
                    JOIN courses AS c
                        ON i.name_course = c.id_courses
                    JOIN pupil AS p
                        ON i.name_pupil = p.id_pupil
                    ");
                
                #$sqlProducts->execute();
                /*
                    SELECT c.name, b.title, a.name, t.type
                    FROM transactions AS t
                    JOIN books AS b
                        ON t.book_id = b.book_id
                    JOIN clients AS c
                        ON t.client_id = c.client_id
                    JOIN authors AS a
                        ON b.author_id = a.author_id
                    WHERE c.gender = 'M'
                        -- AND t.type = 'sell'
                        AND t.type IN  ('sell', 'lend')
                */
                return assocQuery($sqlProducts);
                #var_dump($sqlProducts);
                #return assocQuery($sqlProducts->execute());
                #var_dump($sqlProducts->execute());
                #return ['uno' => 'primero', 'dos' => 'segundo'];

            },
    ];
    return $methodsToReturn[$method];
};

$students_tbl   = function($method, $connection, array $petition)
{
    $methodsToReturn = [
        'students_insert'  => function() use ($connection, $petition)
            {
                $sqlProducts = $connection->prepare("INSERT INTO `pupil` (`name_of_alumno`, `sex`) VALUES (?, ?)");
                $boolReturn = $sqlProducts->execute(array($petition['nombre_de_alumno'], $petition['sexo'],));
                return $boolReturn ? 'true' : 'false';
            },
        'name_pupil_inscriptions'       => function() use ($connection, $petition)
            {
                $sqlProducts = $connection->query("SELECT * FROM `pupil`");
                return assocQuery($sqlProducts);
            },
    ];
    return $methodsToReturn[$method];
};


