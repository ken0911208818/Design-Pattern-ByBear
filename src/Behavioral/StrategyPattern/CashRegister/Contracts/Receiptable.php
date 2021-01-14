<?php


namespace Src\Behavioral\StrategyPattern\CashRegister\Contracts;


interface Receiptable
{
    public function getReceipt(): string;
}