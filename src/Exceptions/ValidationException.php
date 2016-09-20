<?php

namespace Alustau\API\Exceptions;

/**
 * ValidationException
 *
 * @author alustau
 */
class ValidationException extends Exception
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
    public function __construct(array $errors, $message = null)
    {
        if (!$message) {
            $message = "The parameters are not valid";
        }

        $this->validationErrors = $errors;

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
