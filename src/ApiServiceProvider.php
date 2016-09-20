<?php
/**
 * Created by PhpStorm.
 * User: alustau
 * Date: 20/09/16
 * Time: 15:14
 */

namespace Alustau\API;

use Illuminate\Support\ServiceProvider;
use Alustau\API\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

class ApiServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerMiddlewares();
        $this->registerExceptionHandler();
    }

    protected function registerExceptionHandler()
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    protected function registerMiddlewares()
    {
        $this->app->middleware([
            Handler::class
        ]);
    }
}