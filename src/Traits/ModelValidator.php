<?php
namespace Alustau\API\Traits;

use Illuminate\Support\Facades\Validator;
use Alustau\API\Exceptions\ValidationException;

trait ModelValidator
{
    public static function getRulesMsgs()
    {
        return (new static)->getRulesMessages();
    }
    /**
     * @return array
     */
    public function getRulesMessages()
    {
        return $this->rulesMessages;
    }

    /**
     * @param array $rulesMessages
     */
    public function setRulesMessages(array $rulesMessages)
    {
        $this->rulesMessages = $rulesMessages;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    public function isValid($data)
    {
        return Validator::make($data, $this->getRules(), $this->getRulesMessages());
    }

    public function validOrFail(array $data)
    {
        $validation = Validator::make(
            $data,
            $this->getRules(),
            $this->getRulesMessages()
        );

        if ($validation->fails()) {
            throw new ValidationException($validation->errors()->toArray());
        }

        return true;
    }
}
