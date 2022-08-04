<?php
 include '../functions.php';
 if(!isLoggedIn()){
     echo "<script>window.location.href='../index.php'</script>";
     exit();
  }
  $user_id = getId();

   if(isset($_POST)){
       $_SESSION['errors'] = [];
  	$firstname= sanitize($_POST['fullname']);
  	  checkIfEmpty($firstname,'Full Name','fullname');
   $email = sanitize($_POST['email']);
  	    validateEmail($email,'Email','email',$user_id);
   $phone = sanitize($_POST['phone']);
       validatePhone($phone,'Phone Number','number',$user_id);
     $gender = sanitize($_POST['gender']);
   $state = sanitize($_POST['state']);
   checkIfEmpty($state,'state','state');  

   $fees = '';

  if($_SESSION['type'] == '0'){
     $fees = sanitize($_POST['fees']);
   checkIfEmpty($fees,'fees','fees');
  }
     
     if($gender != '1' and $gender != '2'){
       $_SESSION['errors']['gender'] = 'Enter valid gender';
     }  

     $password = sanitize($_POST['old_password']);
    $new_password = sanitize($_POST['new_password']);
      $confirm_password = sanitize($_POST['confirm_password']);    
    
     $get_password = "SELECT password FROM users WHERE id = '$user_id'";
       $run = $db->query($get_password);
       $info = $run->fetch_assoc();
       $hash = $info['password'];

          if($password != ''){

          if(password_verify($password, $hash)){
            if($new_password != ''){
              if($new_password == $confirm_password){
                $password = password_hash($new_password, PASSWORD_DEFAULT);
              }else{
                   $_SESSION['errors']['confirm'] = 'Password does not match';
                   echo "<script>window.history.back()</script>"; 
                   exit(); 
              }
                             
            }else{
               $_SESSION['errors']['new_password'] = 'Enter new password';
               echo "<script>window.history.back()</script>";
               exit();
            }
         }else{
              $_SESSION['errors']['old_password'] = 'Old password incorrect';
             echo "<script>window.history.back()</script>";
             exit();
         }
    }else{
        $password = $hash;
    }
  
         
      
     if(count($_SESSION['errors']) != 0){
     	echo "<script>window.history.back()</script>";
     	exit();
     }


     $sql = "UPDATE users SET name = '$firstname', email = '$email', password = '$password', phone_number = '$phone',fees = '$fees',gender = '$gender' WHERE id  = '$user_id'";

     $run = $db->query($sql);

          
     if($run){
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $firstname;
      $_SESSION['phone'] = $phone;
      $_SESSION['gender'] = $gender;
      $_SESSION['state'] = $state;
      $_SESSION['fees'] = $fees;
  

     	   echo "<script>alert('Successfully updated profile');window.location.href='index.php'</script>";
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }

    } 

?>
