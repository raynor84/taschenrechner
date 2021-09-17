<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__)."/../vendor/autoload.php");
require_once(dirname(__FILE__)."/../operation.php");
require_once(dirname(__FILE__)."/../calculator.php");
require_once(dirname(__FILE__)."/../wurzel.php");
final class WurzelTest extends TestCase
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
    

    
    public function addTermProvider() {
        return array(
            "Term 4√2 equals 2" => array(array(4,"√", 2),"4√2" ,"2"),
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Wurzel($this->calculator, $this->numeric);
        $this->numeric->method('concatinateNumericValues')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
   
}