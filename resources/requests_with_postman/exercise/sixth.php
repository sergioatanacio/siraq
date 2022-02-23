<?php
$data = [
    'username' => 'tecadmin',
    'password' => '012345678'
];
#$payload = json_encode($data, true);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


$httpCode = curl_exec($ch);
#$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

var_dump($httpCode);
/* 
switch ( $httpCode ) {
    case 200:
        echo 'Respuesta correcta';
        break;
    case 400:
        echo 'Pedido incorrecto';
        break;
    case 404:
        echo 'Recurso no encontrado';
        break;
    case 500:
        echo 'Falló el servidor';
        break;
} */