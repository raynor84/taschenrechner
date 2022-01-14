<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Tan;
	use Taschenrechner\Classes\Concatinator;
    require_once "init.php";

require_once(dirname(__FILE__)."/../vendor/autoload.php");

final class TanTest extends TestCase
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
            "Term tan(2) equals 0.034899496702501" => array(array("tan(",2,")"),"tan(2)" ,"0.034920769491748"),
            "Term tan(4) equals 0.069756473744125" => array(array("tan(",4,")"),"tan(4)" ,"0.06992681194351"),
            "Term 2*tan(4) equals 2*0.069756473744125" => array(array("2","*","tan(",4,")"),"2*tan(4)" ,"2*0.06992681194351"),
			"Term tan(4)*2 equals 0.069756473744125*2" => array(array("tan(",4,")","*","2"),"tan(4)*2" ,"0.06992681194351*2"),
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($concatinatedValues, $term, $expected)
    {
        $this->operation = new Tan($this->calculator, $this->concatinator);
        $this->concatinator->method('concatinateArray')->willReturn($concatinatedValues);
        
        $this->assertSame($expected, $this->operation->findAndCalculateTerm($term, (new Init())->operations()));

    }

    protected function tearDown(): void
    {
        $this->calculator = NULL;
        $this->concatinator = NULL;

    }
   
}