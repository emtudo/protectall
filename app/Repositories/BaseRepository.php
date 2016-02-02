<?php

namespace App\Repositories;

use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var Illuminate\Container\Container
     */
    private $app;

    /**
     * Devolve a model que será criada
     *
     * @return string
     */
    abstract public function model();

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Cria a model
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }
}
