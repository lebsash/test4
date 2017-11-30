<?php


class MainTemplate 
{
	
	function __construct()
	{
		# code...
	}

	function main_part(){
		return $this->card_container();
		
	}

	function Errors(){
		global $Messages;
		return $Messages->Return_errors();
	}

	function infos(){
		global $Messages;
		return $Messages->Return_infos();
	}
	function return_uploaded_filename(){
		global $Messages;
		return $Messages->Return_fileName();
	}

	function header()
	{
		return '
		<!doctype html>
		<html>
		<title>Тестовое задание </title>  	
    	<!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<body>';

 
	}

	function footer()
	{
		return '
		<!-- Optional JavaScript -->
    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		</body>
		</html>'; 
	}


	function getfile_form()
	{
		$max_filesize = 3*1024*1024;
		return '
		<form enctype="multipart/form-data" action="" method="POST">
  		<div class="form-group">
    	<label for="exampleFormControlFile1">Выберите файл</label>
    	<input type="hidden" name="MAX_FILE_SIZE" value="'.$max_filesize.'">
    	<input type="file" name="userfile" class="form-control-file" id="exampleFormControlFile1">
  		</div>
		<button type="submit" class="btn btn-primary">Загрузить файл</button>
		</form>';
	}






	function card_with_form(){
		return '
		<div class="card" style="min-width: 200px;">
  		<div class="card-header bg-dark text-white mb-3">
    		Файл для анализа
  		</div>
  		<div class="card-body">
    	<h4 class="card-title">Необходимо выбрать файл</h4>
    	'.$this->getfile_form().'
  		</div>
		</div>';
	}


	function gen_files_forTest() {
		global $File_gen;
		return '
		<div class="card" style="min-width: 200px;">
  		<div class="card-header bg-dark text-white mb-3">
    		Генерация теста
  		</div>
  		<div class="card-body">
    	<h4 class="card-title">Файлы для тестирования</h4>
    	<p class="card-text">Вы можете сгенерировать файл для тестирования или воспользоваться уже готовым вариантом</p>
    	
    			<p>
				<form enctype="multipart/form-data" action="" method="POST">  		
    		    <input type="hidden" name="genfile" value="big">    		
				<button type="submit" class="btn btn-outline-primary w-100" >Генерировать большой файл</button>
				</form>
				</p>

				<p>
				<form enctype="multipart/form-data" action="" method="POST">  		
    		    <input type="hidden" name="genfile" value="small">    		
				<button type="submit" class="btn btn-outline-primary w-100" >Генерировать маленький файл</button>
				</form>
				</p>

    	<p>'.$File_gen->links_to_file().'</p>
  		</div>
		</div>
		';
	}




	function get_btn_to_Process($type){


				return '
				<p class="card-text"><small class="text-muted">Файл можно исследовать данным методом</small></p>

				<form enctype="multipart/form-data" action="" method="POST">  		
    		    <input type="hidden" name="process_file" value="'.$this->return_uploaded_filename().'">    		
    		    <input type="hidden" name="process_type" value="big">    		
				<button type="submit" class="btn btn-primary" >Начать обработку</button>
				</form>
				';

				
		
	}


	function card_sel_processMethod() {
		global $Messages;

		if (!isset($_FILES['userfile'])||isset($_POST['delFile'])||(!$Messages->Get_upoad_status())) return;


		return '

  		
  		<div class="card">
    		 <div class="card-header bg-dark text-white mb-3"> ВАРИАНТ №1 </div>
    		<div class="card-body">
      		<h4 class="card-title">Обычный вариант</h4>
      		<p class="card-text">В основе метода лежит блочное чтение данных из файла, конкантенация пограничных слов в блоках,
      		обработка полученных из блоков массивов при помощи array_count_values и дальнешнее включение результата обработки в общим массив 
			данных на выходе. 
      		</p>
      		'.$this->get_btn_to_Process("big").'

    		</div>
  		</div>
  		 		
  		<div class="card">
    		<div class="card-header bg-dark text-white mb-3"> ВАРИАНТ №2 </div>
    		<div class="card-body">
      		<h4 class="card-title">Файлы громадных размеров</h4>
      		<p class="card-text">В случае работы с файлами огромных размеров можно воспользоваться данным вариантом. 
      		Считываем блоки информации из файла, производим сохранение в БД (например MySQL) 
      		при помощи запроса типа INSERT INTO t1 (a,b,c) VALUES (1,2,3) ON DUPLICATE KEY UPDATE c=c+1;
			Однако, данный метод при линейном применении очень медлительный и его использование возможно при распараллеливании
			процессов на соответствующем языке программированания. 
      		</p>
      		
    		</div>
  		</div>

		';
	}


	function card_outfile(){
		global $Messages;
		global $Params;

		if (!$Messages->Get_output_status()) return '';

		return '
		  	<div class="card">
    		<div class="card-header bg-dark text-white mb-3"> РЕЗУЛЬТАТ РАБОТЫ </div>
    		<div class="card-body">
      		<h4 class="card-title">Результат обработки</h4>
      		<p class="card-text">В результате обработки было получен файл <a href = "/'.$Params->filedir_forTest_part.'/output.txt" download >output.txt</a></p>      		
    		</div>
  		</div>
		';
	}



	function card_container(){
		return '
		<div class="container">
		 <div class="row justify-content-center"">
		 	<div class="col-6">
				<h3>ТЕСТОВОЕ ЗАДАНИЕ</h3>
		 	</div>
		 </div>
		
		<div class="card-deck">
		'.$this->card_with_form().'
		'.$this->gen_files_forTest().'
		</div>
  		
		 <div class="row">
		 <div class="col-12">
		'.$this->Errors().'
		 </div>
		</div>


		 <div class="row">
		 <div class="col-12">
		'.$this->card_outfile().'
		 </div>
		</div>

		<div class="card-deck">
		'.$this->infos().'
		'.$this->card_sel_processMethod().'
		</div>


		</div>
		';
	}

}
?>