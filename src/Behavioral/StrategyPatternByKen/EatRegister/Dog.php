<?php


namespace Src\Behavioral\StrategyPatternByKen\EatRegister;


class Dog implements Contracts\Animalcule
{

    public function getAnimal(): string
    {
        return '柴犬';
    }
}