<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../env.php';
require_once __DIR__.'/../sistem/helpers.php';
require_once __DIR__.'/../app/models.php';
require_once __DIR__.'/../sistem/sistem.php';
require_once __DIR__.'/../app/app.php';
require_once __DIR__.'/../app/routes.php';


class FunctionalPhpTest extends TestCase
{
    public function test_FunctionalPhpTest()
    {
        global $generalController, $connection;

        def($prueba, 'hola');
        $this->assertEquals($prueba, 'hola');

        $this->assertEquals(iffn(
            fn()=>$prueba === 'mundo',
            fn()=>'Uno',
            fn()=>iffn(
                fn()=>$prueba === 'hola',
                fn()=>'dos'
            ),
        ), 'dos');

        $this->assertEquals(
            run($prueba, fn($one)=> $one === 'hola'), 
            true);


        $this->assertEquals(operation('-', 5, 3), 2);
        
        $this->assertEquals(
            operation('-', [5, 6, 2, 1]),
            -4
        );



    }
}
