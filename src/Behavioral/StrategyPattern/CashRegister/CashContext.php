<?php


namespace Src\Behavioral\StrategyPattern\CashRegister;


use Src\Behavioral\StrategyPattern\FeedbackPay;
use Src\Behavioral\StrategyPattern\NormalPay;
use Src\Behavioral\StrategyPattern\OffPercentPay;

/**
 * @property OffPercentPay discountMethod
 * @property ElectronicReceipt receipt
 */
class CashContext
{
    public function __construct(int $originalPrice, string $discountMethod, string $receipt)
    {
        $this->resolveDiscountMethod($originalPrice, $discountMethod);
        $this->resolveReceiptType($receipt);
    }

    public function resolveDiscountMethod(int $originalPrice, string $discountType)
    {
        switch($discountType) {
            case '20% off':
                $this->discountMethod = new OffPercentPay($originalPrice, 0.2);
                break;
            case 'spend_300_feedback_100':
                $this->discountMethod = new FeedbackPay($originalPrice, 300, 100);
                break;
            default:
                $this->discountMethod = new NormalPay($originalPrice);
                break;
        }
    }

    /**
     * @param string $receiptType
     */
    private function resolveReceiptType(string $receiptType)
    {
        switch ($receiptType) {
            case 'electronicReceipt':
                $this->receipt = new ElectronicReceipt();
                break;

            default:
                $this->receipt = new NormalReceipt();
                break;
        }
    }

    public function pay(): int
    {
        return $this->discountMethod->pay();
    }
    public function getReceipt(): string
    {
        return $this->receipt->getReceipt();
    }
}