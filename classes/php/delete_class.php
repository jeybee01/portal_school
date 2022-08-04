<?php 

 include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

$user_id = getId();
 if(isset($_GET['class'])){
   $class = sanitize($_GET['class']);
   $class = filter_var($class,FILTER_VALIDATE_INT);
   if($class == '' or !$class){
     echo "<script>window.history.back()</script>";
 	 exit();
   }
   $class = $class - 1200;
   
   $sql = "SELECT id FROM class WHERE user_id = '$user_id' AND id = '$class'";
   $run = $db->query($sql);
   if($run->num_rows == 0){
   	echo "<script>window.history.back()</script>";
 	exit();
   }

  $sql = "DELETE FROM class WHERE user_id = '$user_id' AND id = '$class'";
  $run = $db->query($sql);
   if($run){
     echo "<script>alert('Successfully deleted class');window.location.href='../view_classes.php'</script>";
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