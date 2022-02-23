<?php
$data = [
    'username' => 'tecadmin',
    'password' => '012345678'
];
#$payload = json_encode($data, true);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/login_controller');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, true);

$login = [
    "login_type"    => "log_in",
    "email"         => "andres@gmail.com",
    "password"      => "andresc",
];
curl_setopt($ch, CURLOPT_POSTFIELDS, $login);

$httpCode = curl_exec((fn()=>$ch)());
var_dump($httpCode);

$query_login = ["login_type"    => "session_exists"];
curl_setopt($ch, CURLOPT_POSTFIELDS, $query_login);

$httpCode = curl_exec((fn()=>$ch)());
var_dump($httpCode);


curl_close($ch);
