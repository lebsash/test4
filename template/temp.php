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
		global $Errors_messages;
		return $Errors_messages->Return_errors();
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
		return '<form enctype="multipart/form-data" action="" method="POST">
  		<div class="form-group">
    	<label for="exampleFormControlFile1">Выберите файл</label>
    	<input type="file" name="userfile" class="form-control-file" id="exampleFormControlFile1">
  		</div>
		<button type="submit" class="btn btn-primary">Расчет повторов в файле</button>
		</form>';
	}

	function card_with_form(){
		return '<div class="card">
  		<div class="card-header">
    		Файл для анализа
  		</div>
  		<div class="card-body">
    	<h4 class="card-title">Необходимо выбрать файл</h4>
    	'.$this->getfile_form().'
  		</div>
		</div>';
	}

	function card_container(){
		return '
		<div class="container">
		 <div class="row justify-content-center""><div class="col-6">
			<h3>ТЕСТОВОЕ ЗАДАНИЕ</h3>
		 </div></div>
		 <div class="row">
		 <div class="col-12">
		'.$this->card_with_form().'
		</div>
		</div>
		 <div class="row">
		 <div class="col-12">
		'.$this->Errors().'
		</div>
		</div>

		</div>
		';
	}
}

?>