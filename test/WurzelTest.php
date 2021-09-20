<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Wurzel;
	use Taschenrechner\Classes\Numeric;

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
            "Term 2√4 equals 2" => array(array(2,"√", 4),"2√4" ,"2"),
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