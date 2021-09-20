<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__)."/init.php");


final class CalculateTest extends TestCase
{
	private $calculator;
	protected function setUp(): void
    {
        $init = new Init();
        $this->calculator = $init->calculator();
    }

    public function testTermFivePlusFiveEqualsTen(): void
    {
		
        $this->assertSame($this->calculator->calculate("5+5"), "10");

    }

    public function testTermTenTimesTwoEqualsTwenty(): void
    {
		
        $this->assertSame("20", $this->calculator->calculate("10*2"));

    }
    public function testTermTenPlusTwoWithParenthesesTimesTwo(): void
    {
        $this->assertSame("24", $this->calculator->calculate("(10+2)*2"));

    }
	
	public function testTermTwoTimesParantesesTenPlusTwo():void {
		$this->assertSame("24", $this->calculator->calculate("2*(10+2)"));

	}
	
	public function testTermParantesesTwoTimesParanthesesTenPlusTwo():void {
		$this->assertSame("24", $this->calculator->calculate("(2*(10+2))"));

	}	
	public function testTermParantesesTwoTimesParanthesesTenPlusTwoCloseParantesesPlusTen():void {
		$this->assertSame("34", $this->calculator->calculate("(2*(10+2)+10)"));

	}	
	public function testTermParantesesTwoTimesParanthesesTenPlusTwoCloseParantesesPlusTenCloseParanthesesMinusTwelve():void {
		$this->assertSame("22", $this->calculator->calculate("(2*(10+2)+10)-12"));
	}	
	public function testTermParantesesTwoTimesParanthesesTenDivideTwoCloseParantesesPlusTenCloseParanthesesMinusTwelve():void {
		$this->assertSame("8", $this->calculator->calculate("(2*(10/2)+10)-12"));
	}	
	public function testTermTwoPotenceTwo():void {
		$this->assertSame("4", $this->calculator->calculate("2^2"));
	}	
	public function testTermParantheseTwoTimesThreeCloseParanthesePotenceTwo():void {
		$this->assertSame("36", $this->calculator->calculate("(2*3)^2"));
	}	
	public function testTermParantheseTwoPlusTwoCloseParanthesePotenceThree():void {
		$this->assertSame("64", $this->calculator->calculate("(2+2)^3"));
	}	
	public function testTermSquareRootSixteen():void {
		$this->assertSame("4", $this->calculator->calculate("2√16"));
	}	
	public function testTermPotenceHalfSixteen():void {
		$this->assertSame("4", $this->calculator->calculate("16^(1/2)"));
	}

    public function addTermProvider() {
        return array(
            "Term Paranthese 2 times Paranthese 10 plus 2 equals 24" => array("(2*(10+2))","24"),
			"Term minus Paranthese 2 equals -2" => array("-(2)", "-2"),
			"Term minus Paranthese 2 equals -2" => array("(-2)", "-2"),
			"Term minus Paranthese 2 equals -2" => array("(-2*4)", "-8"),
			"Term minus Paranthese 2 equals -2" => array("(-2*-4)", "8"),
			"Term minus Paranthese 2 equals -2" => array("-(2*-4)", "8"),
			"Term minus minus 2 equals 2" => array("--2", "2"),
			"Term 2 minus minus 2 equals 4" => array("2--2", "4"),
			"Term 4 sqrt equals 2" => array("√4", "2"),
			"Term 27 sqrt 3 equals 3" => array("3√27", "3"),
			"Term -2 equals -2" => array("-2", "-2"),
			"Term +2 equals 2" => array("+2", "2"),
			"Term /2 equals 0" => array("/2", "0"),
			
        );
    }

    /**
     * @dataProvider addTermProvider
     */
    public function testTerm($term, $expected)
    {
        $result = $this->calculator->calculate($term);
        $this->assertEquals($expected, $result);
    }
	
	
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Division by Zero
	 */
	public function testTermTwoDivisionByZeroThrowsException() {
		
		$this->expectException("Exception");
        $this->expectExceptionMessage("Division by Zero");
		$this->calculator->calculate("2/0");
	}
	public function testTermEmptyDivisionByZeroThrowsException() {
		
		$this->expectException("Exception");
        $this->expectExceptionMessage("Division by Zero");
		$this->calculator->calculate("/0");
	}	

	protected function tearDown(): void {
    	$this->calculator=NULL;
	}
}