<?php


namespace Src\Creational\SimpleFactory;


use Src\Creational\SimpleFactory\Factory\Model;

class LocalTrain implements Model
{

    public function getName(): string
    {
        return '區間車';
    }
}