<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Multiplikation;
	use Taschenrechner\Classes\Numeric;

final class MultiplikationTest extends TestCase
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
            "Term 20 * 2 equals 40" => array(array(20,"*", 2),"20*2" ,"40"),
            "Term 20 * 2 * 2 equals 40*2" => array(array(20,"*", 2,"*", 2),"40*2*2" ,"40*2"),
            "Term 20 * 4 + 2 equals 80+2" => array(array(20,"*", 4, "+", 2),"40*2+2" ,"80+2"),
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Multiplikation($this->calculator, $this->numeric);
        $this->numeric->method('concatinateNumericValues')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
   
}