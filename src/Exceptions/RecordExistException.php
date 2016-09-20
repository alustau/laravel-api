<?php

namespace Alustau\API\Exceptions;

/**
 * ValidationException
 *
 * @author alustau
 */
class RecordExistException extends Exception
{
     /**
      * Http code of exception
      */
     protected $statusCode = 400;

    /**
     * @var array
     */
    protected $validationErrors = [];
     
     /**
     * @param  string $message
     * @return void
     */
    public function __construct($message = null)
    {
        if (!$message) {
            $message = "Este registro já existe.";
        }

        parent::__construct($message, $this->getStatusCode());
    }

    /**
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}
