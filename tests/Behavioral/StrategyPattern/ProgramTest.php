<?php

namespace Test\Behavioral\StrategyPattern;

use Src\Behavioral\StrategyPattern\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    // test_打不打折價格_發票類型
    public function test_normalReceipt_normalPrice()
    {
        $Program = new Program(200, '', '');
        $this->assertEquals('一般發票', $Program->getReceipt());
        $this->assertEquals(200, $Program->pay());
    }
    public function test_normalReceipt_electronicPrice()
    {
        $program = new Program(200, '', 'electronicReceipt');
        $this->assertEquals('電子發票', $program->getReceipt());
        $this->assertEquals(200, $program->pay());
    }

    public function test_20offReceipt_normalPrice()
    {
        $program = new Program(200,'20% off', '');
        $this->assertEquals('一般發票', $program->getReceipt());
        $this->assertEquals(200 * 0.8, $program->pay());
    }

    public function test_20offReceipt_electronicPrice()
    {
        $program = new Program(200,'20% off', 'electronicReceipt');
        $this->assertEquals('電子發票', $program->getReceipt());
        $this->assertEquals(200 * 0.8, $program->pay());
    }

    public function test_spend_300_feedback_100_normalPrice()
    {
        $program = new Program(400,'spend_300_feedback_100', '');
        $this->assertEquals('一般發票', $program->getReceipt());
        $this->assertEquals(300, $program->pay());
    }

    public function test_spend_300_feedback_100_electronicPrice()
    {
        $program = new Program(400,'spend_300_feedback_100', 'electronicReceipt');
        $this->assertEquals('電子發票', $program->getReceipt());
        $this->assertEquals(300, $program->pay());
    }
}
