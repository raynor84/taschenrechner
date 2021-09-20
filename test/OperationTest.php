<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Subtraktion;
	use Taschenrechner\Classes\Numeric;


final class OperationTest extends TestCase
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
    
    public function testTerm5Minus5Equals0(): void
    {
        $this->numeric->method('concatinateNumericValues')->willReturn(array(5,"-",5));
        $this->operation = new Subtraktion($this->calculator, $this->numeric);

		
        $this->assertSame("0", $this->operation->findAndCalculateTerm("5-5"));

    }
    
    public function testTerm10Minus5Equals5(): void
    {
        $this->numeric->method('concatinateNumericValues')->willReturn(array(10,"-",5));
        $this->operation = new Subtraktion($this->calculator, $this->numeric);
		
        $this->assertSame("5", $this->operation->findAndCalculateTerm("10-5"));

    }

   	protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
}
