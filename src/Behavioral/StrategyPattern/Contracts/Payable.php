<?php


namespace Src\Behavioral\StrategyPattern\Contracts;


interface Payable
{
    public function pay(): int;
}