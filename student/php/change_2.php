<?php
  include '../../functions.php';
   if(!isLoggedIn()){
      echo "<script>alert('error occored 1');window.history.back()</script>";
       exit;
  }
 if(isset($_POST)){
 	$user_id = getId();
 	 $session = sanitize($_POST['session']);
         $session = filter_var($session,FILTER_VALIDATE_INT);

    $class = sanitize($_POST['class']);
         $class = filter_var($class,FILTER_VALIDATE_INT);

      $term = sanitize($_POST['term']);
         $term = filter_var($term,FILTER_VALIDATE_INT);

        
         
       $student = sanitize($_POST['student']);
         $student = filter_var($student,FILTER_VALIDATE_INT);
         

      if($class == '' or !$class or $term == '' or !$term or $student == '' or !$student or $session == '' or !$session){
          echo "<script>alert('error occored 2');window.history.back()</script>";
        exit;
      }

       $class = $class - 1200;  
       $student = $student - 1200;
       $session = $session - 1200;
       $term = $term - 1200;

       

      if($_SESSION['type'] == '0'){
      	$sql = "SELECT id FROM class WHERE id = '$class' AND user_id = '$user_id'";
      }else if($_SESSION['type'] == '1'){
      	$session_id = $_SESSION['sess_id'];
      	$sql = "SELECT id FROM class_teachers WHERE class = '$class' AND session = '$session_id' AND teacher = '$user_id'";
      }else if($_SESSION['type'] == '2'){
         if($user_id != $student){
            echo "<script>alert('error occored 1');window.history.back()</script>";
            exit;
         }
      $sql = "SELECT id FROM class_students WHERE student = '$student' AND session = '$session' AND class = '$class'";

      }else{
      	echo "<script>alert('error occored 3');window.history.back()</script>";
        exit;
      }

      $run = $db->query($sql);
         if($run->num_rows == 0){
         //echo "<script>alert('error occored 6');window.history.back()</script>";
    $_SESSION['msg'] = 'Student did not register this session';
    echo "<script>window.history.back()</script>";
        exit;
      }   


   
    $_SESSION['c_sess'] = $session;
    $_SESSION['term'] = $term;
   
    header('location:../result.php?std='.($student + 1200).'&class='.($class + 1200));

 }
?>