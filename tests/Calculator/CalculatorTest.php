<?php


namespace Calculator;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase {
    private $calculator;

    protected function setUp(): void{
        $this->calculator = new Calculator();
    }


    public function testInit() {
        $this->assertEquals('0', $this->calculator->display());
    }

    /**
     *  @dataProvider keystrokeProvider
     */
    public function testExpressions(array $keys, string $expected) {
        foreach ($keys as $key) {
            $this->calculator->keystroke($key);
        }
        $this->assertEquals($expected, $this->calculator->display());
    }


    public function keystrokeProvider(): array {
        return [
            [['1', '+', '4', '*', '3', '0', '='], '150'],
            [['3', '0', '0', '/', '1', '5', '+', '5', '+', '1', '7', '='], '42'],
            [['5', '+-', '0', '-', '+', '2', '9', '='], '-21'],
            [['-', '8', '='], '-8'],
            [['.', '5', '5', '*', '1', '0', '='], '5.5'],
            [['5', '0', '.', '3', '6', '-', '1', '1', '.', '3', '3', '3', '3', '='], '39.0267'],
            [['1', '/', '3', '='], '0.3333333']
        ];
    }
}
