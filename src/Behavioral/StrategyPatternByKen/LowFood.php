<?php


namespace Src\Behavioral\StrategyPatternByKen;


class LowFood implements Contracts\Eatable
{
    private string $food;
    private string $level;

    public function __construct(string $food, string $level)
    {
        $this->food = $food;
        $this->level = $level;
    }

    public function toEat():string
    {
        return $this->level . $this->food;
    }
}