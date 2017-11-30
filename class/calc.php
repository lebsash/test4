<?php

	class Calculation {


			function __construct()
			{
				
			}


			// Функция для обработки небольших файлов
			// Считает повторы слов в файле без учета регистра и цифр, сортирует массив с результатом
			function easy_calc($filename) {

						global $Params;
						global $Messages;

						$line = '';

						// Читаем данные из входного файла
						if (file_exists($Params->filedir.$filename)) {

						$f = fopen($Params->filedir.$filename, "r");
						while(!feof($f)) { 
							$line .= 	fgets($f);						  					   
						}
						fclose($f);

						// Удаляем из строки все цифры
						$line = preg_replace("/[0-9]{1}/", "", $line); 

						// Корректируем регистр в строке
						$line = mb_strtolower($line);

						// Считаем повторы и сортируем результат
						$words  = explode(' ', $line);
						$counts = array_count_values($words);

						arsort($counts);

						//Удаляем старый итог
						if (file_exists($Params->filedir_forTest.'output.txt'))
							if (!unlink($Params->filedir_forTest.'output.txt')) {
								$Messages->Add_Error("danger"," Не могу удалить старый файл output.txt");		
							}


						// Сохраняем в итоговый файл
						$f = fopen($Params->filedir_forTest.'output.txt', "a");
							foreach ($counts as $key => $val) {
								if (isset($val)&& strlen($key)>0) fwrite($f, "%".$key."% - %".$val."%"."\r\n".PHP_EOL);
							}

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

			// Функция для обработки больших данных
			function full_calc($filename) {
				global $Messages;
				global $Params;

				$db = new Database($Params->dbhost, $Params->dbuser, $Params->dbpass, $Params->dbbase);

				$sql = 'SHOW TABLES LIKE "test1"';			
				$result = $db->query($sql);
				
				if ($result){
					$res = $db->query('ALTER TABLE test1');

				} else {

				// Создаем таблицу
				$sql = "CREATE TABLE test1( ".
       				   "Col INT NOT NULL, ".
       				   "Ntext VARCHAR(250) NOT NULL, ".       				   
       				   "PRIMARY KEY ( NText (250) ) ); ";
				$result = $db->query($sql);				
				}

				// Чтение блоков из файла с размещением в БД

				// Выборка из БД

				// Отдаем результат



			}

	}

?>