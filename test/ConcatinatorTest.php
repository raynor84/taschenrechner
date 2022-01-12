<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	use Taschenrechner\Classes\Concatinator;

final class ConcatinatorTest extends TestCase
{
    private $concatinator;    
    public function testTerm25Plus2Plus3(): void
    {
        $this->concatinator = new Concatinator();

        $this->assertSame(array("25", "+", "2", "+", "3"), $this->concatinator->concatinateNumericValues(["2","5","+","2","+","3"]));

    }
    public function testTermMinus25Plus2Plus3(): void
    {
        $this->concatinator = new Concatinator();

        $this->assertSame(array("-25", "+", "2", "+", "3"), $this->concatinator->concatinateNumericValues(["-","2","5","+","2","+","3"]));

    }
    public function testTermMinus25MinusMinus2(): void
    {
        $this->concatinator = new Concatinator();

        $this->assertSame(array("-25", "-", "-2"), $this->concatinator->concatinateNumericValues(["-","2","5","-", "-","2"]));

    }
    public function testTermMinusMinus25MinusMinus2(): void
    {
        $this->concatinator = new Concatinator();

        $this->assertSame(array("25", "-", "-2"), $this->concatinator->concatinateNumericValues(["-","-","2","5","-", "-","2"]));

    }
    public function testTermSin25Minus2(): void
    {
        $this->concatinator = new Concatinator();
        $this->assertSame(array("sin(", "25", ")", "-2"), $this->concatinator->concatinateArray(["s","i","n","(","2", "5",")", "-", "2"]));

    }

}