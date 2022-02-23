<?php

shell_exec('git pull origin master && git pull origin desarrollo');

shell_exec(
    ' start pug -w --pretty resources/preprocessors/pug/public -o ./public &&'.
    ' start stylus -w resources\preprocessors\stylus\first.styl -o .\public\css\\ &&'.
    ' code .  && cd public && start php -S localhost:8000 && cd ../ && ls -lha  '.
    ' '
);



/* 
shell_exec('start pug -w --pretty resources/preprocessors/pug/public -o ./public');

shell_exec('start stylus -w resources\preprocessors\stylus\first.styl -o .\public\css\\');

shell_exec('code .  && cd public && start php -S localhost:8000 && cd ../ && ls -lha ');
 */

/* 
1. Ejecutar script SQL de forma directa
$ mysql -u nom-usr -p base-dato < script.sql
2. Autenticarse y luego ejecutar script SQL
$ mysql -u nom-usr -p base-dato
Luego

source script.sql;
O

. script.sql;
 */