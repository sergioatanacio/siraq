  

<?php
/**
 * Es el archivo raíz.
 */
$routePrint('', 'generalController@temporary');

/**
 * Es la vista para iniciar sesión.
 */
$routePrint('user', 'generalController@user');

/**
 * Es la página donde se procesa el inicio de sessión.
 */
$routePrint('login_controller', 'generalController@login_controller');

/**
 * Es la ruta del panel administrativo.
 */
$routePrint('temporary_administrative_panel', 
    'generalController@temporary_administrative_panel');




