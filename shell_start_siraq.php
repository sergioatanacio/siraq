<?php


shell_exec('code . && cd public && code . && start php pug_shell_compile_preprocessors.php && start php stylus_shell_compile_preprocessors.php && start php -S localhost:8000 && cd ../ && ls -lha && cd ..');


