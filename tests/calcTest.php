<?php
use PHPUnit\Framework\TestCase;
require_once 'class/calc.php';
class CalculationTest extends TestCase {
	

	private $Calc;
	protected function setUp(){
		$this->Calc = new Calculation();
	}

	public function addDataProvider() {
        return array(
            array('1212,1sadsad sad %#',  array ("sadsad", "sad", "")),
            array('1212,1sadsad sa1d %#', array ("sadsad", "sad", "")),
            array('1212,1sadsad sad, %#', array ("sadsad", "sad", "")),
        );
    }


	public function addDataProviderFailure() {
        return array(
            array('1212,1sadsad sыыad %#',   array ("sadsad", "sad", "")),
            array('1212,1sadввsad sa1d %#',  array ("sadsad", "sad", "")),
            array('1212,1sadsad цу sad, %#', array ("sadsad", "sad", "")),
        );
    }


	// Тестируем метод очмстки строки
	/**
     * @dataProvider addDataProvider
     */
	function teststr_clearning_Success($dat,$expected){
		$result = $this->Calc->str_clearning($dat);
        $this->assertEquals($expected, $result); 
	}

	// Тест для примера - метод очистки строки
	/**
     * @dataProvider addDataProviderFailure
     */
	function teststr_clearning_Failure($dat,$expected){
		$result = $this->Calc->str_clearning($dat);
        $this->assertEquals($expected, $result); 
	}

}
?>