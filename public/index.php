<?php
/**
 * Obtener las constantes
 */
require __DIR__.'/../env.php';

/**
 * Obteniendo los código para que funcione el frameworck
 */
require __DIR__.'/../libraries/puff/puff.php';
    
/**
 * Obteniendo los archivos de programación del sistema, el modelo y el controlador.
 */
require __DIR__.'/../app/models.php';
require __DIR__.'/../app/app.php';

/**
 * Obteniendo el sistema de rutas que van a ejecutar las peticiónes.
 */
require __DIR__.'/../app/routes.php';
//def($routesPrin, require __DIR__.'/../app/routes.php');
//printFunction($routesPrin);