<?php

namespace Test\Behavioral\StrategyPatternByKen;

use Src\Behavioral\StrategyPatternByKen\Machine;
use PHPUnit\Framework\TestCase;

/**
 * @property Machine machine
 */
class MachineTest extends TestCase
{

    public function test_dog_normal_food()
    {
        $this->machine = new Machine('乾糧', 'normal', 'dog');
        $this->assertEquals('柴犬', $this->machine->getAnimal());
        $this->assertEquals('乾糧', $this->machine->toEat());
    }

    public function test_cat_normal_food()
    {
        $this->machine = new Machine('乾糧', 'normal', 'cat');
        $this->assertEquals('貓咪', $this->machine->getAnimal());
        $this->assertEquals('乾糧', $this->machine->toEat());
    }

    public function test_dog_low_food()
    {
        $this->machine = new Machine('乾糧', 'low', 'dog');
        $this->assertEquals('柴犬', $this->machine->getAnimal());
        $this->assertEquals('低級的乾糧', $this->machine->toEat());
    }

    public function test_cat_low_food()
    {
        $this->machine = new Machine('乾糧', 'low', 'cat');
        $this->assertEquals('貓咪', $this->machine->getAnimal());
        $this->assertEquals('低級的乾糧', $this->machine->toEat());
    }

    public function test_dog_high_food()
    {
        $this->machine = new Machine('乾糧', 'high', 'dog');
        $this->assertEquals('柴犬', $this->machine->getAnimal());
        $this->assertEquals('高級的乾糧', $this->machine->toEat());
    }

    public function test_cat_high_food()
    {
        $this->machine = new Machine('乾糧', 'high', 'cat');
        $this->assertEquals('貓咪', $this->machine->getAnimal());
        $this->assertEquals('高級的乾糧', $this->machine->toEat());
    }

    public function test_error_normal_food()
    {
        //輸入錯誤的動物
        $this->expectException(\LogicException::class);
        $this->machine = new Machine('乾糧', 'normal', 'mouse');
    }

    public function test_normal_error_level_food()
    {
        //輸入錯誤的等級
        $this->expectException(\LogicException::class);
        $this->machine = new Machine('乾糧', 'aaa', 'dog');
    }
}
