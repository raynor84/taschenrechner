<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Potenz;
	use Taschenrechner\Classes\Numeric;

final class PotenzTest extends TestCase
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
            "Term 20 ^ 2 equals 400" => array(array(20,"^", 2),"20^2" ,"400"),
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Potenz($this->calculator, $this->numeric);
        $this->numeric->method('concatinateNumericValues')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
   
}