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
     $class_id = sanitize($_POST['class_id']);
    $class_id = filter_var($class_id,FILTER_VALIDATE_INT);
      checkIfEmpty($class_id,'Class','class');   

      $sql = "SELECT id FROM class WHERE (name = '$class_name' or short = '$class_short')  and id != '$class_id'";
      $run = $db->query($sql);
      if($run->num_rows > 0){
      	$_SESSION['errors']['message'] = 'This Class Already Exist';
        echo "<script>window.history.back()</script>";
     	exit();
      }


      $sql = "UPDATE class SET name = '$class_name', short = '$short', category = '$category' WHERE id = '$id'";
     $db->query($sql);
     if($run){
      $_SESSION['message'] = 'Successfully updated Class';
      header('location:../view_class.php');
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }





}


 ?>