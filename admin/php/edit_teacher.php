<?php 
  include '../../functions.php';

  $_SESSION['errors'] = [];

  if(!is('admin')){
  	echo "<script>window.history.back()</script>";
     	exit();
  }

  if(isset($_POST)){

      $user = sanitize($_POST['user']);
      $user = filter_var($user,FILTER_VALIDATE_INT);
     if(!$user or $user == ''){
      echo "<script>window.history.back()</script>";
      exit();
     }
     $user = $user - 1200;

  	$full_name = sanitize($_POST['full_name']);
  	  chekIfEmpty($full_name,'Name','name');
  	$email = sanitize($_POST['email']);
  	    validateEmail($email,'Email','email',$user);
     $phone = sanitize($_POST['phone']);
       validatePhone($phone,'Phone Number','number',$user);
     $gender = sanitize($_POST['gender']);
          checkIfEmpty($gender,'Gender','gender');
     if(count($_SESSION['errors']) != 0){
     	echo "<script>window.history.back()</script>";
     	exit();
     }

   

     $sql = "UPDATE users SET name = '$full_name',email = '$email',phone_number = '$phone',gender = '$gender' WHERE id = '$user' AND status =  '2'";
     $run = $db->query($sql);
     if($run){
      $_SESSION['message'] = 'Successfully updated Teacher';
      header('location:../view_teacher.php');
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }




  }




 ?>