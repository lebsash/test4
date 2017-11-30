<?php

	class MyFile
	{

			
			private $FileName;
			private $FileSize;
			private $FileType;
			private $FileSizeMB;
			private $FileSizeGB;
			function __construct()
			{
				
	 			$this->FileName   = $_FILES['userfile']['name'];
	 			$this->FileSize   = $_FILES['userfile']['size'];
	 			$this->FileType   = $_FILES['userfile']['type'];
	 			$this->FileSizeMB = $this->Size_in_MB($_FILES['userfile']['size']);
	 			$this->FileSizeGB = $this->Size_in_MB($_FILES['userfile']['size']);

	 			$this->FileSize_control();
			}

			function FileSize_control(){
				if ( !($this->Size_in_GB($this->FileSize) < 2)){
					$Messages->Set_upoad_status(false);
					$Messages->Add_Error("danger","Простите, для тестовой задачи слишком большой объем");
				}

			}

			function Get_Filename(){
				return $this->FileName;
			}

			function Get_FileType(){
				return $this->FileType;
			}

			function Get_FileSize(){
				return $this->FileSize;
			}


			function Size_in_GB ($size){
				return (($size/1024)/1024)/1024;
			}

			function Size_in_MB ($size){
				return (($size/1024)/1024);
			}

			function get_FileSize_in_MB(){
				return $this->FileSizeMB;
			}


			function file_delete($filename){
				global $Messages;
				global $Params;

					
				if(file_exists($Params->filedir.$filename)) {					
					if (unlink($Params->filedir.$filename)) {
						$Messages->Add_Error("success","Файл успешно удален");
					} else {
						$Messages->Add_Error("danger","Ошибка удаления файла");
					}
					
				} else {
					$Messages->Add_Error("warning","Файл не существует");
				}				

			}

			function file_upload(){
				global $Messages;

				if ($this->FileSizeMB > 5 ) {
					$Messages->Set_upoad_status(false);
					$Messages->Add_Error("danger","Простите, для тестовой задачи слишком большой объем");
					return NULL;
				}
				else  {	
					global $Params;
					$uploadfile = $Params->filedir . basename($_FILES['userfile']['name']);
					if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {				   

 				   			$Messages->Add_Error("success","Файл успешно загружен");
 				   			$Messages->Add_infoCard($this);
 				   			$Messages->Add_fileName($this->FileName);
 				   			$Messages->Set_upoad_status(true);
 				   			return $this->FileName;

				    } else {					  	
				  			$Messages->Add_Error("danger","Проблемы при загрузке файла. Возможно, Ваш файл слишком большой для нашего сервера.");
				  			return NULL;
  
					}
				}
			}
			

			

	}

	

?>