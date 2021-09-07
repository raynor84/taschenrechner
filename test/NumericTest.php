<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use \Mockery as m;
require_once(dirname(__FILE__)."/../vendor/autoload.php");
require_once(dirname(__FILE__)."/../numeric.php");
final class NumericTest extends TestCase
{
    private $numeric;    
    public function testTerm25Plus2Plus3(): void
    {
        $this->numeric = new Numeric();

        $this->assertSame(array("25", "+", "2", "+", "3"), $this->numeric->concatinateNumericValues(["2","5","+","2","+","3"]));

    }
    public function testTermMinus25Plus2Plus3(): void
    {
        $this->numeric = new Numeric();

        $this->assertSame(array("-25", "+", "2", "+", "3"), $this->numeric->concatinateNumericValues(["-","2","5","+","2","+","3"]));

    }
    public function testTermMinus25MinusMinus2(): void
    {
        $this->numeric = new Numeric();

        $this->assertSame(array("-25", "-", "-2"), $this->numeric->concatinateNumericValues(["-","2","5","-", "-","2"]));

    }
    public function testTermMinusMinus25MinusMinus2(): void
    {
        $this->numeric = new Numeric();

        $this->assertSame(array("25", "-", "-2"), $this->numeric->concatinateNumericValues(["-","-","2","5","-", "-","2"]));

    }
}