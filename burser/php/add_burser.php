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
  $password = password_hash($phone, PASSWORD_DEFAULT);  
     
     if($gender != '1' and $gender != '2'){
       $_SESSION['errors']['gender'] = 'Enter valid gender';
     }  
         
      
     if(count($_SESSION['errors']) != 0){
     	echo "<script>window.history.back()</script>";
     	exit();
     }


     $sql = "INSERT INTO `users`( `name`, `email`, `gender`, `phone_number`, `pic`, `type`, `status`, `reg_num`, `password`, `qualification`, `state`, `user_id`) VALUES ('$firstname','$email','$gender','$phone','','3','1','','$password','$qualification','$state','$user_id')";

     $run = $db->query($sql);

          
     if($run){
   

     	   echo "<script>alert('Successfully added burser');window.location.href='../view_bursers.php'</script>";
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }

    } 

?>
