<?php

$connection = new \PDO("mysql:host=".db_host."; dbname=".db_nombre, db_usuario, db_pasword);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->exec("SET CHARACTER SET utf8");

return $connection;