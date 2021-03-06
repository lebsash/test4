<?php
/**
 * View Class
 * Класс сборки шаблона
 *
 * @version 0.1
 */

require_once ($_SERVER["DOCUMENT_ROOT"]."/template/temp.php");

class View 
{
	
	private $header;
	private $footer;
	private $tmp;
	
	function __construct()
	{
	 $this->tmp    = new MainTemplate;
	
	}
	
	function get_html()
   {
	return $this->tmp->header().$this->tmp->main_part().$this->tmp->footer();
   }

}

?>