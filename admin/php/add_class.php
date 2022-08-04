<?php 
  include '../../functions.php';

  $_SESSION['errors'] = [];

  if(!is('admin') or !isLoggedIn()){
  	echo "<script>window.history.back()</script>";
     	exit();
  }

  if(isset($_POST)){
    $class_name = sanitize($_POST['class_name']);
       chekIfEmpty($class_name,'Class','class');
    $class_short = sanitize($_POST['class_short']);
       checkIfEmpty($class_short,'Short Name','class_short');
    $category = sanitize($_POST['category']);
    $category = filter_var($category,FILTER_VALIDATE_INT);
      checkIfEmpty($category,'Category','category');
    $sql = "INSERT INTO `class`(`name`, `short`, `category`) VALUES ('$class_name','$class_short','$category')"; 
    $db->query($sql);
     if($run){
      $_SESSION['message'] = 'Successfully added Class';
      header('location:../view_class.php');
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }
            

  }	