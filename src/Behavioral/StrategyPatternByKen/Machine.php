<?php


namespace Src\Behavioral\StrategyPatternByKen;

use Src\Behavioral\StrategyPatternByKen\EatRegister\AnimalEatContext;

/**
 * @property AnimalEatContext animalcule
 */
class Machine
{
    public function __construct(string $food, string $level, string $animal)
    {
        $this->animalcule = new AnimalEatContext($food, $level, $animal);
    }

    public function toEat():string
    {
        return $this->animalcule->toEat();
    }
    public function getAnimal():string
    {
        return $this->animalcule->getAnimal();
    }
}