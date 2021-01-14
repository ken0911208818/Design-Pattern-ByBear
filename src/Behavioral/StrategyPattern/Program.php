<?php


namespace Src\Behavioral\StrategyPattern;


use Src\Behavioral\StrategyPattern\CashRegister\CashContext;

/**
 * @property CashContext cashContext
 */
class Program
{
    private $originalPrice;
    private $promotion;

    /**
     * Program constructor.
     * @param int $originalPrice 原價
     * @param string $promotion 打折策略
     * @param string $receipt 發票方式 一般 電子
     */
    public function __construct(int $originalPrice, string $promotion, string $receipt)
    {
        $this->cashContext = new CashContext($originalPrice, $promotion, $receipt);
    }

    public function pay(): int
    {
        return $this->cashContext->pay();
    }

    public function getReceipt():string
    {
        return $this->cashContext->getReceipt();
    }
}