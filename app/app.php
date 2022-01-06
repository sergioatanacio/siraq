<?php

def($generalController, function($method, $connectionArg, $petition) use ($models)
{
    def($methodsToReturn, [
        'temporary'             => function() 
            {
                return template(
                    'temporary_siraq/temporarySecond.html', 
                    [
                        'title' => fn()=> 
                            '<title>Siraq - Estampados polos y personalizados</title>
                            <link href="template_front/css/style.css" rel="stylesheet" />',
                        'contend' => fn()=> require response('temporary_siraq/contentStart.html'),
                    ]
                ); 
                #return response_require('temporary_siraq/temporary.html');
            },
        'apps'                  => function() 
            {
                return response_require('beginning.html');
            },
        'user'                  => function() 
            {
                return template(
                    'temporary_siraq/temporarySecond.html', 
                    [
                        'title' => fn()=> '<title>Siraq - Login</title>',
                        'contend' => fn()=> require response('temporary_siraq/temporaryLogin.html'),
                    ]
                ); 
            },
        'login_controller'  => function() use ($petition, $models, $connectionArg)
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
                #pre($resultUser);
                
                return iffn(fn()=>$resultUser !== [],
                    #fn()=> response_require('temporary_siraq/temporaryAdmin.html'),
                    function(){
                        sessionStarted();
                        return header('Location: '.'/temporary_administrative_panel');
                    },
                    function()
                    {
                        sessionEnded();
                        return template(
                            'temporary_siraq/temporarySecond.html', 
                            [
                                'title' => fn()=> '<title>Siraq - Message</title>',
                                'contend' => fn()=> 
                                'El usuario o la contraseña es incorrecto. Prueba nuevamente o comunicate con soporte.
                                </br><a class="small" href="/user">Intentar otra vez</a>
                                </br><a class="small" href="/">Ir al inicio</a>
                                ',
                            ]
                        ); 
                    });
                #return response_require('user/administrative_panel.html');
            },
        'temporary_administrative_panel'   => function() 
            {
                activeSession();
                #return response_require('temporary_siraq/temporaryAdmin.html');
                return template(
                    'temporary_siraq/temporarySecond.html', 
                    [
                        'title' => fn()=> '<title>Siraq - Admin Dashboard</title>',
                        'contend' => fn()=> require response('temporary_siraq/temporaryAdmin.html'),
                    ]
                ); 
            },
        'administrative_panel'  => function() use ($petition, $models, $connectionArg)
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

                pre($resultUser);
                return response_require('user/administrative_panel.html');
            },
        'close_session'   => function() 
            {
                sessionEnded();
                activeSession();
            },
        'start'         => function() 
            {
                return response_require('start/start.html');
            },
        'students'      => function() use ($petition, $models, $connectionArg)
            {
                return $models
                (
                    'students_tbl', 'students_insert', 
                    [
                        'nombre_de_alumno'  => $petition['nombre_alumno'],    
                        'sexo'              => $petition['sex'],
                    ], 
                    $connectionArg
                )();
            },
        'courses'       => function() use ($petition, $models, $connectionArg)
            {
                return $models
                (
                    'courses', 'courses_insert', 
                    [
                        'name_course'   => $petition['front_name_course'],    
                        'teacher'       => $petition['front_teacher'],
                    ], 
                    $connectionArg
                )();
            },
        'inscriptions_insert'  => function() use ($petition, $models, $connectionArg)
            {
                return json_encode
                ($models
                    (
                        'inscriptions', 'inscriptions_insert', 
                        [
                            'name_course_inscriptions'  => $petition['name_course_inscriptions'],    
                            'name_student_inscriptions' => $petition['name_student_inscriptions'],
                        ], 
                        $connectionArg
                    )()
                );
            },
        'json_course'  => function() use ($petition, $models, $connectionArg)
            {
                return json_encode
                ($models
                    (
                        'courses', 'name_of_course_inscriptions', [], $connectionArg
                    )()
                );
            },
        'json_inscriptions'  => function() use ($petition, $models, $connectionArg)
            {
                return json_encode
                ($models
                    (
                        'courses', 'name_of_course_inscriptions', [], $connectionArg
                    )()
                );
            },
        'json_students'  => function() use ($petition, $models, $connectionArg)
            {
                return json_encode
                ($models
                    (
                        'students_tbl', 'name_pupil_inscriptions', [], $connectionArg
                    )()
                );
            },
        'script_start'  => function()
            {
                $enviando_dato_desde_el_controlador = 'Enviando datos y más cosas.';

                return require response('start/script_start.js');
            },
        'table_simple'  => function() use ($petition, $models, $connectionArg)
            {
                return json_encode
                ($models
                    (
                        'inscriptions', 'name_table_simple', [], $connectionArg
                    )()
                );
            },

    ]);
    return $methodsToReturn[$method];
});

def($listick, function($method, $connectionArg, $petition) use ($models)
{
    $methodsToReturn =
    [
        'beginning'     => function()
            {
                return response_require('listick/listickBeginning.html');
            },
        'login'         => function()
            {
                return ;
            },
        'create_account' => function()
            {

            },
    ];
    return $methodsToReturn[$method];
});

def($siraq, function($method, $connectionArg, $petition) use ($models)
{
    $methodsToReturn =
    [
        'beginning'     => function()
        {
            return response_require('siraq/siraqBeginning.html');
        },
        'load_products'     => function()
        {
            return response_require('siraq/load_products.html');
        },
        'load_products_push'     => function()
        {
            //Si se quiere subir una imagen
            if (isset($_POST['subir'])) {
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['archivo']['name'];
            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = $_FILES['archivo']['tmp_name'];
                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                }
                else {
                    //Si la imagen es correcta en tamaño y tipo
                    //Se intenta subir al servidor
                    if (move_uploaded_file($temp, 'images/'.$archivo)) {
                        //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                        chmod('images/'.$archivo, 0777);
                        //Mostramos el mensaje de que se ha subido co éxito
                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                        //Mostramos la imagen subida
                        echo '<p><img src="images/'.$archivo.'"></p>';
                    }
                    else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                    }
                }
            }
            }

            #return response_require('siraq/load_products.html');
        },
        'login'         => function()
        {
            return ;
        },
        'create_account' => function()
        {

        },
    ];
    return $methodsToReturn[$method];
});

def($stylesMis, function($method, $connectionArg, $petition) use ($models)
{
    $methodsToReturn =
    [
        'stylePhp'  => function()
        {
            $enviando_dato_desde_el_controlador = 'Enviando datos y más cosas.';

            return require response('misEstilos.css');
        },
    ];

    return $methodsToReturn[$method];
});

def($younotes, function($method, $connectionArg, $petition) use ($models)
{
    $methodsToReturn =
    [
        'beginning'  => function()
            {
                $enviando_dato_desde_el_controlador = 'Enviando datos y más cosas.';

                return require response('younotes/younotes.html');
            },
        'younotes_login'  => function()
            {
                $enviando_dato_desde_el_controlador = 'Enviando datos y más cosas.';

                return require response('younotes/younotes_login.html');
            },
        'younotes_script'  => function()
            {
                return require response('younotes/younotes_script.js');
            },
    ];

    return $methodsToReturn[$method];
});

