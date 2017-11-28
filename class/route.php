<?php

//require($_SERVER["DOCUMENT_ROOT"]."/class/file.php");


	class Route
	{

			private $stp;
			private $file;
			function __construct()
			{
				$this->get_file();
	 		
			}

			function get_file(){
				if (isset($_FILES)) {
					$this->file = new MyFile;
					echo 'размер файла'.$this->get_filesize();
					$this->file_upload();
				}
				
			}

			function get_step(){
				return $_GET['step'];
			}

			function get_filesize(){
				return $this->file->FileSize;
			}

			function file_upload(){

				if ($this->file->FileSizeMB > 5 ) {
					global $Errors_messages;
					echo $Errors_messages->Add_Error("Red","Простите, для тестовой задачи слишком большой объем");
					
				}
				else  {
				global $filedir;

				$uploadfile = $filedir . basename($_FILES['userfile']['name']);
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
 				   echo "Файл корректен и был успешно загружен.\n";
 				   print_r($_FILES);
				   } else {
    				echo "Возможная атака с помощью файловой загрузки!\n";
					}
				}
			}

	}

?>