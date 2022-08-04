<?php 
  include '../../functions.php';

  $_SESSION['errors'] = [];

  if(!is('admin')){
  	echo "<script>window.history.back()</script>";
     	exit();
  }

  if(isset($_POST)){

  	$full_name = sanitize($_POST['full_name']);
  	  chekIfEmpty($full_name,'Name','name');
  	$email = sanitize($_POST['email']);
  	    validateEmail($email,'Email','email');
     $phone = sanitize($_POST['phone']);
       validatePhone($phone,'Phone Number','number');
     $password = password_hash($phone, PASSWORD_DEFAULT);
     $gender = sanitize($_POST['gender']);
          checkIfEmpty($gender,'Gender','gender');
     if(count($_SESSION['errors']) != 0){
     	echo "<script>window.history.back()</script>";
     	exit();
     }

     $sql = "INSERT INTO `users`( `name`, `email`, `gender`, `phone_number`, `status`, `reg_num`, `password`) VALUES ('$full_name','$email','$gender','$phone','2','','$password')";

     $run = $db->query($sql);

     if($run){
      $_SESSION['message'] = 'Successfully added Teacher';
      header('location:../view_teacher.php');
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }




  }




 ?>