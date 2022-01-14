<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Wurzel;
	use Taschenrechner\Classes\Concatinator;

    require_once "init.php";
final class WurzelTest extends TestCase
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
            "Term 2√4 equals 2" => array(array(2,"√", 4),"2√4" ,"2"),
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Wurzel($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn($concatinatedValues);
        $operations = (new Init())->operations();
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term, $operations));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
   
}