<?php


namespace Src\Creational\SimpleFactory;


use Src\Creational\SimpleFactory\Factory\Model;

class LimitedExpress implements Model
{

    public function getName(): string
    {
        return '自強號';
    }
}