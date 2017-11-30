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

		global $Params;	
		global $route;
		$dop_text = 'Файл можно исследовать данным методом';
		$disbut	  = '';

		switch ($type) {


			case 'big':
					if (($_FILES['userfile']['size']/1024)/1024 > (float)$Params->filesize_max_for2stVariant) {
					$dop_text = 'Из-за размера НЕ рекомендуется исследовать файл данным методом';
					$disbut	  = 'disabled';
					}

				return '
				<p class="card-text"><small class="text-muted">'.$dop_text.'</small></p>

				<form enctype="multipart/form-data" action="" method="POST">  		
    		    <input type="hidden" name="process_file" value="'.$this->return_uploaded_filename().'">    		
    		    <input type="hidden" name="process_type" value="big">    		
				<button type="submit" class="btn btn-primary" '.$disbut.'>Начать обработку</button>
				</form>
				';

				//break;
			default:
					if (($_FILES['userfile']['size']/1024)/1024 > (float)$Params->filesize_max_for1stVariant) {
					$dop_text = 'Из-за размера НЕ рекомендуется исследовать файл данным методом';
					$disbut	  = 'disabled';
					}
				return '
				<p class="card-text"><small class="text-muted">'.$dop_text.'</small></p>

				<form enctype="multipart/form-data" action="" method="POST">  		
    		    <input type="hidden" name="process_file" value="'.$this->return_uploaded_filename().'">    		
    		    <input type="hidden" name="process_type" value="small">    		
				<button type="submit" class="btn btn-primary" '.$disbut.'>Начать обработку</button>
				</form>
				';
				
		}
	}


	function card_sel_processMethod() {
		global $Messages;

		if (!isset($_FILES['userfile'])||isset($_POST['delFile'])||(!$Messages->Get_upoad_status())) return;


		return '

  		
  		<div class="card">
    		 <div class="card-header bg-dark text-white mb-3"> ВАРИАНТ №1 </div>
    		<div class="card-body">
      		<h4 class="card-title">Файлы небольшого размера</h4>
      		<p class="card-text">Для обработки файлов небольшого размера можно непосредственно загрузить все слова из файла в массив, и обработать с помощью array_count_values</p>
      		'.$this->get_btn_to_Process("small").'

    		</div>
  		</div>
  		 		
  		<div class="card">
    		<div class="card-header bg-dark text-white mb-3"> ВАРИАНТ №2 </div>
    		<div class="card-body">
      		<h4 class="card-title">Файлы большого размера</h4>
      		<p class="card-text">В случае работы с файлами большого размера необходимо воспользоваться данным вариантом. Считываем боки из файла, сохраняем в БД (например MySQL) 
      		при помощи запроса типа INSERT INTO t1 (a,b,c) VALUES (1,2,3) ON DUPLICATE KEY UPDATE c=c+1;</p>
      		'.$this->get_btn_to_Process("big").'
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