<?php

class Error_view {

			private $errors = array();
			private $red = 'red';
			function __construct()
			{
				# code...
			}


			function Add_Error ($level, $text) {
				$this->errors[] = $this->$level($text);
			}

			function Return_errors() {
				return implode ("<br>", $this->errors);
			}

			function Red($text){
				return '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
  				<strong>ОШИБКА!</strong> '.$text.'
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  				</button>
				</div>
				';

			}	




}

?>