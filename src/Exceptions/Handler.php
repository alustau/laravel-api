<?php
namespace Alustau\API\Exceptions;

use Exception as PhpExcpetion;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Alustau\API\Exceptions\Exception as BaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler implements ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(PhpExcpetion $e) {}

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, PhpExcpetion $e)
    {
        $response = [
            'message' => (string) $e->getMessage(),
            'status'  => (int) $e->getCode()
        ];
        
        if ($e instanceof HttpException) {
            $response['message'] = Response::$statusTexts[$e->getStatusCode()];
            $response['status'] = $e->getStatusCode();
        } else if ($e instanceof ModelNotFoundException) {
            $response['message'] = $e->getMessage();
            $response['status']  = Response::HTTP_NOT_FOUND;
        } else if ($e instanceof ValidationException) {
            $response['message'] = $e->getMessage();
            $response['status']  = $e->getStatusCode();
            $response['error']   = $e->getValidationErrors();
        } else if ($e instanceof \PDOException) {
            $response['message'] = $e->getMessage();
            $response['status']  = 400;
        } else if ($e instanceof BaseException) {
            $response['message'] = $e->getMessage();
            $response['status']  = $e->getStatusCode();
        }
        
        return new JsonResponse($response, $response['status']);
    }

    public function renderForConsole($output, PhpExcpetion $e) {}
}
