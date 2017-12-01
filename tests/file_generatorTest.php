<?php
use PHPUnit\Framework\TestCase;
require_once 'class/settings.php';
require_once 'class/file_generator.php';
require_once 'template/errors.php';

	class File_generatorTest extends TestCase {
		
		
		public $Params;
		public $Messages;
		private $GF;

		protected function setUp(){
			$this->Params 	= new Settings;
			$this->Messages = new Error_view;
			$this->GF 		= new File_generator;
		}


		// Данные для тестирования генерации имен файлов в зависимости 
		// от требуемого типа
		public function addDataProvider_testgen_to_file_Success() {
        	return array(
            	array('small',  '/fortesting/small.txt'),
            	array('big',  '/fortesting/big.txt'),
        	);
    	}

		public function addDataProvider_testgen_to_file_Failure() {
        	return array(
            	array('small',  '/fortesting/big.txt'),
            	array('big',  '/fortesting/small.txt'),
        	);
    	}

    	
    	// Набор данных для теста генерации тестовых файлов
    	// Генерация файла big достаточно длительная!
    	public function addDataProvider_testgen_to_newfile_Success() {
        	return array(
            	array('small',  '/web/sites/test/test4/fortesting/small.txt'),
            	// array('big',  '/web/sites/test/test4/fortesting/big.txt'),
        	);
    	}
	


    	/**
     	* @dataProvider addDataProvider_testgen_to_file_Success
     	*/
		// Тестирование генератора имени файла
    	function testgen_filename_Success($dat,$expected) {
			global $Params;
			global $Messages;
			$result = $this->GF->get_filename($dat,$this->Params);
			$this->assertEquals($expected, $result);
    	}


    	/**
     	* @dataProvider addDataProvider_testgen_to_file_Failure
     	*/
		// Тестирование генератора имени файла
    	function testgen_filename_Failure($dat,$expected) {
    		global $Params;
			global $Messages;
			$result = $this->GF->get_filename($dat,$this->Params);
			$this->assertEquals($expected, $result);
    	}


    	/**
     	* @dataProvider addDataProvider_testgen_to_newfile_Success
     	*/
		// Тестирование генерации файлов для тестов
		// Занимает много времени при генерации файла big.txt
		function testgen_to_file($type, $Fname) {
			global $Params;
			global $Messages;
			$Params 	= new Settings;
			$Messages 	= new Error_view;			
			$file = $this->GF->gen_to_file($type, $Fname);
			$this->assertFileExists($Fname);
		}
		
	}

?>
