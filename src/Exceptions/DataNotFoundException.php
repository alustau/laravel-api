<?php

namespace Alustau\API\Exceptions;

use Alustau\API\Exceptions\Exception;

/**
 * DataNotFoundException
 *
 * @author alustau
 */
class DataNotFoundException extends Exception
{
     /**
      * Http code of exception
      */
     protected $statusCode = 404;
     
     /**
     * @param  string $message
     * @return void
     */
    public function __construct($message = null)
    {
        if (!$message) {
            $message = 'The results of given data was not found';
        }
        
        parent::__construct($message, $this->getStatusCode());
    }
}
