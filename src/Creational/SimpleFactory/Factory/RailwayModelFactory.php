<?php


namespace Src\Creational\SimpleFactory\Factory;


use PHPUnit\Util\Xml\Validator;
use Src\Creational\SimpleFactory\LimitedExpress;
use Src\Creational\SimpleFactory\LocalTrain;
use Src\Creational\SimpleFactory\SemiExpress;

class RailwayModelFactory
{

    public function createModel(string $model): Model
    {
        switch ($model) {
            case 'LocalTrain':
                return new LocalTrain();
            case 'LimitedExpress':
                return  new LimitedExpress();
            case 'SemiExpress':
                return new SemiExpress();
        }
    }
}