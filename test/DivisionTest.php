<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Division;
	use Taschenrechner\Classes\Numeric;
	
require_once(dirname(__FILE__)."/../vendor/autoload.php");

final class DivisionTest extends TestCase
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
            "Term 20 / 2 equals 10" => array(array(20,"/", 2),"20/2" ,"10"),
            "Term 20 / 2 / 2 equals 10/2" => array(array(20,"/", 2,"/", 2),"20/2/2" ,"10/2"),
            "Term 0 / 2 equals 0" => array(array(0,"/", 2),"0/2" ,"0"),
			
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Division($this->calculator, $this->numeric);
        $this->numeric->method('concatinateNumericValues')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
   
}