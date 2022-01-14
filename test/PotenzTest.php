<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
    require_once "init.php";
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Potenz;
	use Taschenrechner\Classes\Concatinator;

final class PotenzTest extends TestCase
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
        $this->operation = new Potenz($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term, (new Init())->operations()));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
   
}