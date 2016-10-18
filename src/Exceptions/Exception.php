<?php
namespace Alustau\API\Exceptions;

use Exception as BaseException;

/**
 * @author Denis Alustau
 */
abstract class Exception extends BaseException 
{
    protected $statusCode;
    protected $message;
    
    public function getStatusCode() 
    {
        return $this->statusCode;
    }
}
