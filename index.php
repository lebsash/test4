<?php
require($_SERVER["DOCUMENT_ROOT"]."/class/settings.php");			// Класс для хранения настроек (констант)
require($_SERVER["DOCUMENT_ROOT"]."/class/view.php");				// Класс работы с отображением данных
require($_SERVER["DOCUMENT_ROOT"]."/class/route.php");				// Класс для маршрутизации
require($_SERVER["DOCUMENT_ROOT"]."/class/file.php");				// Класс для работы с файлом
require($_SERVER["DOCUMENT_ROOT"]."/class/file_generator.php");		// Класс генерации файлов для тестирования
require($_SERVER["DOCUMENT_ROOT"]."/class/calc.php");				// Класс расчета повторных слов в файле
require($_SERVER["DOCUMENT_ROOT"]."/template/errors.php");			// Класс для отображения сообщений


global  $Params;	
global  $Messages;
global  $File_gen;



class MainPart
{
	
	private $template;
	private $route;

	function __construct(){
	
		$this->template = new View;
		$this->route 	= new Route;
	}



	function Get_view () {
		return $this->template->get_html();
	}
	 

}

$Params   = new Settings;
$Messages = new Error_view;			// Отображение сообщений
$File_gen = new File_generator;     // Генерация файлов для тестирования
$Main 	  = new MainPart;

echo $Main->Get_view();

?>