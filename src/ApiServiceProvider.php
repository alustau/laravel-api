<?php

namespace Alustau\API;

use Alustau\API\Middlewares\ResponseMiddleware;
use Illuminate\Support\ServiceProvider;
use Alustau\API\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

/**
 * Class ApiServiceProvider
 * @package Alustau\API
 */
class ApiServiceProvider extends ServiceProvider
{

    /**
     * Initialize the Services Provider
     */
    public function boot()
    {
        $this->registerMiddlewares();
        $this->registerExceptionHandler();
    }

    /**
     * Register Excpetion Handler
     */
    protected function registerExceptionHandler()
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    /**
     * Register Middlewares
     */
    protected function registerMiddlewares()
    {
        $this->app->middleware(ResponseMiddleware::class);
    }
}