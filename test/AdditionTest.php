<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Addition;
	use Taschenrechner\Classes\Concatinator;


require_once(dirname(__FILE__)."/../vendor/autoload.php");

final class AdditionTest extends TestCase
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
    
    public function testTerm10Plus5Equals15(): void
    {
        $this->operation = new Addition($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn(array(10,"+",5));
        
        $this->assertSame("15", $this->operation->findAndCalculateTerm("10+5"));

    }

    
    public function addTermProvider() {
        return array(
            "Term 2 plus 20 plus 10" => array(array(2,"+", 20, "+", 10),"2+20+10" ,"22+10"),
			
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Addition($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
   
}