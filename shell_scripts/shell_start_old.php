<?php

shell_exec('git pull origin master && git pull origin desarrollo');
shell_exec('code . && cd public && code . && start php pug_shell_compile_preprocessors.php && start php stylus_shell_compile_preprocessors.php && start php -S localhost:8000 && cd ../ && ls -lha && cd ..');


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