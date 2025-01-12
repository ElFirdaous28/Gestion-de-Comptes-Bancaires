<?php
spl_autoload_register('myAutoloader');

function myAutoloader($calssName){
$path= __DIR__ . '/../models/';
$extension ='.php';
$fullPath= $path.$calssName.$extension;
require_once($fullPath);
}
?>