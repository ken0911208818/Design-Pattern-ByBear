<?php


namespace Src\Behavioral\StrategyPattern\CashRegister;


class ElectronicReceipt implements Contracts\Receiptable
{

    public function getReceipt(): string
    {
        return '電子發票';
    }
}