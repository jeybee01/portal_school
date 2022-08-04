<?php 
 include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

$user_id = getId();
 if(isset($_GET['teacher'])){
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

  $sql = "DELETE FROM users WHERE user_id = '$user_id' AND id = '$teacher'";
  $run = $db->query($sql);
   if($run){
     echo "<script>alert('Successfully deleted  burser');window.location.href='../view_bursers.php'</script>";
 	exit();
   }else{
   	echo "<script>alert('Error occured');window.history.back()</script>";
 	exit();
   }


 }else{
 	echo "<script>window.history.back()</script>";
 	exit();
 }




?>