<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Subtraktion;
	use Taschenrechner\Classes\Concatinator;


final class OperationTest extends TestCase
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
    
    public function testTerm5Minus5Equals0(): void
    {
        $this->concatinator->method('concatinateArray')->willReturn(array(5,"-",5));
        $this->operation = new Subtraktion($this->calculator, $this->concatinator);

		
        $this->assertSame("0", $this->operation->findAndCalculateTerm("5-5"));

    }
    
    public function testTerm10Minus5Equals5(): void
    {
        $this->concatinator->method('concatinateArray')->willReturn(array(10,"-",5));
        $this->operation = new Subtraktion($this->calculator, $this->concatinator);
		
        $this->assertSame("5", $this->operation->findAndCalculateTerm("10-5"));

    }

   	protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
}
