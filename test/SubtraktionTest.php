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
	protected function setUp(): void
    {
        $this->calculator = m::mock('Calculator');
        $this->numeric = m::mock('Numeric');

    }
    
    public function testTerm5Minus5Equals0(): void
    {
        $this->operation = new Subtraktion($this->calculator, $this->numeric);
        
        $this->numeric->shouldReceive('concatinateNumericValues')->andReturn(array(25,"-",5, "-", 5));
        $this->assertSame("20-5", $this->operation->findAndCalculateTerm("25-5-5"));
        $this->numeric = NULL;

    }
    
        public function testTerm10Minus5Equals5(): void
    {
        $this->operation = new Subtraktion($this->calculator, $this->numeric);
        $this->numeric->shouldReceive('concatinateNumericValues')->andReturn(array(10,"-",5, "+", 5));
		
        $this->assertSame("5+5", $this->operation->findAndCalculateTerm("10-5+5"));

    }


    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
   
}