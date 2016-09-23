<?php

namespace Alustau\API;

use Alustau\API\Traits\ModelValidator as Validator;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model
{
    use Validator;

    /**
     * @var EloquentModel
     */
    protected $model;

    /**
     * @var array
     */
    protected $rules;

    /**
     * @var array
     */
    protected $rulesMessages;

    /**
     * @param EloquentModel $model
     */
    public function __construct(EloquentModel $model)
    {
        $this->model = $model;
    }

    /**
     * @return static
     */
    public static function instance()
    {
        return new static;
    }

    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $instance = static::instance()->model;

        return call_user_func_array([$instance, $method], $parameters);
    }
}