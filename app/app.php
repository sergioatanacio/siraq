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

                            def($carga_de_archivos, function($archivos, $iterator = 0, $resulting_message = null) use (&$carga_de_archivos, $directorio, $petition, $models, $connectionArg)
                            {
                                def($filename, $archivos['name'][$iterator]);
                                def($temporal, $archivos['tmp_name'][$iterator]);
                                def($image_name_in_code, 
                                    $directorio. time() . '_' . rand(1000000000, 9999999999).'.'.
                                    pathinfo($filename, PATHINFO_EXTENSION));
                                    
                                def($dir, opendir($directorio));
                                def($se_almaceno_o_no, iffn(
                                    fn()=> (move_uploaded_file($temporal, $image_name_in_code)),
                                    fn()=> "El archivo se ha".$filename." almacenado correctamente",
                                    fn()=> "El archivo no se ha almacenado",
                                ));

                                closedir($dir);
                                #def($result_db, $models('products_siraq', 'add_product_model', $petition, $connectionArg)());


                                return iffn(
                                    fn()=> (!isset($archivos['tmp_name'][$iterator + 1])),
                                    fn()=> $resulting_message,
                                    fn()=> $carga_de_archivos($archivos, $iterator + 1, $se_almaceno_o_no . ($result_db ?? ' ')),
                                );
                            });
                            return $carga_de_archivos($_FILES['upload_file']);
                        },
                    'add_stamping_materials' => function() use ($petition, $models, $connectionArg)
                        {
                            def($directorio, __DIR__ . './../public/file_store/img_products/');
                            run($directorio, fn($path_to_create) => iffn(
                                    fn()=> !is_dir($path_to_create),
                                    fn()=> mkdir($path_to_create, 0777, true)
                                )
                            );
                            def($id_stamping_materials_db, 
                                $models('stamping_materials', 'add_stamping_model', $petition, $connectionArg)());


                            def($carga_de_archivos, 
                                function($archivos, $iterator = 0, $resulting_message = null) 
                                use(&$carga_de_archivos, $directorio, $petition, $models, $connectionArg, $id_stamping_materials_db)
                            {
                                def($filename, $archivos['name'][$iterator]);
                                def($temporal, $archivos['tmp_name'][$iterator]);
                                def($image_name_in_code, 
                                    time() . '_' . rand(1000000000, 9999999999).'.'.
                                    pathinfo($filename, PATHINFO_EXTENSION));
                                    
                                def($dir, opendir($directorio));
                                def($se_almaceno_o_no, iffn(
                                    fn()=> (move_uploaded_file($temporal, $directorio . $image_name_in_code)),
                                    fn()=> "El archivo se ha".$filename." almacenado correctamente",
                                    fn()=> "El archivo no se ha almacenado",
                                ));

                                def($request_more_file_data, 
                                    o('+', 
                                        $petition, 
                                        [
                                            'id_stamping_materials'     => $id_stamping_materials_db,
                                            'image_name'                => $filename, 
                                            'linck_image'               => $image_name_in_code
                                        ]
                                    )
                                );

                                closedir($dir);
                                def($result_db, 
                                    $models('stamping_materials', 'add_stamping_images_model', $request_more_file_data, $connectionArg)()
                                );


                                return iffn(
                                    fn()=> (!isset($archivos['tmp_name'][$iterator + 1])),
                                    fn()=> $resulting_message,
                                    fn()=> $carga_de_archivos($archivos, $iterator + 1, $se_almaceno_o_no . $result_db),
                                );
                            });
                            return $carga_de_archivos($_FILES['upload_file']);
                        },
                    'get_stamping_materials' => function() use ($petition, $models, $connectionArg)
                        {
                            #return json_encode($models('stamping_materials', 'get_stamping_materials', $petition, $connectionArg)());
                            return json_encode(array (
                                0 => 
                                    array (
                                        'id_stamping_materials' => '1',
                                        'name_of_material' => 'Sublimado',
                                        'material_images' => 
                                            array (
                                                0 => 
                                                array (
                                                'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                'linck_image' => 'pruebas_svg/prueba1.svg',
                                                ),
                                            ),
                                    ),
                                1 => 
                                    array (
                                        'id_stamping_materials' => '2',
                                        'name_of_material' => 'Vinil textil',
                                        'material_images' => 
                                            array (
                                                0 => 
                                                array (
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba2.svg',
                                                ),
                                            ),
                                    ),
                                2 => 
                                    array (
                                        'id_stamping_materials' => '3',
                                        'name_of_material' => 'Serigrafía',
                                        'material_images' => 
                                            array (
                                                0 => 
                                                array (
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba3.svg',
                                                ),
                                            ),
                                    ),
                                ));
                        },
                    'get_stamping_size' =>  function() use ($petition, $models, $connectionArg)
                        {
                            return json_encode(
                                [
                                    [
                                        'id_stamping_size'      => '1',
                                        'name_stamping_size'    => 'Logo 7 cm x 5 cm',
                                        'stamping_size_image'   => 
                                            [
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba3.svg',
                                                ],
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba2.svg',
                                                ],
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba1.svg',
                                                ],
                                            ],
                                    ],
                                    [
                                        'id_stamping_size'      => '2',
                                        'name_stamping_size'    => 'A4',
                                        'stamping_size_image'   => 
                                            [
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba2.svg',
                                                ],
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba3.svg',
                                                ],
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba1.svg',
                                                ],
                                            ],
                                    ],
                                    [
                                        'id_stamping_size'      => '3',
                                        'name_stamping_size'    => 'A3',
                                        'stamping_size_image'   => 
                                            [
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba1.svg',
                                                ],
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba2.svg',
                                                ],
                                                [
                                                    'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                    'linck_image' => 'pruebas_svg/prueba3.svg',
                                                ],
                                            ],
                                    ],
                                ]
                            );
                        },
                    'single_stamping_material' =>  function() use ($petition, $models, $connectionArg)
                    {
                        return json_encode(
                            [
                                [
                                    'id_stamping_materials' => '1',
                                    'name_of_material' => 'Sublimado',
                                    'description_material' => 'Esta es la descripción del material y del producto.',
                                    'material_images' => 
                                        [
                                            [
                                                'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                'linck_image' => 'pruebas_svg/prueba1.svg',
                                            ],
                                            [
                                                'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                'linck_image' => 'pruebas_svg/prueba2.svg',
                                            ],
                                            [
                                                'image_name' => 'Imagen_AI_cristiana@3x@3x.png',
                                                'linck_image' => 'pruebas_svg/prueba3.svg',
                                            ],
                                        ],
                                ],
                            ]
                        );
                    }
                ]);
                return $administrative_panel_api[$petition['administrative_panel_type']]();
            },
        
    ]);
    return $methodsToReturn[$method];
});

