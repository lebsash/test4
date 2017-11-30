<?php

class Database {
 
  
  private $conn = false;
  private $data = array();
   
 
  public function __construct($host, $user, $pass, $base) {
    $this->conn = mysql_connect($host, $user, $pass) or die(mysql_error());
    mysql_select_db($base, $this->conn);
    mysql_query("SET NAMES 'utf8'", $this->conn);
  }
 

 
  public function query_dat($request, $data = array()) {
    $request = $this->query_process($request, $data);
    return mysql_query($request, $this->conn) or die("Cannot execute request to the database '{$request}'");

  }
 

 public function query($request) {    
    
    $result = mysql_query($request) or die("Cannot execute request to the database '{$request}'");
    $out    = mysql_fetch_assoc($result);
    return $out;
  }
 
 
 
  public function select($request, $data = array()) {
    $request = $this->query_process($request, $data);
    $query = false;
    $query = mysql_query($request, $this->conn) or die("Cannot execute request to the database '{$request}'");
    return $this->result2array($query);
  }
 
 
  /* PRIVATE FUNCTIONS */
 
  private function holders_replace($matches){
    $placeholder = $matches[2];
    if(!isset($this->data[$placeholder])) throw new Exception("No data for placeholder '{{$placeholder}}'");
    // process IN({list}) values
    if(is_array($this->data[$placeholder])){
      $data = array();
      foreach($this->data[$placeholder] as $v) $data[] = mysql_real_escape_string($v);
      $value = implode("', '", $data);
    } else {
      $value = mysql_real_escape_string($this->data[$placeholder]);
    }
    return "'{$value}'";
  }

  private function query_process($query, $data){
    $this->data = $data;
    $query = preg_replace_callback("#('?){([^}]+)}(\\1)#sUi", array($this, 'holders_replace'), $query);
    return $query;
  }
 
  private function result2array(&$query){
    $result = array();
    $i = 0;
   
    if($query === false) { return $result; }
    while($row = mysql_fetch_array($query)) {
      $result[$i] = array();
      foreach($row as $key=>$value) {
        if(!is_numeric($key)) { $result[$i][strtolower($key)] = $value; }
      }
      $i++;
    }
     return $result;
  }
 
}

?>