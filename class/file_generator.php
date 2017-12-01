<?php

/**
 * File_generator Class
 * Класс генерации файлов для тестирования
 *
 * @version 0.1
 */

	class File_generator {

			
			private $str_characters;
			function __construct()
			{
				$this->str_characters = array (0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			}

			
			// Метод возвращает слово строку заданой длины
			function random_string($length) {
	
				if (!is_int($length) || $length < 0){
        			return false;
    			}
    			
    			$characters_length = count($this->str_characters) - 1;
    			$string = '';
    			for ($i = $length; $i > 0; $i--) {
        			$string .= $this->str_characters[mt_rand(0, $characters_length)];
    			}
    			return $string;
			}

			// Метод генерирует строки из случайных слов
			function block_generator($length) {
				if (!is_int($length) || $length < 0){
        			return false;
    			}
				$str_array	= array ();

    			for ($i = $length; $i > 0; $i--) {
    				$str_array[] = $this->random_string(mt_rand(5,10));
    			}

    			return implode(' ', $str_array);

			}


			// Метод для получения случайного количества строк
			// в зависимости от типа генерируемого файла
			function get_stringscount_byType ($type = null){
				switch ($type) {
					case 'small':
						return mt_rand(50,100); // Количество строк в маленьком файле
						break;
					case 'big':
						return mt_rand(10000,50000); // Количество строк в файле
						break;
					default:
						return mt_rand(50,100); // Количество строк в маленьком файле
						break;
				}
			}

			// Возвращаем имя файла в зависимости от типа генерации
			function get_filename($type, $TestParam = null){
				global $filedir_forTest;
				global $Params;
				if (!isset($Params)) {$Params = $TestParam;}

				switch ($type) {
					case 'small':
						return $Params->filedir_forTest.'small.txt';
						break;
					case 'big':
						return $Params->filedir_forTest.'big.txt';
						break;
					default:
						return $Params->filedir_forTest.'small.txt';
						break;
				}
			}

			// Метод, формирующий ссылки на файлы в зависимости от их наличия
			function links_to_file(){

				global $Params;

				$retlink 	 = '';
				$first_exist = false;
				if(file_exists($Params->filedir_forTest.'small.txt')) {
					$retlink .= "<a href = '/".$Params->filedir_forTest_part."/small.txt' download>small.txt</a>";
					$first_exist = true;
				}
				if(file_exists($Params->filedir_forTest.'big.txt')) {
					
					if ($first_exist) {
						$retlink .=" и ";
					}

					$retlink .= "<a href = '/".$Params->filedir_forTest_part."/big.txt' download>big.txt</a>";
					$first_exist = true;
				}

				return (($first_exist) ? 'Скачать готовые файлы: '.$retlink : '');
			}


			// Метод удаления тестового файла
			function del_file($filename){
				global $Messages;
				if(file_exists($filename)) {					
					if (!unlink($filename)) {
						$Messages->Add_Error("danger","Ошибка удаления файла для теста");					
					}
				}
			}

			// Метод генерации тестового файла
			function gen_to_file($type, $Test_new_filename = null) {
				global $Messages;
				$strings_count = $this->get_stringscount_byType($type);
				if (strlen($Test_new_filename) == null){				
				$new_filename  = $this->get_filename($type);
				}

				if (strlen($Test_new_filename) > 10){$new_filename = $Test_new_filename;}
				
				$res = $this->del_file($new_filename);	 // Удаляем файл, если он существует

				for ($i = $strings_count; $i > 0; $i--) {
    					$fp = fopen( $new_filename, "a+" );
						fwrite($fp, "\n".$this->block_generator(mt_rand(50,100)));
						fclose($fp);
    			}
    			$Messages->Add_Error("success","Файл успешно создан");


					
			}

	}

?>