# 自動餵食機 (策略模式)

###### tags: `design pattern` `設計模式` `策略模式` `strategy pattern` `php`

> 需求一 ：客戶想要一台自動餵食寵物機

```php=
<?php

namespace Src\Behavioral\StrategyPatternByKen;

/**
 * @property string food 寵物的飼料
 */
class Machine
{
    public function __construct(string $food)
    {
        $this->food = $food;
    }

    public function toEat()
    {
        return $this->food;
    }
}
```

> 需求二 客戶想要選擇高級的飼料

```php=
<?php

namespace Src\Behavioral\StrategyPatternByKen;

/**
 * @property string food 寵物的飼料
 * @property string level 飼料等級
 */
class Machine
{
    public function __construct(string $food, string $level)
    {
        $this->food = $food;
        $this->level = $level;
    }

    public function toEat()
    {
        if ($this->level == 'high') {
            return '高級的'. $this->food;
        }
        return  $this->food;
    }
}
```

> 需求三 客戶有時候沒錢無法支持一般的飼料
* 工程師只能盡力滿足

```php=
<?php

namespace Src\Behavioral\StrategyPatternByKen;

/**
 * @property string food 寵物的飼料
 * @property string level 飼料等級
 */
class Machine
{
    public function __construct(string $food, string $level)
    {
        $this->food = $food;
        $this->level = $level;
    }

    public function toEat()
    {
        if ($this->level == 'high') {
            return '高級的'. $this->food;
        }


        if ($this->level == 'low') {
            return '貧窮的'. $this->food;
        }
        return  $this->food;
    }
}
```

根據不同情形的對應的型態, 就可以使用簡單工廠模式改變
實作三個類別 分別是正常飼料 高級飼料 以及低級飼料

* 定義餵食介面
```php=
<?php


namespace Src\Behavioral\StrategyPatternByKen\Contracts;


interface Eatable
{
    public function toEat();
}
```

* 定義正常飼料類別
```php=
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
```
* 定義高級飼料類別
```php=
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
```
* 定義低級飼料類別
```php=
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
```

最後原本程式搭配簡單工廠即可完成
但客服送來第四個需求

> 希望這個寵物餵食機有切換不同動物的功能

按照簡單工廠的思維 必須要有最少三種以上的類別
分別是(一般飼料 高級飼料 低級飼料) X (動物的種類) 排列組合

而且這樣也違反開放封閉原則
這樣每次有新的動物時就會要改動所有的程式碼

研究一下之後發現了適合的設計模式 本文的標題 `策略模式`

* 定義動物種類介面
```php=
<?php

namespace Src\Behavioral\StrategyPatternByKen\EatRegister\Contracts;

interface Animalcule
{
    public function getAnimal();
}
```
* 實作貓咪的介面
```php=
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
```
* 實作狗狗的介面
```php=
<?php

namespace Src\Behavioral\StrategyPatternByKen\EatRegister;

class Dog implements Contracts\Animalcule
{

    public function getAnimal(): string
    {
        return '柴犬';
    }
}
```

* 製作一個餵食飼料類別 他擁有所有的動物吃飯模式

```php=
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
```

> 在這邊我與原作者不同的點在於 我用陣列的方式儲存 要返回的 動物類別以及 不同等級的飼料 若出現了非陣列中的值 則直接丟出例外錯誤

再來修改machine 呼叫這個餵食飼料類別

```php=
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
```

[`單一職責原則`]
將類別本身職責跟飼料等級的職責分離 就是策略模式的精神

[`開放封閉原則`]
不會在客戶提出一個新的需求時 影響到全部的程式碼了．

[`介面隔離原則`]
定義出`動物介面`與`飼料等級介面` 讓兩者不會互相影響
可以交由各自的算法 分別實現

[`依賴反轉原則`]
機器只需要依賴抽象的`動物`與`飼料`介面
輸入不同的參數就能獲得對應的算法 實現相對應的抽象介面

[`測試`]
```php=
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

```

結果
![](https://i.imgur.com/nokCZN4.png)

參考來源:
[it鐵人賽-YNCBearz](https://ithelp.ithome.com.tw/articles/10243000)
