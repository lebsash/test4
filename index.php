<?php

//require("db_con.php");
require($_SERVER["DOCUMENT_ROOT"]."/class/view.php");
require($_SERVER["DOCUMENT_ROOT"]."/class/route.php");
require($_SERVER["DOCUMENT_ROOT"]."/class/file.php");

require($_SERVER["DOCUMENT_ROOT"]."/template/errors.php");

//require("views.php");
global  $filedir;
global $Errors_messages;
$filedir  = $_SERVER["DOCUMENT_ROOT"].'/uploads/'; 


class MainPart
{
	
	private $template;
	public  $route;

	//public $filedir;
	function __construct()
	{
		//$this->filedir  = $_SERVER["DOCUMENT_ROOT"].'/uploads/';

		$this->template = new View;
		$this->route 	= new Route;


	}



	function Get_view ()
	{
  
	return $this->template->get_html();
	}
	 

}

$Errors_messages = new Error_view;
$Main 			 = new MainPart;

echo $Main->Get_view();




/*



function route() {
	

	/*

    // Обработка первоначальной загрузки всех координат
	if ($_GET['step']=='first') { return get_all_markers(); }
	
	
    // Загрузка координат в соответствии со списком выбраных имен
	if ($_GET['step']=='all')   {
    
	if (isset($_GET['names'])) { $partstr = make_SQL_Query_ByName($_GET['names']);
                                return get_all_markers($partstr);
                                } 
	                      else { return []; }
	
	}

	// Загрузка списка имен
	if ($_GET['step']=='getname') { return get_all_names(); }

	*/

	

// }




?>