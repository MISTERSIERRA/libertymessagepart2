<?php

function MyAutoLoader($className) 
{
    $fileName = str_replace("\\", "/", str_replace("version", "model", $className)). ".class.php";
    require_once $fileName;
}
spl_autoload_register('MyAutoLoader');

