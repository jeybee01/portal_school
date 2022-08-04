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
  
  $check = "SELECT id FROM class WHERE id = '$class_id' AND user_id = '$admin'";
  $run = $db->query($check);
  if($run->num_rows == 0){
    echo "<script>alert('Error occured');window.history.back();</script>";
    exit;
  }




  if(isset($_GET['std'])){
  	$student_id = sanitize($_GET['std']);
  	$student_id = filter_var($student_id,FILTER_VALIDATE_INT);
  	if(!$student_id OR $student_id == ''){
  		echo "<script>window.history.back();</script>";
  		exit;
  	}

  	$student_id = $student_id - 1200;

  	$sql = "DELETE FROM class_students WHERE student = '$student_id' AND class = '$class_id' AND session = '$session_id'";
  	$run = $db->query($sql);
   if($run){
     echo "<script>alert('Successfully removed student from your class');window.location.href = '../view_students.php'</script>";
  }else{
    echo "<script>alert('error occured');window.history.back();</script>";
    exit;
  }

  }else{
  	echo "<script>window.history.back();</script>";
  	exit;
  }



 ?>