<?php

class Settings {

			public $root;


			public $filedir_uploads_part = 'uploads';    // Наименование каталога, в который сохраняются файлы при загрузке
			public $filedir_forTest_part = 'fortesting'; // Наименование каталога, в который сохраняются файлы для тестов

			public $filesize_max_for1stVariant = 3;    // Максимальный размер файла для обработки по 1му варианту (в Мб)
			public $filesize_max_for2stVariant = 100;  // Максимальный размер файла для обработки по 2му варианту (в Мб)


			// Параметры доступа к БД
			public $dbhost = 'localhost';
			public $dbuser = 'test4'; 
			public $dbpass = 'AzeFNyqNuZQGaB4x'; 
			public $dbbase = 'test4';


			public $filedir;           // Путь до каталога загрузок файлов			
			public $filedir_forTest;   // Путь до каталога тестовых файлов


			function __construct()
			{
				$this->root    = $_SERVER["DOCUMENT_ROOT"];
				$this->filedir = $_SERVER["DOCUMENT_ROOT"].'/'.$this->filedir_uploads_part.'/';

				$this->filedir_forTest  = $_SERVER["DOCUMENT_ROOT"].'/'.$this->filedir_forTest_part.'/'; 
			}



}

?>