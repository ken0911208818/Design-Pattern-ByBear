<?php

namespace Test\Creational\SimpleFactory;

use Src\Creational\SimpleFactory\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    /**
     * @var Program
     */
    private Program $program;

    protected function setUp(): void
    {
        parent::setUp(); // 
        $this->program = New Program();
    }

    public function test_Local_Train()
    {
        $this->assertEquals('區間車', $this->program->getModel('LocalTrain'));
    }

    public function test_Limited_Express()
    {
        $this->assertEquals('自強號', $this->program->getModel('LimitedExpress'));
    }
}
