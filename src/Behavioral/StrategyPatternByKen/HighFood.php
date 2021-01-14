<?php


namespace Src\Behavioral\StrategyPatternByKen;


/**
 * @property string food
 * @property string level
 */
class HighFood implements Contracts\Eatable
{
    public function __construct(string $food, string $level)
    {
        $this->food = $food;
        $this->level = $level;
    }

    public function toEat(): string
    {
        return $this->level . $this->food;
    }
}