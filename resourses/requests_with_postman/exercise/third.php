<?php

#http:localhost:8000
#$url = "https://platzi.com";
$url = "http://localhost:8000";
// Los datos de formulario
$datos = [
    "nombre" => "Luis Cabrera Benito",
    "web" => "https://parzibyte.me/blog",
];


$query_by_post_method = function($url_fn, $datos_fn = [])
{
    // Crear opciones de la petición HTTP
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos_fn), # Agregar el contenido definido antes
        ),
    );
    # Preparar petición
    $contexto = stream_context_create($opciones);
    # Hacerla
    $resultado = file_get_contents($url_fn, false, $contexto);

    return ($resultado === false) ? "Error haciendo petición" : $resultado;
};

# si no salimos allá arriba, todo va bien
#var_dump($query_by_post_method($url, $datos));
 
var_dump($query_by_post_method("http://localhost:8000/login_controller",
    [
        "login_type"    => "log_in",
        "email"         => "andres@gmail.com",
        "password"      => "andresc",
    ]
));

var_dump($query_by_post_method("http://localhost:8000/login_controller",
    ["login_type"    => "session_exists"]
)); 

#"session_exists"
#"close_session"