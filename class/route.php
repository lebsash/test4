<?php

/**
 * Route Class
 * Класс обработки маршрутов
 *
 * @version 0.1
 */


	class Route
	{

			private $stp;
			private $filename;
			private	$file;
			
			function __construct()
			{
				$this->get_start();
	 		
			}

			function get_start(){
				global $Messages;		
				global $File_gen;

				// Маршрут загрузки файла из формы
				if (isset($_FILES['userfile'])) {
					$this->file = new MyFile;					
					$this->filename = $this->file->file_upload();
				}

				// Маршрут генерации файла для тестирования
				if (isset($_POST['genfile'])){
						$File_gen->gen_to_file($_GET['genfile']);					
				}


				// Маршрут удаления файла
				if (isset($_POST['delFile'])) {
						$this->file = new MyFile;	
						$this->file->file_delete($_POST['delFile']);			
				}


				// Маршрут для работы с файлом
				if (isset($_POST['process_type']) && isset($_POST['process_file'])) {
						$newCalc = new Calculation;
					     if ($_POST['process_type'] == 'big') {$newCalc->main_calc($_POST['process_file']);}
									   else $Messages->Add_Error("danger","Неверный параметр обработки данных");
				}






				
			}

	}

?>