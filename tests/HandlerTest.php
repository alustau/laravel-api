<?php

use PHPUnit\Framework\TestCase;
use Alustau\API\Exceptions\Handler;
use Alustau\API\Exceptions\DataNotFoundException;
use Illuminate\Http\Request;

class HandlerTest extends TestCase
{
    public function testRenderJson()
    {
        $this->assertJson(
            (new Handler)->render(new Request, new DataNotFoundException)
        );
    }
}