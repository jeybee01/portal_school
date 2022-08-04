<?php 

 include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

$user_id = getId();
 if(isset($_GET['subject'])){
   $subject = sanitize($_GET['subject']);
   $subject = filter_var($subject,FILTER_VALIDATE_INT);
   if($subject == '' or !$subject){
     echo "<script>window.history.back()</script>";
 	 exit();
   }
   $subject = $subject - 1200;
   
   $sql = "SELECT id FROM subjects WHERE user_id = '$user_id' AND id = '$subject'";
   $run = $db->query($sql);
   if($run->num_rows == 0){
   	echo "<script>window.history.back()</script>";
 	exit();
   }

  $sql = "DELETE FROM subjects WHERE user_id = '$user_id' AND id = '$subject'";
  $run = $db->query($sql);
   if($run){
     echo "<script>alert('Successfully deleted subject');window.location.href='../view_subjects.php'</script>";
   }else{
   	echo "<script>alert('Error occured');window.history.back()</script>";
 	exit();
   }


 }else{
 	echo "<script>window.history.back()</script>";
 	exit();
 }




?>