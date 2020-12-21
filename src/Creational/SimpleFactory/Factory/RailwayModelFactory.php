<?php


namespace Src\Creational\SimpleFactory\Factory;


use Src\Creational\SimpleFactory\LimitedExpress;
use Src\Creational\SimpleFactory\LocalTrain;

class RailwayModelFactory
{

    public function createModel(string $model): Model
    {
        switch ($model) {
            case 'LocalTrain':
                return new LocalTrain();
            case 'LimitedExpress':
                return  new LimitedExpress();

        }
    }
}