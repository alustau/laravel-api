<?php

namespace Alustau\API\Exceptions;

use Exception;

/**
 * Description of DataNotFoundException
 *
 * @author alustau
 */
class DataNotFoundException extends Exception
{
     /**
     * Create a new exception instance.
     *
     * @param  string $message
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function __construct($message, $response = null)
    {
        parent::__construct('The results of given data was not found', 404);
    }
}
