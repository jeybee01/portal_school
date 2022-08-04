<?php 
 include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

$user_id = getId();
$session_id = $_SESSION['sess_id'];
if(!$session_id or $session_id == ''){
    echo "<script>window.history.back()</script>";
    exit();
}
 if(isset($_GET['teacher']) and isset($_GET['class'])){
   $teacher = sanitize($_GET['teacher']);
   $teacher = filter_var($teacher,FILTER_VALIDATE_INT);
   if($teacher == '' or !$teacher){
     echo "<script>window.history.back()</script>";
 	 exit();
   }
     $teacher = $teacher - 1200;
  $sql = "SELECT id FROM users WHERE user_id = '$user_id' AND id = '$teacher'";
   $run = $db->query($sql);
   
   if($run->num_rows == 0){
    echo "<script>window.history.back()</script>";
    exit();
   }


   $class = sanitize($_GET['class']);
   $class = filter_var($class,FILTER_VALIDATE_INT);
   if($class == '' or !$class){
     echo "<script>window.history.back()</script>";
   exit();
   }
   $class = $class - 1200;

  $sql = "SELECT short FROM class WHERE id = '$class' AND user_id = '$user_id'";
   $run = $db->query($sql);
   if($run->num_rows == 0){
       echo "<script>alert('error occured');window.history.back();</script>";
     exit;
   }


   $update = "UPDATE class_teachers SET teacher = '0' WHERE session = '$session_id' AND  teacher = '$teacher'";

   $run_update = $db->query($update);
   
   if($run_update){

    $sql = "SELECT id FROM class_teachers WHERE session = '$session_id' AND class = '$class'";
    $run = $db->query($sql);

    if($run->num_rows == 0){
      $sql = "INSERT INTO `class_teachers`( `teacher`, `class`, `session`) VALUES ('$teacher','$class','$session_id')";
    }else{
      $info = $run->fetch_assoc();
      $the_id = $info['id'];
      $sql = "UPDATE class_teachers SET teacher = '$teacher' WHERE id = '$the_id'";      
    }

    $run = $db->query($sql);

    if($run){
       echo "<script>alert('Successfully Assigned teacher');window.location.href='../../classes/view_classes.php'</script>";
    }else{
       echo "<script>window.history.back()</script>";
       exit();
    }

   }else{
      echo "<script>window.history.back()</script>";
    exit();

   }


  



 }else{
  echo "<script>window.history.back()</script>";
  exit();
 }
  