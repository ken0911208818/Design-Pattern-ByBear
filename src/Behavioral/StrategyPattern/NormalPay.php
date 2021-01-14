<?php


namespace Src\Behavioral\StrategyPattern;


class NormalPay implements Contracts\Payable
{
    private int $originalPrice;

    /**
     * NormalPay constructor.
     * @param int $originalPrice
     */
    public function __construct(int $originalPrice)
    {
        $this->originalPrice = $originalPrice;
    }

    public function pay(): int
    {
        return $this->originalPrice;
    }
}