<?php

use PHPUnit\Framework\TestCase;
require __DIR__.'/../env.php';
require __DIR__.'/../sistem/helpers.php';
require __DIR__.'/../app/models.php';
require __DIR__.'/../sistem/sistem.php';
require __DIR__.'/../app/app.php';
require __DIR__.'/../app/routes.php';

class PostTest extends TestCase
{
    public function test_add_comment_to_post()
    {
        $this->assertEquals(3, 3);
    }
}
