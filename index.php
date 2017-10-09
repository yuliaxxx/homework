<?php 
include 'autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    
    
  $record = new record;  
  include 'views/index1.php';


}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
{
$record = new record($_POST);
 
 
  if($record->save()){
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
  }

  
  else
  {
    include 'views/index1.php';
  }
}