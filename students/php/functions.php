<?php
  include '../functions.php';
  include '../_classes/Classes.php';
  $_SESSION['location'] = 'home';
  if(!isLoggedIn() or $_SESSION['type'] != '2'){
   header('location:../index.php');
 }
 $user = getId();

  $sql = "SELECT class_students.class,class_students.session,class.user_id FROM class_students INNER JOIN class  WHERE class_students.student = '$user' AND class.id = class_students.class ORDER BY class_students.id DESC";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();          
  $class_id = isset($info['class']) ? $info['class'] : '';  
  $session_id = isset($info['session']) ? $info['session'] : '';
  $admin_id = isset($info['user_id']) ? $info['user_id'] : '';




 function get_details($class_id,$user){
    global $db;
    $info = [];
    $sql = "SELECT user_id FROM class WHERE id = '$class_id'";
    $run = $db->query($sql);
    $user_info = $run->fetch_assoc();
    $user_id = isset($user_info['user_id']) ? $user_info['user_id'] : '';

    $sql = "SELECT school.name AS sch, users.* FROM school INNER JOIN users WHERE school.admin_id = '$user_id' AND users.id = '$user'";
    $run = $db->query($sql);
    $info = $run->fetch_assoc();

  
   return $info;
 }


 function get_class_mates($session,$user){
 	 global $db;
      $students = [];
 	 $sql = "SELECT users.*,class_students.student FROM users 	INNER JOIN class_students WHERE users.id != '$user' AND users.id = class_students.student AND class_students.session = '$session'";
 	$run = $db->query($sql);
    while($row = $run->fetch_assoc())$students[] = $row;
  return $students;
 }






?>