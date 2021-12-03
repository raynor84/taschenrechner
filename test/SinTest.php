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
	protected function setUp(): void
    {
        $this->calculator = $this->createMock(Calculator::class);
        $this->numeric = $this->createMock(Numeric::class);
    }
    

    
    public function addTermProvider() {
        return array(
            "Term sin(2) equals 0.034899496702501" => array(array("sin(",2,")"),"sin(2)" ,"0.034899496702501"),
            "Term sin(4) equals 0.069756473744125" => array(array("sin(",4,")"),"sin(4)" ,"0.069756473744125"),
            "Term 2*sin(4) equals 2*0.069756473744125" => array(array("2","*","sin(",4,")"),"2*sin(4)" ,"2*0.069756473744125"),
			"Term sin(4)*2 equals 0.069756473744125*2" => array(array("sin(",4,")","*","2"),"sin(4)*2" ,"0.069756473744125*2"),
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