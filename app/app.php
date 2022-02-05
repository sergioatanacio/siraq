<?php

def($generalController, function($method, $connectionArg, $petition) use ($models)
{
    def($methodsToReturn, [
        '404' => fn()=> template(
            'temporary_siraq/temporarySecond.html', 
            [
                'title' => fn()=> 
                    '<title>Siraq - Estampados polos y personalizados</title>
                    <link href="template_front/css/style.css" rel="stylesheet" />',
                'contend' => fn()=> 'Este es un error 404 personalizado.',
            ]
        ),
        'temporary'             => fn()=> header('Location: '.'/index.html'),
        'login_controller'  => function() use ($petition, $models, $connectionArg)
            {
                def($arrayReturnLoginApi, [
                    'log_in'            => function() use ($petition, $models, $connectionArg)
                        {
                            def($resultUser,
                                iffn(
                                    fn()=>isset($petition),
                                    fn()=>
                                        $models
                                        (
                                            'user_siraq', 'users_login', 
                                            [
                                                'email'     => $petition['email'],    
                                                'password'  => $petition['password'],
                                            ], 
                                            $connectionArg
                                        )()
                                )
                            );
                    
                            return iffn(fn()=>$resultUser !== [],
                                function()
                                {
                                    sessionStarted();
                                    return json_encode(active_session_get_boolean());
                                },
                                function()
                                {
                                    sessionEnded();
                                    return json_encode(active_session_get_boolean());
                                }
                            );
                        },
                    'session_exists'    => fn() => json_encode(active_session_get_boolean()),
                    'close_session'     => function() use ($petition, $models, $connectionArg)
                        {
                            sessionEnded();
                            return json_encode(active_session_get_boolean());
                        },
                ]);
                return $arrayReturnLoginApi[$petition['login_type']]();
            },
        'administrative_panel'=> function() use ($petition, $models, $connectionArg)
            {
                def($administrative_panel_api, [
                    'tags'              => fn()=>json_encode($models
                        (
                            'tags_siraq', 'tags_of_products', [], 
                            $connectionArg
                        )()),
                    'add_product_process'=> function() use ($petition, $models, $connectionArg)
                    {
                        def($directorio, __DIR__ . './../public/file_store/img_products/');
                        run($directorio, fn($path_to_create) => iffn(
                                fn()=> !is_dir($path_to_create),
                                fn()=> mkdir($path_to_create, 0777, true)
                            )
                        );

                        $carga_de_archivos = function($archivos, $result = 0) use (&$carga_de_archivos, $directorio)
                        {
                            def($filename, $archivos['name'][$result]);
                            def($temporal, $archivos['tmp_name'][$result]);
                            def($image_name_in_code, $directorio. time() . '_' . rand(1000000000, 9999999999).'.'.pathinfo($filename, PATHINFO_EXTENSION));
                            def($dir, opendir($directorio));
                            iffn(
                                fn()=> (move_uploaded_file($temporal, $image_name_in_code)),
                                fn()=> "El archivo se ha almacenado correctamente",
                                fn()=> "El archivo no se ha almacenado",
                            );
                            closedir($dir);


                            return iffn(
                                fn()=> (!isset($archivos['tmp_name'][$result + 1])),
                                fn()=> $result + 1,
                                fn()=> $carga_de_archivos($archivos, $result + 1),
                            );
                        };

                        return $carga_de_archivos($_FILES['upload_file']);

                        var_dump($_FILES);
                        $final = null;
                        foreach ($_FILES['upload_file']['tmp_name'] as $key => $tmp_name) {
                            if($_FILES['upload_file']['name'][$key])
                            {
                                $filename = $_FILES['upload_file']['name'][$key];
                                $temporal = $_FILES['upload_file']['tmp_name'][$key];
                                $image_name_in_code = $directorio. time() . '_' . rand(1000000000, 9999999999).'.'.pathinfo($filename, PATHINFO_EXTENSION) ;
                                #def($image_name_in_code, '/file_store/img_products/'. time() . '_' . rand(1000000000, 9999999999));
                                var_dump($_FILES);
                                $dir = opendir($directorio);
                                if(move_uploaded_file($temporal, $image_name_in_code))
                                {
                                    $final = $final . ("El archivo se ha almacenado correctamente");
                                } else
                                {
                                    $final = $final . ("El archivo no se ha almacenado");
                                }
                                closedir($dir);
                            }
                        }
                        return $final;


                        return array_map(function($files)
                            {
                                def($image_name_in_code, '/file_store/img_products/'. time() . '_' . rand(1000000000, 9999999999));
                                #def($nombre_imagen, '/file_store/img_products/'. $files['name']);
                                def($destination_folder, $_SERVER['DOCUMENT_ROOT'] . $image_name_in_code);
                                var_dump($files);
                                echo(move_uploaded_file($files['upload_file']['tmp_name'], $destination_folder));


                            }, 
                            $_FILES
                        );

                        def($nombre_imagen, '/file_store/img_products/'. $_FILES['upload_file']['name']);
                        def($name_without_spaces, run($nombre_imagen, fn($name_image)=> str_replace(' ', '-', $name_image)));
                        def($carpeta_destino, $_SERVER['DOCUMENT_ROOT'] . $name_without_spaces);
                        echo($carpeta_destino);
                        def($petition_more_upload_file, operation('+', $petition, ['upload_file' => $name_without_spaces]));
                        
                        def($resultTags, iffn(
                            fn()=> isset($petition_more_upload_file['upload_file']),
                            function() use ($petition_more_upload_file, $models, $connectionArg, $carpeta_destino)
                            {
                                $models
                                (
                                    'products_siraq', 'add_product_model', $petition_more_upload_file, 
                                    $connectionArg
                                )();
                                move_uploaded_file($_FILES['upload_file']['tmp_name'], $carpeta_destino);
                            },
                            fn()=>[false]
                        ));
        
                        return json_encode($petition_more_upload_file);
                        //return json_encode($resultTags);
                        /*return json_encode($petition);*/
                    },
                ]);
                return $administrative_panel_api[$petition['administrative_panel_type']]();
            },
        
    ]);
    return $methodsToReturn[$method];
});

