<?php

shell_exec('pug -w --pretty preprocessors/pug/ -o .');
shell_exec('stylus -w preprocessors\stylus\first.styl -o .\css\\');