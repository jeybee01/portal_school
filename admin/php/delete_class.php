<?php 
  include '../../functions.php';
  if(!is('admin')){
  	echo "<script>window.history.back()</script>";
     	exit();
  }
  if(isset($_GET['class'])){
  	 $class = sanitize($_GET['class']);
  	 $class = filter_var($class,FILTER_VALIDATE_INT);
  	 if(!$class or $class == ''){
  	 	echo "<script>window.history.back()</script>";
     	exit();
  	 }
  	 $class = $class - 1200;
  	 $sql = "DELETE FROM `class` WHERE id = '$class'";
  	 $run = $db->query($sql);
  	 if($run){
      $_SESSION['message'] = 'Successfully Deleted Class';
      header('location:../view_class.php');
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }
  }else{
  	echo "<script>window.history.back()</script>";
     	exit();

  }


 ?>