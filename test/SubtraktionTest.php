<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Subtraktion;
	use Taschenrechner\Classes\Concatinator;

final class SubtraktionTest extends TestCase
{
	private $operation;
	private $concatinator;
	private $calculator;
    private $stub;
	protected function setUp(): void
    {
        $this->calculator = $this->createMock(Calculator::class);
        $this->concatinator = $this->createMock(Concatinator::class);
    }
  
    public function testTerm20Minus5Minus5Equals20Minus5(): void
    {
        $this->operation = new Subtraktion($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn(array(25,"-",5, "-", 5));
        
        $this->assertSame("20-5", $this->operation->findAndCalculateTerm("25-5-5"));

    }
    
        public function testTerm10Minus5Plus5Equals5Plus5(): void
    {
        $this->operation = new Subtraktion($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn(array(10,"-",5, "+", 5));

		
        $this->assertSame("5+5", $this->operation->findAndCalculateTerm("10-5+5"));

    }


    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
   
}