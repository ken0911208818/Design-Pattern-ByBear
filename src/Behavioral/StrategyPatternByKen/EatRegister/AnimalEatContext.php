<?php


namespace Src\Behavioral\StrategyPatternByKen\EatRegister;


use http\Exception\RuntimeException;
use LogicException;
use Src\Behavioral\StrategyPatternByKen\Contracts\Eatable;
use Src\Behavioral\StrategyPatternByKen\EatRegister\Contracts\Animalcule;
use Src\Behavioral\StrategyPatternByKen\HighFood;
use Src\Behavioral\StrategyPatternByKen\LowFood;
use Src\Behavioral\StrategyPatternByKen\NormalFood;
use function PHPUnit\Framework\throwException;

/**
 * @property Eatable discountMethod
 * @property Animalcule discountAnimal
 */
class AnimalEatContext
{
    public function __construct(string $food, string $level, string $animal)
    {
        $this->resolveDiscountMethod($food, $level);
        $this->resolveDiscountAnimal($animal);
    }

    private function resolveDiscountMethod(string $food, string $level)
    {
        $result = [
            'high' => new HighFood($food, '高級的'),
            'low'  => new LowFood($food, '低級的'),
            'normal' => new NormalFood($food),
        ];
        if (!isset($result[$level])) {
            throw new LogicException('沒有這種類別的等級');
        }
        $this->discountMethod = $result[$level];
    }

    public function toEat(): string
    {
        return $this->discountMethod->toEat();
    }

    private function resolveDiscountAnimal(string $animal)
    {
        $result = [
            'dog' => new Dog(),
            'cat' => new Cat()
        ];
        if (!isset($result[$animal])) {
            throw new LogicException('沒有這種動物');
        }
        $this->discountAnimal = $result[$animal];
    }

    public function getAnimal():string
    {
        return $this->discountAnimal->getAnimal();
    }
}