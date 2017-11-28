<?php

	class MyFile
	{

			
			private $FileName;
			public $FileSize;
			public $FileSizeMB;
			public $FileSizeGB;
			function __construct()
			{
				
	 			$this->FileName   = $_FILES['userfile']['name'];
	 			$this->FileSize   = $_FILES['userfile']['size'];
	 			$this->FileSizeMB = $this->Size_in_MB($_FILES['userfile']['size']);
	 			$this->FileSizeGB = $this->Size_in_MB($_FILES['userfile']['size']);

	 			$this->FileSize_control();
			}

			function FileSize_control(){
				if ($this->Size_in_GB($this->FileSize) < 2) {
					var_dump($this->Size_in_GB($this->FileSize));
				} else { echo "too much";}

			}

			function Size_in_GB ($size){
				return (($size/1024)/1024)/1024;
			}

			function Size_in_MB ($size){
				return (($size/1024)/1024);
			}
			

			

	}

	

?>