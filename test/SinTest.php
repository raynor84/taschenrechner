<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Sinus;
	use Taschenrechner\Classes\Numeric;


require_once(dirname(__FILE__)."/../vendor/autoload.php");

final class SinTest extends TestCase
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
            //"Term sin(2) equals 0.034899497" => array(array("sin(",2,")"),"sin(2)" ,"0.034899497"),
			
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Sinus($this->calculator, $this->numeric);
        $this->numeric->method('concatinateNumericValues')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->numeric = NULL;

    }
   
}