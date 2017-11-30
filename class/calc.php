<?php

	class Calculation {


			function __construct()
			{
				
			}


			function str_clearning($line){
				// Удаляем из строки все цифры
				// Так же избавляемся от заков препинания
				$line = preg_replace("/[^а-яёa-z\s]/iu", '', $line);

				// Корректируем регистр в строке
				$line = mb_strtolower($line);

				// Считаем повторы и сортируем результат
				$words  = explode(' ', $line);
				return $words;
			}






			// Функция для обработки больших данных
			function main_calc($filename) {
				global $Messages;
				global $Params;
				$Res_Array = array();	
				// Читаем данные из входного файла
				if (file_exists($Params->filedir.$filename)  && is_readable ($Params->filedir.$filename) ) {

						$line = '';
						$f 	  = fopen($Params->filedir.$filename, "r");

						$last_word = ''; // Крайнее слово в выборке для конкантенации при блочном чтении
						while(!feof($f)) { 
							$line  = htmlentities(fread($f, 599));						
							$words = $this->str_clearning($line);

							$words[0]  = $last_word.$words[0];
							
						

							$last_word = array_pop($words);

							$counts = array_count_values($words);
							foreach ($counts as $key => $value) {

								if (array_key_exists($key, $Res_Array)) {
									// ключ найден, увеличиваем счетчик
									$Res_Array[$key] = (int) $Res_Array[$key] + (int)$value;
								} else {
									$Res_Array[$key] = (int)$value;
								}
							}

						}

						// Отдельно необходимо обработать крайнее слово
						if (array_key_exists($last_word, $Res_Array)) {
							$Res_Array[$last_word] = $Res_Array[$last_word] + 1;
						} else {
							$Res_Array[$last_word] = 1;
						}
						arsort($Res_Array);

						//Удаляем старый итог
						if (file_exists($Params->filedir_forTest.'output.txt'))
							if (!unlink($Params->filedir_forTest.'output.txt')) {
								$Messages->Add_Error("danger"," Не могу удалить старый файл output.txt");		
							}

						// Сохраняем в итоговый файл
						$f = fopen($Params->filedir_forTest.'output.txt', "a");
							foreach ($Res_Array as $key => $val) {
								if (isset($val)&& strlen($key)>0) fwrite($f, "%".$key."% - %".$val."%"."\r\n".PHP_EOL);
							}
						unset($Res_Array);	
						fclose($f);

						// Устанавливаем статус для отображения результата
						$Messages->Set_output_status(true);

						// Удаляем файл на входе
						$File_old = new MyFile;	
						$File_old->file_delete($filename);	

						} else {
							$Messages->Add_Error("danger"," Не могу найти файл для изучения");		
							$Messages->Set_output_status(false);
						}

			}

			


		

	}

?>