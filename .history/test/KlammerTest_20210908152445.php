<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use \Mockery as m;
require_once(dirname(__FILE__)."/../vendor/autoload.php");
require_once(dirname(__FILE__)."/../operation.php");
require_once(dirname(__FILE__)."/../subtraktion.php");
final class SubtraktionTest extends TestCase
{
	private $operation;
	private $numeric;
	private $calculator;
    private $stub;
	protected function setUp(): void
    {
        $this->calculator = $this->createMock(Calculator::class);
        $this->numeric = $this->createMock(Numeric::class);
    }
    
    public function testTermKlammer5Minus5KlammerZuMinus5EqualsMinus5(): void
    {
        $this->operation = new Klammer($this->calculator, $this->numeric);
        $this->numeric->method('concatinateNumericValues')->willReturn(array("(5-5)-5"));
        $this->calculator->method('calculate')->willReturn("");
        $this->assertSame("(5-5)-5", $this->operation->findAndCalculateTerm("(5-5)-5"));

    }
    
    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
   
}