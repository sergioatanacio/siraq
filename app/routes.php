<?php
/**
 * Es el archivo raíz.
 */
$routePrint('', 'generalController@temporary');

/**
 * Es la página donde se procesa el inicio de sessión.
 */
$routePrint('login_controller', 'generalController@login_controller');


/**
 * Es una api que se trae todas las etiquetas que hay en la página.
 */
$routePrint('tags', 'generalController@tags');

/**
 * Es una api que permite añadir los productos, se necesita estar logueado.
 */
$routePrint('add_product_process', 'generalController@add_product_process');



/**
 * Es lo que se trae el error 404
 */
$resource_not_found('generalController@404');

