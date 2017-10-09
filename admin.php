<?php 
include 'autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
  $records = Record::import_file();
  include 'views/admin/table.php';
}  

elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if (isset($_POST['today'])){
  $records = Record::today();
  include 'views/admin/table.php';
  
 }
  elseif (isset($_POST['tomm'])){
    $records = Record::tomm();
    include 'views/admin/table.php';
  }
  elseif(isset($_POST['this'])){
    $records = Record::thisweek();
    include 'views/admin/table.php';
  }
  elseif(isset($_POST['next'])){
    $records = Record::nextweek();
    include 'views/admin/table.php';
  }
  elseif(isset($_POST['main'])){    
    if ($_POST['issue'] ==='pastcase') { 
      $records = Record::pastcase();
      include 'views/admin/table.php';}
  	 elseif ($_POST['issue'] ==='done') { 
       	$records = Record::donecase();
        include 'views/admin/table.php';}
     elseif ($_POST['issue'] ==='now') { 
       	$records = Record::nowcase();       
        include 'views/admin/table.php';}
  	elseif (isset($_POST['datdat'])){
      $dat = $_POST['datdat'];
    	$records = Record::certaindate($dat);
      include 'views/admin/table.php';
      }
   
  }  
   
	elseif(isset($_POST['all'])){
     $records = Record::import_file();
  	include 'views/admin/table.php';    
  }
  elseif(isset($_POST['delete'])){
    Record::delete();
  	header('Location: ' . $_SERVER['REQUEST_URI']);    
  }
  elseif (isset($_POST['do'])){      	
    	Record::done();
  		header('Location: ' . $_SERVER['REQUEST_URI']);
  	}
  }
 
     