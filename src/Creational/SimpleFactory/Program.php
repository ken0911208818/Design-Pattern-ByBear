<?php


namespace Src\Creational\SimpleFactory;


use Src\Creational\SimpleFactory\Factory\RailwayModelFactory;

class Program
{

    /**
     * Program constructor.
     */
    public function __construct()
    {
    }

    public function getModel(string $model)
    {
        $railwayModelFactory = new RailwayModelFactory();
        $model = $railwayModelFactory->createModel($model);
        return $model->getName();
    }
}