<?php

use PHPUnit\Framework\TestCase;
use Alustau\API\Exceptions\Handler;
use Alustau\API\Exceptions\DataNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HandlerTest extends TestCase
{
    public function testRenderJson()
    {
        $response = (new Handler)->render(new Request, new DataNotFoundException);
        
        $this->assertJson($response->getContent());
    }
    
    public function testInstanceOfHandler()
    {
        $response = (new Handler)->render(new Request, new DataNotFoundException);
        
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}