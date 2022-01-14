<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Klammer;
	use Taschenrechner\Classes\Concatinator;
require_once "init.php";
require_once(dirname(__FILE__)."/../vendor/autoload.php");
final class KlammerTest extends TestCase
{
	private $operation;
	private $concatinator;
	private $calculator;

    protected function setUp(): void
    {
        $this->calculator = $this->createMock(Calculator::class);
        $this->concatinator = $this->createMock(Concatinator::class);
    }
    
    public function testTermKlammer5Minus5KlammerZuMinus5EqualsKlammer5Minus5KlammerZuMinus5(): void
    {
        $this->operation = new Klammer($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn(array("(","5","-","5",")","-", "5"));
        $this->calculator->method('calculate')->willReturn("0");
        
        $this->assertSame("0-5", $this->operation->findAndCalculateTerm("(5-5)-5", (new Init())->operations()));

    }
    
    public function testTerm5MalKlammer5Minus5KlammerZuEquals5MalKlammer5Minus5KlammerZu(): void
    {
        $this->operation = new Klammer($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn(array("5", "*","(","5","-","5",")"));
        $this->calculator->method('calculate')->willReturn("0");
        
        $this->assertSame("5*0", $this->operation->findAndCalculateTerm("5*(5-5)", (new Init())->operations()));

    }
    public function testTerm5MalKlammer5MinusKlammer5Plus5KlammerZuKlammerZuEquals5MalKlammer5Minus10KlammerZuKlammerZu(): void
    {
        $this->operation = new Klammer($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn(array("5", "*","(","5","-","(","5", "+", "5", ")",")"));
        $this->calculator->method('calculate')->willReturn("(5-10)");


        $this->assertSame("5*(5-10)", $this->operation->findAndCalculateTerm("5*(5-(5+5))", (new Init())->operations()));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
   
}