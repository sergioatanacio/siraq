<?php

use PHPUnit\Framework\TestCase;
require __DIR__.'/../env.php';
require __DIR__.'/../sistem/helpers.php';
require __DIR__.'/../app/models.php';
require __DIR__.'/../sistem/sistem.php';
require __DIR__.'/../app/app.php';
require __DIR__.'/../app/routes.php';
def($tres, '3');

class PostTest extends TestCase
{
    public function test_add_comment_to_post()
    {
        global $generalController, $connection;
        
        $this->assertEquals($generalController('user', $connection, []), fn()=> template(
                'temporary_siraq/temporarySecond.html', 
                [
                    'title' => fn()=> '<title>Siraq - Admin Dashboard</title>',
                    'contend' => fn()=> require response('temporary_siraq/temporaryLogin.html'),
                ]
            )
        );
    }
}
