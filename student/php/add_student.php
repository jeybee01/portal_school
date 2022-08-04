<?php
 include '../../functions.php';
 include '../../_classes/Teacher.php';
 if(!isLoggedIn() or $_SESSION['type'] != '1'){
     echo "<script>window.location.href='../index.php'</script>";
     exit();
  }
  
 $user_id = getId();
 $session_id = $_SESSION['sess_id'];
 $sql = "SELECT id,class FROM class_teachers WHERE teacher = '$user_id' AND session = '$session_id'";
 $run = $db->query($sql);
 $info = $run->fetch_assoc();
 

if(!isset($info)){
    echo "<script>window.history.back();</script>";
 }

   $class_id = $info['class'];


 $teacher = new Teacher($user_id);
 
  $admin = $teacher->get('user_id');
  
  echo $check = "SELECT id FROM class WHERE id = '$class_id' AND user_id = '$admin'";
  $run = $db->query($check);
  if($run->num_rows == 0){
    echo "<script>alert('Error occured 1');window.history.back();</script>";
    exit;
  }




   if(isset($_POST)){
       $_SESSION['errors'] = [];
  	$firstname= sanitize($_POST['fullname']);
  	  checkIfEmpty($firstname,'Full Name','fullname');

    $reg_num = sanitize($_POST['reg_num']);
      checkIfEmpty($reg_num,'Registration Number','reg_num');
   $email = sanitize($_POST['email']);
     validateEmail2($email,'Email','email');
   $phone = sanitize($_POST['phone']);
       validatePhone2($phone,'Phone Number','number');
   $gender = sanitize($_POST['gender']);
   $dob = sanitize($_POST['dob']);
     checkIfEmpty($dob,'Date Of Birth','dob');
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

     $sql = "SELECT id FROM users WHERE reg_num = '$reg_num'";
     $run = $db->query($sql);
     if($run->num_rows > 0){
        $my_info = $run->fetch_assoc();
        $student_id = $my_info['id'];
     }else{
        $sql = "INSERT INTO `users`( `name`, `email`, `gender`, `phone_number`, `pic`, `type`, `status`, `reg_num`, `password`, `qualification`, `state`,`dob`, `user_id`) VALUES ('$firstname','$email','$gender','$phone','','2','1','$reg_num','$password','','$state','$dob','$user_id')";
        $run = $db->query($sql);

         if($run){
          $student_id = $db->insert_id;
         }else{
        $_SESSION['errors']['message'] = 'Error occured,Try again';
        echo "<script>window.history.back()</script>";
        exit();
        }

     }

     $check = "SELECT id FROM class_students WHERE student = '$student_id' AND session = '$session_id'";
  $run_check = $db->query($check);
  if($run_check->num_rows > 0){
    $sql = "UPDATE class_students SET class = '$class_id' WHERE student = '$student_id' AND session = '$session_id'";
  }else{
    $sql = "INSERT INTO `class_students`(`student`, `class`, `session`) VALUES ('$student_id','$class_id','$session_id')";
  }

  $run = $db->query($sql);

  if($run){
     echo "<script>alert('Successfully added student to your class');window.location.href = '../view_students.php'</script>";
  }else{
    echo "<script>alert('error occured');window.history.back();</script>";
    exit;
  }


} 

?>
