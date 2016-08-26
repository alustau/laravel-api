<?php

use PHPUnit\Framework\TestCase;
use Alustau\API\Exceptions\Handler;

class HandlerTest extends TestCase
{
    public function testEmpty()
    {
        $handler = new Handler;
        
        $this->assertInstanceOf(Handler::class, $handler);
    }
}