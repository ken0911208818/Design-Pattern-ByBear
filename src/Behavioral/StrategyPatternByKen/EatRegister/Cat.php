<?php


namespace Src\Behavioral\StrategyPatternByKen\EatRegister;


use Src\Behavioral\StrategyPatternByKen\EatRegister\Contracts\Animalcule;

class Cat implements Animalcule
{

    public function getAnimal(): string
    {
        return '貓咪';
    }
}