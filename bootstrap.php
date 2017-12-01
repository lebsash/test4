<?php

function class_auto_loader($className)
{
  $parts = explode('\\', $className);
  $path = '/web/sites/test/test4/tests/' . implode('/', $parts) . '.php';

  require_once $path;
}

spl_autoload_register('my_autoload');

function my_autoload($className){
    $path = __DIR__ . "\\$className.php";
    if (file_exists($path)) require $path;
}

?>