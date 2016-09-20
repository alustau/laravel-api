<?php
namespace Alustau\API\Exceptions;

use Exception;
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
    public function report(Exception $e) {}

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
            'status'  => 400
        ];
        
        if ($e instanceof HttpException) {
            $response['message'] = Response::$statusTexts[$e->getStatusCode()];
            $response['status'] = $e->getStatusCode();
        } else if ($e instanceof ModelNotFoundException) {
            $response['message'] = Response::$statusTexts[Response::HTTP_NOT_FOUND];
            $response['status'] = Response::HTTP_NOT_FOUND;
        } else if ($e instanceof BaseException) {
            $response['message'] = $e->getMessage();
            $response['status']  = $e->getStatusCode();
        } else if ($e instanceof ValidationException) {
            $response['message'] = $e->getMessage();
            $response['status']  = $e->getStatusCode();
            $response['error']   = $e->getValidationErrors();
        }
        
        return new JsonResponse($response, $response['status']);
    }

    public function renderForConsole($output, Exception $e) {}
}
