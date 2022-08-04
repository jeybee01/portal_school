<?php 
   include '../functions.php';
    include '../_classes/Classes.php';
   if(isset($_GET['class'])){
   $class_id = sanitize($_GET['class']);
   $class_id = filter_var($class_id,FILTER_VALIDATE_INT);
   if(!$class_id or $class_id == ''){
       echo "<script>window.history.back();</script>";
       exit;
   }
   $class_id = $class_id - 1200;

   $class = new Classes($class_id);
  
  $user_id = getId();
  $sql = "SELECT user_id FROM users WHERE id = '$user_id' AND type = '3'";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();
  $admin = $info['user_id'];

 $check = "SELECT id FROM class WHERE id = '$class_id' AND user_id = '$admin'";
  $run = $db->query($check);
  if($run->num_rows == 0){
    echo "<script>alert('Error occured ');window.history.back();</script>";
    exit;
  }



 }else{
    echo "<script>window.history.back();</script>";
    exit;
 }


 $session_id = $_SESSION['sess_id'];

 $students = [];
 $sql = "SELECT class_students.student,users.* FROM class_students INNER JOIN users WHERE class_students.session = '$session_id' AND class_students.class = '$class_id' AND users.id = class_students.student";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$students[] = $row;


  $terms = [];
 $sql = "SELECT * FROM term WHERE session = '$session_id'";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$terms[] = $row;


 function has_paid($student,$term){
     global $db;
    $sql = "SELECT id,status FROM fees WHERE student = '$student' AND term = '$term'";
    $run = $db->query($sql);
    if($run->num_rows > 0){
       $info = $run->fetch_assoc();
       return $info['status'] == '1';
    }
    return false;
 }



 ?>