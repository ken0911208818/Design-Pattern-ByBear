<?php


namespace Src\Behavioral\StrategyPattern\CashRegister;


class NormalReceipt implements Contracts\Receiptable
{

    public function getReceipt(): string
    {
        return '一般發票';
    }
}