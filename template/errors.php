<?php

class Error_view {

			private $errors = array();		// Массив для гранения сообщений об ошибках/успехах
			private $inf 	= array();		// Массив для хранения информации о файлах
			public $file_status;			// Статус загруженного файла
			private $out_status;			// Статус выходного файла
			public $file_name;				// Имя загруженного файла
			function __construct()
			{
				$this->file_status = false;
				$this->out_status = false;
				$this->file_name   = '';
			}


			function Add_Error ($level, $text) {
				$this->errors[] = $this->ErrorMessage($level, $text);
			}

			function Add_infoCard($file){
				$this->inf[] = $this->InfoMessage($file);
			}

			function Add_fileName($name){
				$this->file_name = $name;
			}

			function Return_fileName(){
				return $this->file_name;
			}


			function Return_errors() {
				return implode ("<br>", $this->errors);
			}

			function Return_infos() {
				return implode ("<br>", $this->inf);
			}

			function Get_upoad_status(){
				return $this->file_status;
			}

			function Set_upoad_status($status){
				$this->file_status=$status;
			}

			function Get_output_status(){
				return $this->out_status;
			}

			function Set_output_status($status){
				$this->out_status=$status;
			}



			function Get_Message_status($level){
				switch ($level) {
					case 'danger':
							return 'ОШИБКА!';
							break;
					case 'success':
							return 'УСПЕХ';
							break;
					default:
							return '';
							break;
				}
			}

			function InfoMessage($file){
				
				return '
				<div class="card" style="max-width: 20rem;">
				<div class="card-header text-white bg-Info   mb-3">
    				Информация о файле
  				</div>
  				<div class="card-body">  			
    			<p class="card-text">


				<table class="table table-sm">
    				<tr>
      					<th scope="col">Имя файла</th>
      					<td scope="col">'.$file->Get_Filename().'</td>     
    				</tr>
    				<tr>
      					<th scope="col">Размер</th>
      					<td scope="col">'.round($file->get_FileSize_in_MB(),2).'Mb</d>     
    				</tr>
				    <tr>
      					<th scope="col">Тип файла</th>
      					<td scope="col">'.$file->Get_FileType().'</td>     
    				</tr> 
  				</table>
    			</p>'.$this->form_del_file($file).'    			
  				</div>
				</div>
				';
			}


			function ErrorMessage($level, $text){

				return '
				<div class="alert alert-'.$level.' alert-dismissible fade show" role="alert">
  				<strong>'.$this->Get_Message_status($level) .'</strong> '.$text.'
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  				</button>
				</div>
				';

			}


			function form_del_file($file) {
				return '
				<form enctype="multipart/form-data" action="" method="POST">  		
    		    <input type="hidden" name="delFile" value="'.$file->Get_Filename().'">    		
				<button type="submit" class="btn btn-primary">Удалить файл</button>
				</form>
				';

			}	




}

?>