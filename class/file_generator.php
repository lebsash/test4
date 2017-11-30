<?php

	class File_generator {

			
			private $str_characters;
			function __construct()
			{
				$this->str_characters = array (0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			}

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

			function get_filename($type){
				global $filedir_forTest;
				global $Params;

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

			function links_to_file(){
				//global $filedir_forTest_part;
				//global $filedir_forTest;
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


			function del_file($filename){
				global $Messages;
				if(file_exists($filename)) {					
					if (!unlink($filename)) {
						$Messages->Add_Error("danger","Ошибка удаления файла для теста");					
					}
				}
			}


			function gen_to_file($type) {
				global $Messages;
				$strings_count = $this->get_stringscount_byType($type);
				$new_filename  = $this->get_filename($type);
				
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