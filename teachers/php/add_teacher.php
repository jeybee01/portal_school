<?php
 include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
     echo "<script>window.location.href='../index.php'</script>";
     exit();
  }
  $user_id = getId();

   if(isset($_POST)){
       $_SESSION['errors'] = [];
  	$firstname= sanitize($_POST['fullname']);
  	  checkIfEmpty($firstname,'Full Name','fullname');
   $email = sanitize($_POST['email']);
  	    validateEmail($email,'Email','email');
   $phone = sanitize($_POST['phone']);
       validatePhone($phone,'Phone Number','number');
   $gender = sanitize($_POST['gender']);
   $qualification = sanitize($_POST['qualification']);
     checkIfEmpty($qualification,'Qualification','qualification');
   $state = sanitize($_POST['state']);
    checkIfEmpty($state,'State','state');  
     $id_num = sanitize($_POST['id_number']);
    checkIfEmpty($id_num,'Id Number','id_number');   
  $password = password_hash($phone, PASSWORD_DEFAULT);  
     
     if($gender != '1' and $gender != '2'){
       $_SESSION['errors']['gender'] = 'Enter valid gender';
     }  
   
      $sql = "SELECT id FROM users WHERE reg_num = '$id_num'";
      $run = $db->query($sql);
      if($run->num_rows > 0){
         $_SESSION['errors']['id_number'] = 'This id number already exist';
      }

         
      
     if(count($_SESSION['errors']) != 0){
     	echo "<script>window.history.back()</script>";
     	exit();
     }


     $sql = "INSERT INTO `users`( `name`, `email`, `gender`, `phone_number`, `pic`, `type`, `status`, `reg_num`, `password`, `qualification`, `state`, `user_id`) VALUES ('$firstname','$email','$gender','$phone','','1','1','$id_num','$password','$qualification','$state','$user_id')";

     $run = $db->query($sql);

          
     if($run){
   

     	   echo "<script>alert('Successfully added teacher');window.location.href='../view_teachers.php'</script>";
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }

    } 

?>
