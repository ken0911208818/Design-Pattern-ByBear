<?php


namespace Src\Behavioral\StrategyPatternByKen;


use Src\Behavioral\StrategyPatternByKen\Contracts\Eatable;

/**
 * @property string food
 */
class NormalFood implements Eatable
{
    public function __construct(string $food)
    {
        $this->food = $food;
    }

    public function toEat(): string
    {
        return $this->food;
    }
}