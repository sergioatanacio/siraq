<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../env.php';
require_once __DIR__.'/../sistem/helpers.php';
require_once __DIR__.'/../app/models.php';
require_once __DIR__.'/../sistem/sistem.php';
require_once __DIR__.'/../app/app.php';
require_once __DIR__.'/../app/routes.php';
def($tres, '3');

class PostTest extends TestCase
{
    public function test_add_comment_to_post()
    {
        global $generalController, $connection;

        $this->assertEquals($generalController('temporary', $connection, []), fn()=> template(
                'temporary_siraq/temporarySecond.html', 
                [
                    'title' => fn()=> 
                        '<title>Siraq - Estampados polos y personalizados</title>
                        <link href="template_front/css/style.css" rel="stylesheet" />',
                    'contend' => fn()=> require response('temporary_siraq/contentStart.html'),
                ]
            )
        );

        $this->assertEquals($generalController('user', $connection, []), fn()=> template(
                'temporary_siraq/temporarySecond.html', 
                [
                    'title' => fn()=> '<title>Siraq - Admin Dashboard</title>',
                    'contend' => fn()=> require response('temporary_siraq/temporaryLogin.html'),
                ]
            )
        );

        $this->assertEquals($generalController('temporary_administrative_panel', $connection, []), fn()=> template(
                'temporary_siraq/temporarySecond.html', 
                [
                    'title' => fn()=> '<title>Siraq - Admin Dashboard</title>',
                    'contend' => fn()=> require response('temporary_siraq/temporaryAdmin.html'),
                ]
            )
        );


    }
}
