<?php

shell_exec('git pull origin master && git pull origin desarrollo');

shell_exec('start pug -w --pretty resourses/preprocessors/pug/public -o ./public');

shell_exec('stylus -w resourses\preprocessors\stylus\first.styl -o .\css\\');

shell_exec('code .  && cd public && php -S localhost:8000 && cd ../ && ls -lha ');

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