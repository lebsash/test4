<?php
use PHPUnit\Framework\TestCase;
require_once 'template/errors.php';
	
	class Error_viewTest extends TestCase {


	private $Mes;
	protected function setUp(){
		$this->Mes = new Error_view();
	}


		// Данные для тестирования

		public function addDataProviderMesStatus_Success() {
        	return array(
            	array('danger',  'ОШИБКА!'),
            	array('warning', ''),
            	array('success', 'УСПЕХ!'),
        	);
    	}


		public function addDataProviderMesStatus_Failure() {
        	return array(
            	array('danger',  'УСПЕХ!'),
            	array('warning', 'ОШИБКА!'),
            	array('success', ''),
        	);
    	}

		public function addDataProvider_output_status_Success() {
        	return array(
            	array(true, true),
            	array(false, false),
        	);
    	}

		public function addDataProvider_output_status_Failure() {
        	return array(
            	array(true, false),
            	array(false, true),
        	);
    	}


		public function addDataProvider_Set_upoad_status_Success() {
        	return array(
            	array('text.txt', 'text.txt'),
            	array('text1.txt', 'text1.txt'),
        	);
    	}

		public function addDataProvider_Set_upoad_status_Failure() {
        	return array(
            	array('text1.txt', 'text.txt'),
            	array('text.txt', 'text1.txt'),
        	);
    	}

    	/**
     	* @dataProvider addDataProviderMesStatus_Success
     	*/
		// Тестирование метода выбора типа сообщения
		function testGet_Message_status_Success ($dat,$expected){
        	$result = $this->Mes->Get_Message_status($dat);
	       	$this->assertEquals($expected, $result);
		}


    	/**
     	* @dataProvider addDataProviderMesStatus_Failure
     	*/
		// Тестирование матода выбора типа приложения (FAILURE)
		function testGet_Message_status_Failure ($dat,$expected){
        	$result = $this->Mes->Get_Message_status($dat);
	       	$this->assertEquals($expected, $result);
		}



    	/**
     	* @dataProvider addDataProvider_output_status_Success
     	*/
		// Проверяем установку статуса загрузки файла
		function testSet_output_status_Success ($dat,$expected){
			$this->Mes->Set_output_status($dat);
			$result = $this->Mes->Get_output_status($dat);
        	$this->assertEquals($expected, $result); 
		}

    
    	/**
     	* @dataProvider addDataProvider_output_status_Failure
     	*/
		// Проверяем установку статуса загрузки файла
		function testSet_output_status_Failure ($dat,$expected){
			$this->Mes->Set_output_status($dat);
			$result = $this->Mes->Get_output_status($dat);
        	$this->assertEquals($expected, $result); 
		}


    	/**
     	* @dataProvider addDataProvider_Set_upoad_status_Success
     	*/

		// Проверяем хранение имени файла
		function testSet_upoad_status_Success ($dat,$expected){		
			$this->Mes->Set_upoad_status($dat);
			$result = $this->Mes->Get_upoad_status();
        	$this->assertEquals($expected, $result); 
		}


    	/**
     	* @dataProvider addDataProvider_Set_upoad_status_Failure
     	*/

		// Проверяем хранение имени файла
		function testSet_upoad_status_Failure ($dat,$expected){		
			$this->Mes->Set_upoad_status($dat);
			$result = $this->Mes->Get_upoad_status();
        	$this->assertEquals($expected, $result); 
		}

	}


?>
