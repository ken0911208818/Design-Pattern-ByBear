<?php


namespace Src\Behavioral\StrategyPattern;


class OffPercentPay implements Contracts\Payable
{
    private int $originalPrice;
    private float $offPercent;

    /**
     * NormalPay constructor.
     * @param int $originalPrice 原價
     * @param float $offPercent 打折趴數
     */
    public function __construct(int $originalPrice, float $offPercent)
    {
        $this->originalPrice = $originalPrice;
        $this->offPercent = $offPercent;
    }

    public function pay(): int
    {
        return $this->originalPrice * (1 - $this->offPercent);
    }
}