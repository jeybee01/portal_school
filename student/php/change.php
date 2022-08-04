<?php
  include '../../functions.php';
  if(!isLoggedIn()){
  	  echo "<script>alert('error occored');window.history.back()</script>";
       exit;
  }
 if(isset($_POST)){
 	$user_id = getId();
 	 $session = sanitize($_POST['session']);
         $session = filter_var($session,FILTER_VALIDATE_INT);
    $class = sanitize($_POST['class']);
         $class = filter_var($class,FILTER_VALIDATE_INT);

       $class = $class - 1200;  

      if($_SESSION['type'] == '0'){
      	$sql = "SELECT id FROM class WHERE id = '$class' AND user_id = '$user_id'";
      	$location = '../view_students.php?class='.($class + 1200);
      }else if($_SESSION['type'] == '1'){
      	$session_id = $_SESSION['sess_id'];
      	$sql = "SELECT id FROM class_teachers WHERE class = '$class' AND session = '$session_id' AND teacher = '$user_id'";
      	$location = '../view_students.php';
      }else{
      	echo "<script>alert('error occored');window.history.back()</script>";
        exit;
      }

      $run = $db->query($sql);
      if($run->num_rows == 0){
      	echo "<script>alert('error occored');window.history.back()</script>";
       exit;
      }   


     if(!$session or $session == ''){
       echo "<script>alert('error occored');window.history.back()</script>";
       exit;
      }

    $_SESSION['c_s'] = $session - 1200;
   
    header('location:'.$location);

 }
?>