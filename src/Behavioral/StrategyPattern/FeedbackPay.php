<?php


namespace Src\Behavioral\StrategyPattern;


use phpDocumentor\Reflection\Types\Integer;

class FeedbackPay implements Contracts\Payable
{
    private int $originalPrice;
    private int $priceCondition;
    private int $feedback;

    public function __construct(int $originalPrice, int $priceCondition, int $feedback)
    {
        $this->originalPrice = $originalPrice;
        $this->priceCondition = $priceCondition;
        $this->feedback = $feedback;
    }

    public function pay(): int
    {
        if ($this->originalPrice > $this->priceCondition) {
            return $this->originalPrice - floor($this->originalPrice / $this->priceCondition) * $this->feedback;
        }
        return $this->originalPrice;
    }
}