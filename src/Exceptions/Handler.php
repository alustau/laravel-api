<?php

namespace Alustau\API\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler implements ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $response = [
            'message' => (string) $e->getMessage(),
            'status' => 400
        ];
        
        if ($e instanceof HttpException) {
            $response['message'] = Response::$statusTexts[$e->getStatusCode()];
            $response['status'] = $e->getStatusCode();
        } else if ($e instanceof ModelNotFoundException) {
            $response['message'] = Response::$statusTexts[Response::HTTP_NOT_FOUND];
            $response['status'] = Response::HTTP_NOT_FOUND;
        } 

//        if ($this->isDebugMode()) {
//            $response['debug'] = [
//                'exception' => get_class($e),
//                'trace' => $e->getTrace()
//            ];
//        }

        return response()->json(['error' => $response], $response['status']);
    }

    public function renderForConsole($output, Exception $e)
    {
        
    }

}
