<?php 
  include '../../functions.php';
  if(!is('admin')){
  	echo "<script>window.history.back()</script>";
     	exit();
  }
  if(isset($_GET['user'])){
  	 $user = sanitize($_GET['user']);
  	 $user = filter_var($user,FILTER_VALIDATE_INT);
  	 if(!$user or $user == ''){
  	 	echo "<script>window.history.back()</script>";
     	exit();
  	 }
  	 $user = $user - 1200;
  	 $sql = "DELETE FROM `users` WHERE id = '$user' AND status  = '2'";
  	 $run = $db->query($sql);
  	 if($run){
      $_SESSION['message'] = 'Successfully Deleted Teacher';
      header('location:../view_teacher.php');
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