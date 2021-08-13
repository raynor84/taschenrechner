<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use \Mockery as m;
require_once(dirname(__FILE__)."/../vendor/autoload.php");
require_once(dirname(__FILE__)."/../operation.php");
require_once(dirname(__FILE__)."/../subtraktion.php");
final class OperationTest extends TestCase
{
	private $operation;
	private $numeric;
	private $calculator;
	protected function setUp(): void
    {
        $this->calculator = m::mock('Calculator');
        $this->numeric = m::mock('Numeric');
        $this->numeric->shouldReceive('concatinateNumericValues')->andReturn(array(5,"-",5), array("10", "-", "5"));

    }
    
    public function testTerm5Minus5Equals0(): void
    {
        $this->operation = new Subtraktion($this->calculator, $this->numeric);
		
        $this->assertSame("0", $this->operation->findAndCalculateTerm("5-5"));
        $this->numeric = NULL;

    }
    
        public function testTerm10Minus5Equals5(): void
    {
        $this->operation = new Subtraktion($this->calculator, $this->numeric);
		
        $this->assertSame("5", $this->operation->findAndCalculateTerm("10-5"));

    }

   
}