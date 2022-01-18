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
        'users_login'  => function(/*$name_course, $teacher*/) use ($connection, $petition)
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
        'tags_of_products' => function(/*$name_course, $teacher*/) use ($connection, $petition)
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
                def($consultation ,"SELECT * FROM `tags`");
                return assocQuery($connection->query($consultation));
            }
    ];
    return $methodsToReturn[$method];
};

$courses        = function($method, $connection, array $petition)#: bool
{
    $methodsToReturn = [
        'courses_insert'  => function(/*$name_course, $teacher*/) use ($connection, $petition)
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


