<?php
 include '../functions.php';

 if(isset($_POST)){
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
 	 $sql = "SELECT * FROM users WHERE email = '$email' or reg_num = '$email'";
 	 $run = $db->query($sql);
   if($run->num_rows > 1){
         $_SESSION['errors']['message'] = 'Login With your registration Number';
         echo "<script>window.history.back()</script>";
         exit(); 
   }
 	$info = $run->fetch_assoc();
 	$hash = $info['password'];
 	 
 	 if(password_verify($password, $hash)){
        //$_SESSION['location'] = 'teachers';
 	 	  $_SESSION['email'] = $info['email'];
 	 	  $_SESSION['name'] = $info['name']; 
 	 	  $_SESSION['type'] = $info['type'];	
 	 	  $_SESSION['phone'] = $info['phone_number'];
 	 	  $_SESSION['gender'] = $info['gender'];
 	 	  $_SESSION['pic'] = $info['pic'];
 	 	  $_SESSION['state'] = $info['state'];
 	 	  $_SESSION['qualification'] = $info['qualification'];
        $_SESSION['fees'] = $info['fees'];
        $_SESSION['reg_num'] = $info['reg_num'];

         $user = ($_SESSION['type'] == '0') ? $info['id'] : $info['user_id'];

         if($_SESSION['type'] == '2'){
            
            $std_id = $info['id'];
            
            $sql = "SELECT class FROM class_students WHERE student = '$std_id' ORDER BY id DESC";
            $run = $db->query($sql);
            $info = $run->fetch_assoc();
           
            $class_id = isset($info['class']) ? $info['class'] : '';

            $sql = "SELECT user_id FROM class WHERE id = '$class_id'";
            $run = $db->query($sql);
            $user_info = $run->fetch_assoc();
            $user = isset($user_info['user_id']) ? $user_info['user_id'] : '';

         }

         $sql = "SELECT status FROM users WHERE id = '$user'";
         $run = $db->query($sql);
         $info = $run->fetch_assoc();
         $status = isset($info['status']) ? $info['status'] : '';

         if($status != '1'){
            $_SESSION['errors']['message'] = 'your school is blocked see Admin';
            echo "<script>window.history.back()</script>";
             exit(); 
         }

         $sql = "SELECT id,name FROM session WHERE user_id = '$user' ORDER BY id DESC";
         $run = $db->query($sql);
         $info = $run->fetch_assoc();
         $_SESSION['session'] = $info['name'];
         $_SESSION['sess_id'] = $info['id'];


         if($_SESSION['type'] == '0')
             header('location:../teachers/');
         else if($_SESSION['type'] == '1')
              header('location:../student/');
         else if($_SESSION['type'] == '3')
               header('location:../fees/');  
         else   
             header('location:../students/');  

 	 	 	   
      
 	 }else{
 	     $_SESSION['errors']['message'] = 'invalid login details';
     	echo "<script>window.history.back()</script>";
     	exit();
 	 }	


 }
 
?>


