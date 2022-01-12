<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Cosinus;
	use Taschenrechner\Classes\Concatinator;


require_once(dirname(__FILE__)."/../vendor/autoload.php");

final class CosTest extends TestCase
{
	private $operation;
	private $concatinator;
	private $calculator;
	protected function setUp(): void
    {
        $this->calculator = $this->createMock(Calculator::class);
        $this->concatinator = $this->createMock(Concatinator::class);
    }
    

    
    public function addTermProvider() {
        return array(
            "Term cos(2) equals 0.034899496702501" => array(array("cos(",2,")"),"cos(2)" ,"0.9993908270191"),
            "Term cos(4) equals 0.99756405025982" => array(array("cos(",4,")"),"cos(4)" ,"0.99756405025982"),
            "Term 2*cos(4) equals 2*0.99756405025982" => array(array("2","*","cos(",4,")"),"2*cos(4)" ,"2*0.99756405025982"),
			"Term cos(4)*2 equals 0.99756405025982*2" => array(array("cos(",4,")","*","2"),"cos(4)*2" ,"0.99756405025982*2"),
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Cosinus($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
   
}