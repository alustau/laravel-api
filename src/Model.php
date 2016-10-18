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
     * @return EloquentModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param EloquentModel $model
     * @return EloquentModel
     */
    public function setModel(EloquentModel $model)
    {
        return $this->model = $model;
    }

    /**
     * @param $id
     * @param array $columns
     * @return Model
     */
    public static function find($id, $columns = ['*'])
    {
        $instance = static::instance();

        $model = $instance->model->findOrFail($id, $columns);

        $instance->setModel($model);

        return $instance;
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

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->model, $method], $parameters);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->getModel()->$name;
    }
}