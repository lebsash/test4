<?php

/**
 * Message's Class
 * Класс для отображения сообщений об ошибках, хранения информации о файле и его статусе
 *
 * @version 0.1
 */

class Error_view {

			private $errors = array();		// Массив для хранения сообщений об ошибках/успехах
			private $inf 	= array();		// Массив для хранения информации о файлах
			public  $file_status;			// Статус загруженного файла
			private $out_status;			// Статус выходного файла
			public  $file_name;				// Имя загруженного файла
			function __construct()
			{
				$this->file_status = false;
				$this->out_status = false;
				$this->file_name   = '';
			}

			// Добавляем ошибку в массив
			function Add_Error ($level, $text) {
				$this->errors[] = $this->ErrorMessage($level, $text);
			}

			// Добавляем информацию о файле в массив
			function Add_infoCard($file){
				$this->inf[] = $this->InfoMessage($file);
			}

			// Сохраняем имя файла (входящий)
			function Add_fileName($name){
				$this->file_name = $name;
			}


			// Возвращаем имя входящего файла
			function Return_fileName(){
				return $this->file_name;
			}

			// Возвращяем список ошибок для отображения
			function Return_errors() {
				return implode ("<br>", $this->errors);
			}

			// Возвращаем информацию о файлах для отображения
			function Return_infos() {
				return implode ("<br>", $this->inf);
			}

			// Возвращаем статус загрузки входящего файла
			function Get_upoad_status(){
				return $this->file_status;
			}

			// Устанавливаем статус загрузки входящего файла
			function Set_upoad_status($status){
				$this->file_status=$status;
			}

			// Возвращаем статус готовности исходящего файла
			function Get_output_status(){
				return $this->out_status;
			}

			// Устанавливаем статус готовности исходящего файла
			function Set_output_status($status){
				$this->out_status=$status;
			}


			// Устанавливаем статус сообщения об ошибке
			function Get_Message_status($level){
				switch ($level) {
					case 'danger':
							return 'ОШИБКА!';
							break;				
					case 'success':
							return 'УСПЕХ!';
							break;
					default:
							return '';
							break;
				}
			}


			// Отображение информации о файле
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


			// Отображение ошибки
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

			// Отображение кнопки для удаления файоа
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